<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='categories'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Categories"></x-navbars.navs.auth>
        <!-- End Navbar -->
        @if (count($hostelRooms) == 0)
            <div class="container-fluid py-4 min-vh-100 d-flex justify-content-center align-items-center">
                <div class="row">
                    <p class="text-7xl text-secondary">No Rooms Available</p>
                    <div class="d-flex justify-content-center">
                        <a class="btn bg-gradient-dark mb-0"
                            href="{{ route('hostel-room-categories.category_create', $hostelRoomType->id) }}"><i
                                class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Room</a>
                    </div>
                </div>
            </div>
        @endif
        @if (Session::has('flash_message'))
            <div class="position-fixed top-1 center z-index-3">
                <div class="toast fade p-2 bg-white show" role="alert" aria-live="assertive" id="successToast"
                    aria-atomic="true">
                    <div class="toast-header border-0">
                        <i class="material-icons text-success me-2">
                            check
                        </i>
                        <span class="me-auto font-weight-bold">Hostel Management Dashboard </span>
                        <small class="text-body">Just Now</small>
                        <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast"
                            aria-label="Close"></i>
                    </div>
                    <hr class="horizontal dark m-0">
                    <div class="toast-body">
                        {{ Session::get('flash_message') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="container-fluid py-4 min-vh-100">
            <div class="row">
                <div class="d-flex justify-content-between me-3 my-2">
                    <h4><span>{{ $hostelRoomType->room_type }}</span> Rooms</h4>
                    <a class="btn bg-gradient-dark mb-0"
                        href="{{ route('hostel-room-categories.category_create', $hostelRoomType->id) }}"><i
                            class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Room</a>
                </div>
                @foreach ($hostelRooms as $hostelRoom)
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mt-5">
                        <div class="card hostel-card">
                            <div class="card-header p-3 pt-2">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="material-icons opacity-10">weekend</i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize">Room Number</p>
                                    <h4 class="mb-0">{{ $hostelRoom->room_number }}</h4>
                                </div>
                            </div>
                            <div class="card-img-body overflow-hidden">
                                <div class="card-img-top">
                                    @switch($hostelRoomType->room_type)
                                        @case('Single')
                                            <img src="{{ asset('assets') }}/img/hostel-rooms/single-room.jpg"
                                                class="card-img-top me-3 border-radius-lg" alt="single-room">
                                        @break

                                        @case('Double')
                                            <img src="{{ asset('assets') }}/img/hostel-rooms/double-room.jpg"
                                                class="card-img-top me-3 border-radius-lg" alt="double-room">
                                        @break

                                        @case('Shared')
                                            <img src="{{ asset('assets') }}/img/hostel-rooms/shared-room.jpg"
                                                class="card-img-top me-3 border-radius-lg" alt="shared-room">
                                        @break

                                        @default
                                            <img src="{{ asset('assets') }}/img/hostel-rooms/other.jpg"
                                                class="card-img-top me-3 border-radius-lg" alt="other-room">
                                    @endswitch
                                    <div class="card-img-overlay w-100 h-100">
                                        <a rel="tooltip" class="btn btn-success btn-link m-1"
                                            href="{{ route('hostel-room.edit', $hostelRoom->id) }}">
                                            <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                        <form method="POST"
                                            action="{{ route('hostel-room.destroy', $hostelRoom->id) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-link m-1"
                                                @if ($hostelRoom->status == 'None') {{ 'disabled' }} @endif
                                                onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                <i class="material-icons">delete</i>
                                                <div class="ripple-container"></div>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-sm font-weight-bolder">Floor level</p>
                                    <p class="text-sm mb-0">{{ $hostelRoom->floor_level }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-sm font-weight-bolder">Room Type</p>
                                    <p class="text-sm mb-0">{{ $hostelRoomType->room_type }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-sm font-weight-bolder">Price</p>
                                    <p class="text-sm mb-0"><span
                                            class="text-sm mb-0 text-bg-primary font-weight-bolder">UGX</span>
                                        {{ $hostelRoomType->room_price }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-sm font-weight-bolder">Bed Space</p>
                                    <p class="text-sm mb-0">{{ $hostelRoom->bed_space }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between pt-2">
                                    <p class="mb-0 text-bg-primary text-sm font-weight-bolder">Status</p>
                                    <p class="text-sm mb-0">{{ $hostelRoom->status }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
