<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="facilities"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Facilities'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('{{ asset('assets') }}/img/facilities/facility.jpg'); background-size: cover;">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Add Facility Details</h6>
                            </div>
                        </div>
                    </div>
                    {{-- Beggining the real form fields here  --}}
                    <div class="card-body p-3">
                        <form method='POST' action="{{ route('facilities.update', $facility->id) }}"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <div class="mb-3">
                                        <img src="{{ asset($facility->facility_photo) }}"
                                            alt="{{ $facility->facility_photo }}" class="img-thumbnail" width="150"
                                            height="150">
                                    </div>
                                    <input type="file" name="photo" class="form-control-file">
                                    @error('photo')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Facility Name</label>
                                    <input type="text" name="facility_name" class="form-control border border-2 p-2"
                                        value='{{ old('facility_name', $facility->Facility_Name) }}'>
                                    @error('facility_name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-9">
                                    <label class="form-label d-block fs-5 text-dark">Description</label>
                                    <textarea class=" p-2 form-control border" placeholder="Leave a description here" style="resize: none"
                                        name="facility_description" id="" rows="10">{{ old('facility_description', $facility->Description) }}</textarea>
                                    @error('facility_description')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-9">
                                    <label class="form-label fs-5 text-dark">Availability</label>
                                    <div class="form-control">
                                        @if ($facility->Availability == 'Available')
                                            <div class="form-check form-check-inline p-2">
                                                <input class="form-check-input" type="radio" name="availability"
                                                    value="Available" checked>
                                                <label class="form-check-label">Available</label>
                                            </div>
                                            <div class="form-check form-check-inline p-2">
                                                <input class="form-check-input" type="radio" name="availability"
                                                    value="Under Renovation">
                                                <label class="form-check-label">Under Maintainance</label>
                                            </div>
                                        @else
                                            <div class="form-check form-check-inline p-2">
                                                <input class="form-check-input" type="radio" name="availability"
                                                    value="Available">
                                                <label class="form-check-label">Available</label>
                                            </div>
                                            <div class="form-check form-check-inline p-2">
                                                <input class="form-check-input" type="radio" name="availability"
                                                    value="Under Renovation" checked>
                                                <label class="form-check-label">Under Maintainance</label>
                                            </div>
                                        @endif

                                    </div>
                                    @error('availability')
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
    </div>
    <x-plugins></x-plugins>

</x-layout>
