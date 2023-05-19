<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='hostel_booking'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Hostel Booking"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4 min-vh-100 d-flex justify-content-center align-items-center">
            <div class="row">
                <div class="card hostel-card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-img-body overflow-hidden">
                                <div class="card-img-top">
                                    <img src='{{ asset('assets') }}/img/expenses/booking.jpg'
                                        class="card-img-top me-3 border-radius-lg" alt="bookings">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body p-3">
                                <div class="text-end pt-1">
                                    <p class="text-2xl mb-0 text-capitalize">Room Number</p>
                                    <h4 class="mb-0">{{ $hostel_booking->hostelRoom->room_number }}</h4>
                                </div>
                                <hr class="dark horizontal my-0">
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-2xl font-weight-bolder">Room Type</p>
                                    <p class="text-2xl mb-0">{{ $hostel_booking->hostelRoom->hostelRoomType->room_type }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-2xl font-weight-bolder">Bed Space</p>
                                    <p class="text-2xl mb-0">{{ $hostel_booking->bed_space }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-2xl font-weight-bolder">Tenant Name</p>
                                    <p class="text-2xl mb-0">{{ $hostel_booking->tenant->name }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-2xl font-weight-bolder">Tenant Email</p>
                                    <p class="text-2xl mb-0">{{ $hostel_booking->tenant->email }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-2xl font-weight-bolder">Check In Date</p>
                                    <p class="text-2xl mb-0">{{ $hostel_booking->check_in_date }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-2xl font-weight-bolder">Check Out Date</p>
                                    <p class="text-2xl mb-0">{{ $hostel_booking->check_out_date }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-2xl font-weight-bolder">Amount Paid</p>
                                    <p class="text-2xl mb-0">{{ $hostel_booking->amount_paid }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-2xl font-weight-bolder">Balance</p>
                                    <p class="text-2xl mb-0">{{ $hostel_booking->balance }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
    </div>
    @push('js')
        <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
    @endpush
</x-layout>
