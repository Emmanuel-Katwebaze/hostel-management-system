@extends('guest.layout')
@section('content')
    @include('guest.toast')
    @include('guest.primarynavbar')
    <!-- end:fh5co-header -->
    <aside id="fh5co-hero" class="js-fullheight">
        <div class="flexslider js-fullheight">
            <ul class="slides">
                @foreach ($categories as $category)
                    @if ($category->room_type != 'Unassigned')
                        <li style="background-image: url('{{ asset($category->room_type_photo) }}');">
                            <div class="overlay-gradient"></div>
                            <div class="container">
                                <div class="col-md-12 col-md-offset-0 text-center slider-text">
                                    <div class="slider-text-inner js-fullheight">
                                        <div class="desc">
                                            <p><span>{{ $category->room_type }}</span></p>
                                            <p>UGX <span>{{ $category->room_price }}</span></p>
                                            <h2>{{ $category->room_description }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach

            </ul>
        </div>
    </aside>

    <div id="featured-hotel" class="fh5co-bg-color">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2>Featured Rooms</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="">
                    @foreach ($rooms as $room)
                        <div class="feature-full-1col">
                            <div class="image"
                                style="background-image: url('{{ asset($room->hostelRoomType->room_type_photo) }}');">
                                <div class="descrip text-center">
                                    <p><small>For as low
                                            as</small><span>{{ $room->hostelRoomType->room_price }}</span></p>
                                </div>
                            </div>
                            <div class="desc">
                                {{-- <h3>{{$room->hostelRoomType->room_type}}</h3> --}}
                                <h3>{{ $room->room_number }}</h3>
                                <h3>{{ $room->hostelRoomType->room_type }}</h3>
                                <p>{{ $room->floor_level }}</p>
                                <p>{{ $room->hostelRoomType->room_description }}
                                </p>
                                <p><a href="{{ route('guestBooking.create', $room->id) }}"
                                        class="btn btn-primary btn-luxe-primary">Book Now <i class="ti-angle-right"></i></a>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <div id="hotel-facilities">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2>Hostel Facilities</h2>
                    </div>
                </div>
            </div>

            <div id="tabs">
                <nav class="tabs-nav">
                    @php
                        $active = false;
                    @endphp
                    @foreach ($facilities as $facility)
                        <a href="#" class="{{ !$active ? ' active' : '' }}"
                            data-tab="{{ $facility->Facility_Name }}">
                            @php
                                $active = true; // set $active to true after the first non-Unassigned category is found
                            @endphp
                            <span>{{ $facility->Facility_Name }}</span>
                        </a>
                    @endforeach
                </nav>
                <div class="tab-content-container">
                    @php
                        $active = false;
                    @endphp
                    @foreach ($facilities as $facility)
                        <div class="tab-content {{ !$active ? ' active show' : '' }}"
                            data-tab-content="{{ $facility->Facility_Name }}">
                            @php
                                $active = true;
                            @endphp
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ asset($facility->facility_photo) }}" class="img-responsive"
                                            alt="{{ $facility->Facility_Name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <span class="super-heading-sm">Amazing</span>
                                        <h3 class="heading">{{ $facility->Facility_Name }}</h3>
                                        <p>{{ $facility->Description }}</p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div id="testimonial" style="background-color: #434A50;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2>Happy Customer Says...</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimony">
                        <blockquote>
                            &ldquo;If you’re looking for a top quality hostel look no further.Thanks so much for
                            the service&rdquo;
                        </blockquote>
                        <p class="author"><cite>John Doe</cite></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimony">
                        <blockquote>
                            &ldquo;My friend and I had a delightful weekend get away here, the staff were so
                            friendly and attentive. Highly Recommended&rdquo;
                        </blockquote>
                        <p class="author"><cite>Rob Smith</cite></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimony">
                        <blockquote>
                            &ldquo;If you’re looking for a top quality hostel look no further.Thanks so much for
                            the service&rdquo;
                        </blockquote>
                        <p class="author"><cite>Jane Doe</cite></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('guest.footer')
@endsection
