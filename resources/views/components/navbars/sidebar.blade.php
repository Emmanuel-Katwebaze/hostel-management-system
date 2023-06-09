@props(['activePage'])

<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('hostel-room-categories') }} ">
            <img src="{{ asset('assets') }}/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-2 font-weight-bold text-white">Ideal Hostel Admin Dashboard</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    {{-- collapse navbar-collapse --}}
    <div class="w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Members
                </h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'admin-profile' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('user-profile') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Admin Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'tenant' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('tenant') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">hotel</i>
                    </div>
                    <span class="nav-link-text ms-1">Tenant Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'staff' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('staff') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">diversity_3</i>
                    </div>
                    <span class="nav-link-text ms-1">Staff</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Hostel Rooms</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'categories' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('hostel-room-categories') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">category</i>
                    </div>
                    <span class="nav-link-text ms-1">Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'rooms' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('hostel-room') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">house</i>
                    </div>
                    <span class="nav-link-text ms-1">Rooms</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Facilities</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'facilities' ? ' active bg-gradient-primary' : '' }}"
                    href="{{ route('facilities')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">holiday_village</i>
                    </div>
                    <span class="nav-link-text ms-1">Facilities</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Accounts</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'hostel-expenses' ? ' active bg-gradient-primary' : '' }} "
                    href="{{route('expenses')}}"
                    >
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">payments</i>
                    </div>
                    <span class="nav-link-text ms-1">Hostel Expenses</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'hostel_booking' ? ' active bg-gradient-primary' : '' }} "
                href="{{ route('hostel_booking') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">money</i>
                    </div>
                    <span class="nav-link-text ms-1">Hostel Booking</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'guest-booking' ? ' active bg-gradient-primary' : '' }} "
                href="{{ route('guest-booking') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">money</i>
                    </div>
                    <span class="nav-link-text ms-1">Guest Booking</span>
                </a>
            </li>
        </ul>
    </div>

</aside>
