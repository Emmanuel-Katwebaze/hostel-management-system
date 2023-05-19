<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\GuestBooking;
use App\Models\HostelRoom;
use Illuminate\Http\Request;
use Bmatovu\MtnMomo\Products\Collection;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use Illuminate\Support\Facades\DB;

class MtnMomoPaymentController extends Controller
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
        return redirect('mtn');
    }

    public function paymentMTN(Request $request)
    {
        $booking_data = session('booking_data');

        // Store the request array in the session
        session()->put('booking_data', $booking_data);

        $facilities = Facility::all();
        return view('mtn', compact('facilities'));
    }

    public function postPaymentMTN(Request $request)
    {
        // $collection = new Collection();
        // $momoTransactionId = $collection->requestToPay("Order123", "12345678", 100, "Sure thing!", "Payback my money bro");
        $booking_data = session('booking_data');
        if($booking_data == null){
            return redirect()->route('addmoney.paymentsMtn')->with('error', 'Session Expired!');
        }

        $request->merge($booking_data);
        $bedSpace = intval($request->bed_space);
        $random_number = mt_rand(1, 100); // generates a random number between 1 and 100

        try {
            $collection = new Collection();
            $partyId = $request->phone_pay;
            $amount = $request->amount_paid;
            $momoTransactionId = $collection->requestToPay("Booking{$random_number}", $partyId, $amount);
            $transactionStatus = $collection->getTransactionStatus($momoTransactionId);
            //$token = $collection->getToken();
            //$balance = $collection->getAccountBalance();

        } catch (CollectionRequestException $e) {

            return redirect()->route('aaddmoney.paymentsMtn')->with('error', $e->getMessage());
        }

        if ($transactionStatus['status'] == "SUCCESSFUL") {
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
            $status = $transactionStatus['status'];
            $errorMessage = "Transaction {$status}";
            return redirect()->route('aaddmoney.paymentsMtn')->with('error', $errorMessage);
        }






        // $collectionId = env('MOMO_COLLECTION_ID');
        // $status = $collection->isActive('12345678');

    }
}
