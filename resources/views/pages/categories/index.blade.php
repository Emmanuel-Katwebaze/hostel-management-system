<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='categories'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Categories"></x-navbars.navs.auth>
        <!-- End Navbar -->
        @if (Session::has('flash_message'))
            <div class="position-fixed top-1 center z-index-3">
                <div class="toast fade p-2 bg-white show" role="alert" aria-live="assertive" id="successToast"
                    aria-atomic="true" data-bs-autohide="true">
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
        <div class="m-auto col-xl-8 col-sm-11 my-5 max-height-vh-80">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner relative">
                    @php
                        $active = false; // set initial value for $active
                    @endphp
                    @foreach ($hostelRoomTypes as $index => $category)
                        @if ($category->room_type == 'Unassigned')
                            @continue
                        @endif
                        <div class="carousel-item {{ !$active ? ' active' : '' }}">
                            @php
                                $active = true; // set $active to true after the first non-Unassigned category is found
                            @endphp
                            <div class="row">
                                <img src="{{ asset($category->room_type_photo) }}" class="d-block w-100"
                                    alt="double-room" />
                                <div
                                    class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1
                                            class="display-4 text-bg-primary mb-3 animate__animated animate__fadeInDown">
                                            {{ $category->room_type }} Rooms</h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn"><span
                                                class="text-bg-primary font-weight-bold mb-0">UGX</span>
                                            {{ $category->room_price }}</p>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                                            {{ $category->room_description }}</p>
                                        <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                            href="{{ route('hostel-room-categories.show', $category->id) }}">View Rooms
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="container-fluid py-4 min-vh-100">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong>Categories<strong>
                            </div>
                        </div>
                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href={{ route('hostel-room-categories.create') }}><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                Category</a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                PHOTO</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                CATEGORY</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                PRICE</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                CAPACITY</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                DESCRIPTION</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                CREATION DATE
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hostelRoomTypes as $category)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">{{ $category->id }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset($category->room_type_photo) }}"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="shared-room">
                                                        </div>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $category->room_type }}</h6>

                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ $category->room_price }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ $category->room_capacity }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $category->room_description }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $category->created_at }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <a rel="tooltip" class="btn btn-info btn-link"
                                                        href="{{ route('hostel-room-categories.show', $category->id) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">visibility</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                    @if ($category->room_type == 'Unassigned')
                                                        <button rel="tooltip" class="btn btn-success btn-link"
                                                            href="" data-original-title="" title=""
                                                            disabled>
                                                            <i class="material-icons">edit</i>
                                                            <div class="ripple-container"></div>
                                                        </button>
                                                        <button type="submit" class="btn btn-danger btn-link"
                                                            data-original-title="" title="" disabled>
                                                            <i class="material-icons">delete</i>
                                                            <div class="ripple-container"></div>
                                                        </button>
                                                    @else
                                                        <a rel="tooltip" class="btn btn-success btn-link"
                                                            href="{{ route('hostel-room-categories.edit', $category->id) }}"
                                                            data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                        <form method="POST"
                                                            action="{{ route('hostel-room-categories.destroy', $category->id) }}"
                                                            accept-charset="UTF-8" style="display:inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-link"
                                                                onclick="return confirm(&quot;Confirm delete?&quot;)"
                                                                data-original-title="" title="">
                                                                <i class="material-icons">delete</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                        </form>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
