@extends('guest.layout')
@section('content')
    @include('guest.secondarynavbar')
    <div class="container" style="margin-top: 100px;">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Add Hostel Booking Details</h2>
                <form id="payment-form" method="POST" action="{{ url('/mtn-pay') }}">
                    {{-- action="{{ route('guestBooking.create', ['category' => $hostelRoom->hostelRoomType->id, 'id' => $hostelRoom->id]) }}"> --}}
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="room_number">Room Number</label>
                                <input type="text" name="room_number" class="form-control"
                                    value="{{ $hostelRoom->room_number }}" disabled>
                                <input type="hidden" name="room_number" value="{{ $hostelRoom->room_number }}">
                                @error('room_number')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="bed_space">Bed Space</label>
                                <input type="number" name="bed_space" class="form-control" min="1"
                                    max="{{ $hostelRoom->bed_space }}" value="1">
                            </div>
                            @error('bed_space')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control">
                                @error('first_name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control">
                                @error('last_name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control">
                                @error('phone_number')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ auth()->user()->email }}">
                                @error('email')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="check_in_date">Check In Date</label>
                                <input type="date" name="check_in_date" class="form-control" id="check-in-date">
                                @error('check_in_date')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="check_out_date">Check Out Date</label>
                                <input type="date" name="check_out_date" class="form-control" id="check-out-date"
                                    disabled>
                                <input type="hidden" name="check_out_date" class="form-control" id="check-out-date2">
                                @error('check_out_date')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="amount_paid">Amount Paid</label>
                                <input type="number" name="amount_paid" class="form-control" min="0"
                                    max="{{ $hostelRoom->hostelRoomType->room_price }}"
                                    placeholder="max value: {{ $hostelRoom->hostelRoomType->room_price }}" id="amount_paid"
                                    oninput="calculateBalance()">
                                @error('amount_paid')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Balance</label>
                                <input type="number" name="balance" class="form-control" id="balance" min="0"
                                    max="{{ $hostelRoom->hostelRoomType->room_price }}" disabled>
                                <input type="hidden" name="balance" class="form-control" id="balance2">
                                @error('balance')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="button-container">
                        <div class="main-button btn btn-primary" onmouseover="showSubButtons()"
                            onmouseout="hideSubButtons()">Proceed
                            to Payment</div>
                        <div class="sub-buttons" onmouseover="showSubButtons()" onmouseout="hideSubButtons()">
                            <button type="button" onclick="submitForm('{{ url('/pay') }}')">Pay with Stripe</button>
                            <button type="button" onclick="submitForm('{{ url('/mtn-pay') }}')">Pay with MTN</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    @include('guest.footer')
    <script>
        //Update the dates
        const checkInDateInput = document.querySelector('#check-in-date');
        const checkOutDateInput = document.querySelector('#check-out-date');
        const checkOutDateInput2 = document.querySelector('#check-out-date2');

        checkInDateInput.addEventListener('change', () => {
            const checkInDate = new Date(checkInDateInput.value);
            const checkOutDate = new Date(checkInDate.getFullYear(), checkInDate.getMonth() + 3, checkInDate
                .getDate());
            checkOutDateInput.value = checkOutDate.toISOString().split('T')[0];
            checkOutDateInput2.value = checkOutDate.toISOString().split('T')[0];
        });

        function calculateBalance() {
            const amountPaid = document.getElementById("amount_paid").value;
            const maxAmount = {{ $hostelRoom->hostelRoomType->room_price }};
            const balance = maxAmount - amountPaid;
            document.getElementById("balance").value = balance;
            document.getElementById("balance2").value = balance;
        }

        function showSubButtons() {
            document.querySelector(".sub-buttons").style.opacity = "1";
        }

        function hideSubButtons() {
            document.querySelector(".sub-buttons").style.opacity = "0";
        }

        function submitForm(url) {
            var form = document.getElementById("payment-form");
            form.action = url;
            form.submit();
        }
    </script>
@endsection
