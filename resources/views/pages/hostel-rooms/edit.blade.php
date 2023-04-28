<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="rooms"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Rooms'></x-navbars.navs.auth>
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
                                <h6 class="mb-3">Edit Hostel Room Details</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <form method='POST' action="{{ route('hostel-room.update', $hostelRoom->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Room Number</label>
                                    <input type="text" name="room_number" class="form-control border border-2 p-2"
                                        value='{{ old('room_number', $hostelRoom->room_number) }}'>
                                    @error('room_number')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="form-inline mb-3 col-md-9">
                                    <label class="my-1 mr-2">Floor Level</label>
                                    <select class="form-control custom-select border border-2 p-2 my-1 mr-sm-2"
                                        name="floor_level">
                                        @if ($hostelRoom->floor_level == 'First Floor')
                                            <option selected>First Floor</option>
                                        @else
                                            <option>First Floor</option>
                                        @endif
                                        @if ($hostelRoom->floor_level == 'Second Floor')
                                            <option selected>Second Floor</option>
                                        @else
                                            <option>Second Floor</option>
                                        @endif
                                        @if ($hostelRoom->floor_level == 'Third Floor')
                                            <option selected>Third Floor</option>
                                        @else
                                            <option>Third Floor</option>
                                        @endif
                                        @if ($hostelRoom->floor_level == 'Fourth Floor')
                                            <option selected>Fourth Floor</option>
                                        @else
                                            <option>Fourth Floor</option>
                                        @endif
                                        @if ($hostelRoom->floor_level == 'Fifth Floor')
                                            <option selected>Fifth Floor</option>
                                        @else
                                            <option>Fifth Floor</option>
                                        @endif
                                    </select>
                                    @error('floor_level')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Room Type</label>
                                    <div class="form-control">
                                        <div class="form-check form-check-inline p-2">
                                            @foreach ($hostelRoomTypes as $hostel_room_type)
                                                @if ($hostelRoom->hostelRoomType->room_type == $hostel_room_type->room_type)
                                                    <input class="form-check-input" type="radio" name="room_type"
                                                        value="{{ $hostel_room_type->room_type }}" checked>
                                                @else
                                                    <input class="form-check-input" type="radio" name="room_type"
                                                        value="{{ $hostel_room_type->room_type }}">
                                                @endif
                                                <label
                                                    class="form-check-label me-4">{{ $hostel_room_type->room_type }}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                    @error('room_type')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Bed Space</label>
                                    <div class="form-control">
                                        <div class="form-check form-check-inline p-2">
                                            @if ($hostelRoom->bed_space == '1')
                                                <input class="form-check-input" type="radio" name="bed_space"
                                                    value="1" checked>
                                            @else
                                                <input class="form-check-input" type="radio" name="bed_space"
                                                    value="1">
                                            @endif
                                            <label class="form-check-label">One</label>
                                        </div>
                                        <div class="form-check form-check-inline p-2">
                                            @if ($hostelRoom->bed_space == '2')
                                                <input class="form-check-input" type="radio" name="bed_space"
                                                    value="2" checked>
                                            @else
                                                <input class="form-check-input" type="radio" name="bed_space"
                                                    value="2">
                                            @endif
                                            <label class="form-check-label">Two</label>
                                        </div>
                                        <div class="form-check form-check-inline p-2">
                                            @if ($hostelRoom->bed_space == 'None')
                                                <input class="form-check-input" type="radio" name="bed_space"
                                                    value="None" checked>
                                            @else
                                                <input class="form-check-input" type="radio" name="bed_space"
                                                    value="None">
                                            @endif
                                            <label class="form-check-label">None</label>
                                        </div>
                                    </div>
                                    @error('bed_space')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-9">
                                    <label class="form-label">Status</label>
                                    <div class="form-control">
                                        <div class="form-check form-check-inline p-2">
                                            @if ($hostelRoom->status == 'Available')
                                                <input class="form-check-input" type="radio" name="status"
                                                    value="Available" checked>
                                            @else
                                                <input class="form-check-input" type="radio" name="status"
                                                    value="Available">
                                            @endif
                                            <label class="form-check-label">Available</label>
                                        </div>
                                        <div class="form-check form-check-inline p-2">
                                            @if ($hostelRoom->status == 'Occupied')
                                                <input class="form-check-input" type="radio" name="status"
                                                    value="Occupied" checked>
                                            @else
                                                <input class="form-check-input" type="radio" name="status"
                                                    value="Occupied">
                                            @endif
                                            <label class="form-check-label">Occupied</label>
                                        </div>
                                        <div class="form-check form-check-inline p-2">
                                            @if ($hostelRoom->status == 'Under Renovation')
                                                <input class="form-check-input" type="radio" name="status"
                                                    value="Under Renovation" checked>
                                            @else
                                                <input class="form-check-input" type="radio" name="status"
                                                    value="Under Renovation">
                                            @endif
                                            <label class="form-check-label">Under Renovation</label>
                                        </div>
                                    </div>
                                    @error('status')
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
