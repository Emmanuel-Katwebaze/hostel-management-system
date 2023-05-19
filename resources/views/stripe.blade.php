@extends('guest.layout')
@section('content')
    @include('guest.secondarynavbar')
    <div class="container " style="margin-top: 100px;">
        <div class='row'>
            <div class='col-md-12'>
                <div class="card">
                    <div class="card-header text-center"
                        style="background-image: url('{{ asset('assets') }}/img/logos/stripe_logo.png'); background-repeat: no-repeat; background-size: contain; background-position: center right;">
                        Enter Credit Card Details
                    </div>
                    <div class="card-body">
                        @if (Session::has('error'))
                            <font color="red">{{ Session::get('error') }}</font>
                        @endif
                        <form class="form-horizontal" method="post" id="payment-form" role="form"
                            action="{{ route('addmoney.stripe') }}">
                            @csrf
                            <div class="mb-3">
                                <label class='control-label'>Card Number</label>
                                <input autocomplete='off' class='form-control card-number' size='20' type='text'
                                    name="card_no">
                            </div>
                            <div class="mb-3">
                                <label class='card-header'>copy for testing card no. 5555555555554444</label>
                            </div>
                            <div class="row ms-2 align-items-center">
                                <div class="col-auto">
                                    <label class='control-label'>CVV</label>
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311'
                                        size='4' type='text' name="cvvNumber">
                                </div>
                                <div class="col-auto">
                                    <label class='control-label'>Expiration</label>
                                    <input class='form-control card-expiry-month' placeholder='MM' size='4'
                                        type='text' name="ccExpiryMonth">
                                </div>
                                <div class="col-auto">
                                    <label class='control-label'>Year</label>
                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                        type='text' name="ccExpiryYear">
                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                        type='hidden' name="amount"
                                        value="{{ optional(session('booking_data'))->get('amount_paid', 0) }}">
                                </div>
                            </div>

                            <div class="col-auto">
                                <label class='control-label'>Total</label>
                                <h2 class='amount'>UGX
                                    {{ session()->has('booking_data') && session('booking_data')['amount_paid'] ? session('booking_data')['amount_paid'] : 0 }}
                                </h2>
                                </h2>
                            </div>
                            <div class="mb-3">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <img src="{{ asset('assets') }}/img/logos/visa.png" alt="" width="200">
                                    <img src="{{ asset('assets') }}/img/logos/mastercard.png" alt="" width="200">
                                    <img src="{{ asset('assets') }}/img/logos/maestro.png" alt="" width="200">
                                    <img src="{{ asset('assets') }}/img/logos/discover.png" alt="" width="200">

                                </div>
                            </div>
                            <div class="mb-3">
                                @if (session('booking_data') && array_key_exists('amount_paid', session('booking_data')))
                                    <button class='form-control btn btn-primary submit-button' type='submit'>Pay »</button>
                                @else
                                    <button class='form-control btn btn-primary submit-button' type='submit' disabled>Pay
                                        »</button>
                                @endif

                            </div>

                            <div class="mb-3">
                                <div class='alert-danger alert' style="display:none;">
                                    Please correct the errors and try again.
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('guest.footer')
@endsection
