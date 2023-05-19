<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="guest-booking"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Guest Booking"></x-navbars.navs.auth>
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
                                <h6 class="mb-3">Add Guest Booking Details</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        @if (session('status'))
                            <div class="row">
                                <div class="alert alert-success alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ Session::get('status') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                        data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        @if (Session::has('demo'))
                            <div class="row">
                                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ Session::get('demo') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                        data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <form method='POST'
                            action="{{ route('guest-booking.create', ['category' => $hostelRoom->hostelRoomType->id, 'id' => $hostelRoom->id]) }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Room Number</label>
                                    <input type="text" name="room_number" class="form-control border border-2 p-2"
                                        value="{{ $hostelRoom->room_number }}" disabled>
                                    <input type="hidden" name="room_number" value="{{ $hostelRoom->room_number }}">

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
                                            max="{{ $hostelRoom->hostelRoomType->room_capacity }}" value="1"
                                            id="quantity" style="width:50px;">

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
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="first_name" class="form-control border border-2 p-2">
                                    @error('first_name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="last_name" class="form-control border border-2 p-2">
                                    @error('last_name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control border border-2 p-2">
                                    @error('phone_number')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control border border-2 p-2">
                                    @error('email')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Check In Date</label>
                                    <input type="date" name="check_in_date" class="form-control border border-2 p-2"
                                        id="check-in-date">
                                    @error('check_in_date')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Check Out Date</label>
                                    <input type="date" name="check_out_date"
                                        class="form-control border border-2 p-2" id="check-out-date">
                                    @error('check_out_date')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Amount Paid</label>
                                    <input type="number" name="amount_paid" class="form-control border border-2 p-2"
                                        min="0" max="{{ $hostelRoom->hostelRoomType->room_price }}"
                                        placeholder="max value: {{ $hostelRoom->hostelRoomType->room_price }}"
                                        id="amount_paid" oninput="calculateBalance()">
                                    @error('amount_paid')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Balance</label>
                                    <input type="number" name="balance" class="form-control border border-2 p-2"
                                        id="balance" disabled>
                                    <input type="hidden" name="balance" class="form-control border border-2 p-2"
                                        id="balance2">
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
                    var currentBedSpace = parseInt("{{ $hostelRoom->bed_space }}", 10); // Get the current bed space value
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

                //Update the dates
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
                    const maxAmount = {{ $hostelRoom->hostelRoomType->room_price }};
                    const balance = maxAmount - amountPaid;
                    document.getElementById("balance").value = balance;
                    document.getElementById("balance2").value = balance;
                }
            </script>
        @endpush
        </div>
        <x-plugins></x-plugins>

</x-layout>
