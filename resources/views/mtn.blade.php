@extends('guest.layout')

@section('content')
    @include('guest.secondarynavbar')

    <div class="container min-vh-100" style="margin-top: 100px;">
        <div class='row d-flex justify-content-center'>
            <div class='col-md-6'>
                <div class="card">
                    <div class="card-header text-center"
                        style="background-image: url('{{ asset('assets') }}/img/logos/mtn-momo.jpg'); background-repeat: no-repeat; background-size: contain; background-position: center right;">
                        Enter Payment Details
                    </div>
                    <div class="card-body">
                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <form method="post" id="payment-form" role="form" action="{{ url('/add-money-mtn') }}">
                            @csrf

                            <div class="mb-3">
                                <label class='control-label'>Phone Number</label>
                                <input autocomplete='off' class='form-control' type='tel' name="phone_pay"
                                    placeholder="Enter your phone number" required>
                            </div>
                            <div class="mb-3">
                                <label class='card-header'>copy for testing phone no. 07770000</label>
                            </div>
                            <div class="mb-3" style="padding-top:20px;">
                                <label class='control-label'>Total</label>
                                <h2 class=''>
                                    UGX{{ session()->has('booking_data') && session('booking_data')['amount_paid'] ? session('booking_data')['amount_paid'] : 0 }}</span>
                                </h2>
                            </div>
                            <div class="mb-3">
                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <img src="{{ asset('assets') }}/img/logos/mtn-pay.png" alt="" width="500">
                                </div>
                            </div>
                            <div class="mb-3">
                                @if (session('booking_data') && array_key_exists('amount_paid', session('booking_data')))
                                    <button class='form-control btn btn-primary submit-button' type='submit'>Pay »</button>
                                @else
                                    <button class='form-control btn btn-primary submit-button' type='submit' disabled>Pay »</button>
                                @endif
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('guest.footer')
@endsection
