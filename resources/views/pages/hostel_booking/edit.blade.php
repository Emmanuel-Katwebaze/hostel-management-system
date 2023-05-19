<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="hostel_booking"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Edit Hostel Booking'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('{{ asset('assets') }}/img/hostel-rooms/hostel-1.jpg');"> <span
                    class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Edit HostelBooking Details</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <form method='POST' action='{{ route('hostel_booking.update', $hostel_booking->id) }}'>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Room Number</label>
                                    <input type="text" name="room_number" class="form-control border border-2 p-2"
                                        value="{{ old('room_number', $hostel_booking->hostelRoom->room_number) }}"
                                        disabled>
                                    <input type="hidden" name="room_number"
                                        value="{{ old('room_number', $hostel_booking->hostelRoom->room_number) }}">
                                    @error('room_number')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Bed Space</label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-outline-secondary"
                                                onclick="decrementValue()">
                                                <span class="material-icons">remove</span>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center"
                                            name="bed_space" min="1"
                                            max="{{ $hostel_booking->hostelRoom->hostelRoomType->room_capacity }}"
                                            value="{{ old('bed_space', $hostel_booking->bed_space) }}" id="quantity"
                                            style="width:50px;">

                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary"
                                                onclick="incrementValue()">
                                                <span class="material-icons">add</span>
                                            </button>
                                        </div>
                                    </div>
                                    @error('bed_space')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Tenant Email</label>
                                    <input type="text" name="email" class="form-control border border-2 p-2"
                                        value='{{ old('email', $hostel_booking->tenant->email) }}'>
                                    @error('email')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Check In Date</label>
                                    <input type="date" name="check_in_date" class="form-control border border-2 p-2"
                                        id="check-in-date"
                                        value='{{ old('check_in_date', $hostel_booking->check_in_date) }}'>
                                    @error('check_in_date')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>


                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Check Out Date</label>
                                    <input type="date" name="check_out_date" class="form-control border border-2 p-2"
                                        id="check-out-date"
                                        value='{{ old('check_out_date', $hostel_booking->check_out_date) }}'>
                                    @error('check_out_date')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Amount Paid</label>
                                    <input type="number" name="amount_paid" class="form-control border border-2 p-2"
                                        id="amount_paid" value='{{ old('amount_paid', $hostel_booking->amount_paid) }}'
                                        placeholder="max amount: {{ $hostel_booking->hostelRoom->hostelRoomType->room_price }}"
                                        oninput="calculateBalance()">
                                    @error('amount_paid')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Balance</label>
                                    <input type="number" name="balance" id="balance"
                                        class="form-control border border-2 p-2"
                                        value="{{ old('balance', $hostel_booking->balance) }}" disabled>
                                    <input type="hidden" name="balance" id="balance2"
                                        class="form-control border border-2 p-2"
                                        value="{{ old('balance', $hostel_booking->balance) }}">
                                    @error('balance')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Submit</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <x-footers.auth></x-footers.auth>
        @push('js')
            <script>
                function incrementValue() {
                    var currentBedSpace = parseInt("{{ $hostel_booking->bed_space }}",
                        10); // Get the current bed space value
                    var value = parseInt(document.getElementById('quantity').value, 10);
                    value = isNaN(value) ? 1 : value;
                    value = value < currentBedSpace ? value + 1 : currentBedSpace; // Only increment up to current bed space value
                    document.getElementById('quantity').value = value;
                }

                function decrementValue() {
                    var value = parseInt(document.getElementById('quantity').value, 10);
                    value = isNaN(value) ? 1 : value;
                    value = value > 1 ? value - 1 : 1;
                    document.getElementById('quantity').value = value;
                }

                const checkInDateInput = document.querySelector('#check-in-date');
                const checkOutDateInput = document.querySelector('#check-out-date');

                checkInDateInput.addEventListener('change', () => {
                    const checkInDate = new Date(checkInDateInput.value);
                    const checkOutDate = new Date(checkInDate.getFullYear(), checkInDate.getMonth() + 1, checkInDate
                        .getDate());
                    checkOutDateInput.value = checkOutDate.toISOString().split('T')[0];
                });

                function calculateBalance() {
                    const amountPaid = document.getElementById("amount_paid").value;
                    const maxAmount = {{ $hostel_booking->hostelRoom->hostelRoomType->room_price }};
                    const balance = maxAmount - amountPaid;
                    document.getElementById("balance").value = balance;
                    document.getElementById("balance2").value = balance;
                }
            </script>
        @endpush
    </div>
    <x-plugins></x-plugins>

</x-layout>
