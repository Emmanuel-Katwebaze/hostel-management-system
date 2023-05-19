@extends('guest.layout')
@section('content')
    @include('guest.toast')
    @include('guest.secondarynavbar')
    <!-- end:fh5co-header -->
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            @if (count($bookings) == 0)
                <div class="container-fluid py-4 min-vh-100 d-flex justify-content-center align-items-center">
                    <div class="row">
                        <p class="text-7xl text-secondary">No Bookings Available</p>
                    </div>
                </div>
            @else
                <div class="container min-vh-100">
                    <h2>Bookings</h2>
                    <table class="table table-bordered table-hover table-centered">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Room Number</th>
                                <th>Room Type</th>
                                <th>Check-in Date</th>
                                <th>Check-out Date</th>
                                <th>Amount Paid</th>
                                <th>Balance</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->hostelRoom->room_number }}</td>
                                    <td>{{ $booking->hostelRoom->hostelRoomType->room_type }}</td>
                                    <td>{{ $booking->check_in_date }}</td>
                                    <td>{{ $booking->check_out_date }}</td>
                                    <td>{{ $booking->amount_paid }}</td>
                                    <td>{{ $booking->balance }}</td>
                                    <td>
                                        <a href="{{ route('guestBooking.show', $booking->id) }}" class="btn btn-primary">View
                                            Receipt</a>
                                        <form method="POST" action="{{ route('guestBookings.destroy', $booking->id) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm(&quot;Confirm Cancel Booking?&quot;)">
                                                CANCEL
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    @include('guest.footer')
@endsection
