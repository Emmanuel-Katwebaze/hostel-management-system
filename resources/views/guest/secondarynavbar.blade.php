<header id="fh5co-header-section" style="background-color: #434A50; position: fixed; top: 0; z-index: 999; width: 100%;">
    <div class="container">
        @if (auth()->check())
            <h1 id="fh5co-logo"><a href="{{ url('/guest') }}">Ideal Hostel</a></h1>
        @else
            <h1 id="fh5co-logo"><a href="{{ url('/home') }}">Ideal Hostel</a></h1>
        @endif
        <nav id="fh5co-menu-wrap" role="navigation">
            <ul class="sf-menu" id="fh5co-primary-menu">
                @if (auth()->check())
                    <li><a  href="{{ url('/guest') }}">Home</a></li>
                    <li><a href={{ route('guestBookings') }}>View Bookings</a></li>
                @else
                    <li><a  href="{{ url('/home') }}">Home</a></li>
                @endif

                @if (auth()->check())
                    @if (auth()->user()->is_admin)
                        <li>
                            <a href="" class="fh5co-sub-ddown">Admin Actions</a>
                            <ul class="fh5co-sub-menu">
                                <li><a href="{{ route('hostel-room-categories') }}">Go to Dashboard</a>
                                </li>
                                <li>
                                    <a href="#" class="fh5co-sub-ddown">
                                        <span
                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign
                                            Out</span>
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}" id="logout-form"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="fh5co-sub-ddown">
                                <span>Logged In</span>
                            </a>
                        </li>
                    @else
                        <li><a href="" class="fh5co-sub-ddown">Guest Actions</a>
                            <ul class="fh5co-sub-menu">
                                <li>
                                    <a href="#" class="fh5co-sub-ddown">
                                        <span
                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign
                                            Out</span>
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}" id="logout-form"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="fh5co-sub-ddown">
                                <span>Logged In</span>
                            </a>
                        </li>
                    @endif
                @else
                    <li><a href="" class="fh5co-sub-ddown">Sign In / Sign Up</a>
                        <ul class="fh5co-sub-menu">
                            <li><a href="{{ url('/sign-in') }}">Sign In</a></li>
                            <li>
                                <a href="{{ url('/sign-up') }}" class="fh5co-sub-ddown">Sign Up</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</header>
