<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\GuestBooking;
use App\Models\HostelRoom;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Stripe;

class StripePaymentController extends Controller
{
    public function pay(Request $request)
    {
        $attributes = request()->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255|',
            'email' => 'required|email|max:255|exists:users,email',
            'phone_number' => 'required|max:255|',
            'check_in_date' => 'required|date|max:255',
            'check_out_date' => 'required|date|max:255',
            'amount_paid' => 'required|numeric',
            'balance' => 'required|numeric'
        ]);


        // Store the request array in the session
        session()->put('booking_data', $request->all());

        // redirect to the next view
        return redirect('stripe');
    }


    public function paymentStripe(Request $request)
    {

        $booking_data = session('booking_data');

        // Store the request array in the session
        session()->put('booking_data', $booking_data);


        $facilities = Facility::all();
        return view('stripe', compact('facilities'));
    }

    public function postPaymentStripe(Request $request)
    {
        $booking_data = session('booking_data');
        if($booking_data == null){
            return redirect()->route('addmoney.paymentstripe')->with('error', 'Session Expired!');
        }
        $request->merge($booking_data);
        $bedSpace = intval($request->bed_space);



        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            // 'amount' => 'required',
        ]);



        $input = $request->except('_token');

        if ($validator->passes()) {
            $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));

            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year' => $request->get('ccExpiryYear'),
                        'cvc' => $request->get('cvvNumber'),
                    ],
                ]);

                if (!isset($token['id'])) {
                    return redirect()->route('stripe');
                }

                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'UGX',
                    'amount' => $request->amount_paid,
                    'description' => 'wallet',
                ]);

                if ($charge['status'] == 'succeeded') {
                    $guest = request()->user();

                    $attributes = request()->validate([
                        'first_name' => 'required|max:255',
                        'last_name' => 'required|max:255|',
                        'email' => 'required|email|max:255|exists:users,email',
                        'phone_number' => 'required|max:255|',
                        'check_in_date' => 'required|date|max:255',
                        'check_out_date' => 'required|date|max:255',
                        'amount_paid' => 'required|numeric',
                        'balance' => 'required|numeric'
                    ]);

                    $user = DB::table('users')
                        ->where('email', '=', $request->email)
                        ->select('id')
                        ->first();

                    $hostelRoom = HostelRoom::where('room_number', $request->room_number)
                        ->first();

                    GuestBooking::create([
                        'first_name' => $attributes['first_name'],
                        'last_name' => $attributes['last_name'],
                        'email' => $attributes['email'],
                        'bed_space' => $bedSpace,
                        'phone_number' => $attributes['phone_number'],
                        'check_in_date' => $attributes['check_in_date'],
                        'check_out_date' => $attributes['check_out_date'],
                        'amount_paid' => $attributes['amount_paid'],
                        'balance' => $attributes['balance'],
                        'user_id' => $guest->id,
                        'hostel_room_id' => $hostelRoom->id
                    ]);



                    // update the availability of the bed to "occupied"
                    $hostelRoom->bed_space = $hostelRoom->bed_space - $bedSpace;
                    if ($hostelRoom->bed_space == 0) {
                        $hostelRoom->status = 'Unavailable';
                    }
                    $hostelRoom->save();
                    // Clear a specific session key
                    session()->forget('booking_data');

                    return redirect('guest')->with('flash_message', 'Payment Succesful! Thank you for Booking!');
                } else {
                    return redirect()->route('addmoney.paymentstripe')->with('error', 'Money not add in wallet!');
                }
            } catch (Exception $e) {
                return redirect()->route('addmoney.paymentstripe')->with('error', $e->getMessage());
            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                return redirect()->route('addmoney.paymentstripe')->with('error', $e->getMessage());
            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                return redirect()->route('addmoney.paymentstripe')->with('error', $e->getMessage());
            }
        }return redirect()->route('addmoney.paymentstripe')->with('error', 'Invalid Card Number!');
    }
}
