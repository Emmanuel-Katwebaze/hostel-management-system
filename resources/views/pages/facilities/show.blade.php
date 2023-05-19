<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='facilities'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="facilities"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4 min-vh-100 d-flex justify-content-center align-items-center">
            <div class="row">
                <div class="card hostel-card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-img-body overflow-hidden">
                                <div class="card-img-top">
                                    <img src="{{ asset($facility->facility_photo) }}"
                                        class="card-img-top me-3 border-radius-lg" alt="facility">
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="text-2xl mb-0 text-capitalize font-weight-bolder">ID</p>
                                    <h4 class="mb-0">{{ $facility->id }}</h4>
                                </div>
                                <hr class="dark horizontal my-0">
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-2xl font-weight-bolder">Facility Name</p>
                                    <p class="text-2xl mb-0">{{ $facility->Facility_Name }}</p>
                                </div>


                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-2xl font-weight-bolder">Availability</p>
                                    <p class="text-2xl mb-0">{{ $facility->Availability }}</p>
                                </div>

                                <div class="d-flex flex-column align-items-start justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-2xl font-weight-bolder">Facility Description</p>
                                    <p class="text-2xl mb-0">{{ $facility->Description }}</p>
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
