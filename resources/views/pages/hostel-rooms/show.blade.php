<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='rooms'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Rooms"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4 min-vh-100 d-flex justify-content-center align-items-center">
            <div class="row">
                <div class="card hostel-card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-img-body overflow-hidden">
                                <div class="card-img-top">
                                    <img src="{{ asset($hostelRoom->hostelRoomType->room_type_photo) }}"
                                        class="card-img-top me-3 border-radius-lg" alt="single-room">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body p-3">
                                <div class="text-end pt-1">
                                    <p class="text-2xl mb-0 text-capitalize">Room Number</p>
                                    <h4 class="mb-0">{{ $hostelRoom->room_number }}</h4>
                                </div>
                                <hr class="dark horizontal my-0">
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-2xl font-weight-bolder">Floor level</p>
                                    <p class="text-2xl mb-0">{{ $hostelRoom->floor_level }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-2xl font-weight-bolder">Room Type</p>
                                    <p class="text-2xl mb-0">{{ $hostelRoom->hostelRoomType->room_type }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-2xl font-weight-bolder">Price</p>
                                    <p class="text-2xl mb-0"><span
                                            class="text-2xl mb-0 text-bg-primary font-weight-bolder">UGX</span>
                                        {{ $hostelRoom->hostelRoomType->room_price }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-2xl font-weight-bolder">Bed Space</p>
                                    <p class="text-2xl mb-0">{{ $hostelRoom->bed_space }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-2xl font-weight-bolder">Status</p>
                                    <p class="text-2xl mb-0">{{ $hostelRoom->status }}</p>
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
