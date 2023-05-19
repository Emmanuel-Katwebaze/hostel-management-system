@extends('guest.layout')
@section('content')
    @include('guest.secondarynavbar')
    <!-- end:fh5co-header -->
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="container">
                <div class="card mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">Booking Receipt</h5>
                        <p class="card-text text-center">Thank you for your booking!</p>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Booking ID:</p>
                                <p class="text-muted text-center">{{ $booking->id }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Date:</p>
                                <p class="text-muted text-center">{{ $booking->created_at }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Room Number:</p>
                                <p class="text-muted text-center">{{ $booking->hostelRoom->room_number }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Room Type:</p>
                                <p class="text-muted text-center">{{ $booking->hostelRoom->hostelRoomType->room_type }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Name:</p>
                                <p class="text-muted text-center">{{ $booking->first_name }}
                                    {{ $booking->last_name }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Email:</p>
                                <p class="text-muted text-center">{{ $booking->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Check-in Date:</p>
                                <p class="text-muted text-center">{{ $booking->check_in_date }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Check-out Date:</p>
                                <p class="text-muted text-center">{{ $booking->check_out_date }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Amount Paid:</p>
                                <p class="text-muted text-center">{{ $booking->amount_paid }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-weight-bold mb-0 text-center">Balance:</p>
                                <p class="text-muted text-center">{{ $booking->balance }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('guest.footer')
@endsection
