<footer id="footer" class="fh5co-bg-color">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="copyright">
                    <p><small>Designed by <a href="" target="_blank">GROUP ONE</a></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        <h3>Company</h3>
                        <ul class="link">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Hotels</a></li>
                            <li><a href="#">Customer Care</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h3>Our Facilities</h3>
                        <ul class="link">
                            @foreach ($facilities as $facility)
                                <li><a href="#">{{ $facility->Facility_Name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h3>Subscribe</h3>
                        <p>Subscribe to our newsletter </p>
                        <form action="#" id="form-subscribe">
                            <div class="form-field">
                                <input type="email" placeholder="Email Address" id="email">
                                <input type="submit" id="submit" value="Send">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <ul class="social-icons">
                    <li>
                        <a href="#"><i class="icon-twitter-with-circle"></i></a>
                        <a href="#"><i class="icon-facebook-with-circle"></i></a>
                        <a href="#"><i class="icon-instagram-with-circle"></i></a>
                        <a href="#"><i class="icon-linkedin-with-circle"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
