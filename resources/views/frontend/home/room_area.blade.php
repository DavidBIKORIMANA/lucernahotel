<div class="blog-area pt-100 pb-70" id='roomDetail'>
    <div class="container">
        <div class="section-title text-center">
            <!-- <span class="sp-color">BLOGS</span> -->
            <h2 class="sp-color">Rooms Categories</h2>
            <a href="{{ route('booking.search.all',['idcode' => 1]) }}" class="read-btn btn btn-xs btn-bg-three rounded-pill">Book now</a>
            <!-- <button type="button" class="btn btn-xs btn-bg-three rounded-pill">Book room</button> -->
        </div>
        <div class="row pt-45">
            <div class="col-lg-3 col-md-6">
                <div class="blog-item">
                    <a href="#">
                        <img src="{{asset('frontend/assets/img/DSC_0319.jpg')}}" alt="Images">
                    </a>
                    <div class="content">
                        <h3>
                             <a href="#" class="sp-color">Presidential suite</a>
                        </h3>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <p>Indulge in unmatched luxury in our Presidential Suite. Experience grandeur with spacious living areas, panoramic views, and exclusive features fit for royalty.</p>

                        <a href="{{ route('booking.search.all') }}" class="default-btn btn-bg-three">
                            Book now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="blog-item">
                    <a href="#">
                        <img src="{{asset('frontend/assets/img/DSC_0248.jpg')}}" alt="Images">
                    </a>
                    <div class="content">
                        <h3>
                             <a href="#" class="sp-color">Family suite & room</a>
                        </h3>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <p>Create cherished memories in our Family Suites & Rooms. Enjoy ample space, thoughtful features, and special touches for every member of the family.</p></br>

                        <a href="{{ route('booking.search.all',['idcode' => 1]) }}" class="default-btn btn-bg-three">
                            Book now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="blog-item">
                    <a href="#">
                        <img src="{{asset('frontend/assets/img/DSC_0187.jpg')}}" alt="Images">
                    </a>
                    <div class="content">
                        <h3>
                             <a href="#" class="sp-color">King size bedroom</a>
                        </h3>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <p>Experience ultimate comfort in our King Size Bedrooms. Relax in style with a luxurious king bed, premium linens, and elegant furnishings for a restful night's sleep.</p>

                        <a href="{{ route('booking.search.all',['idcode' => 1]) }}" class="default-btn btn-bg-three">
                            Book now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="blog-item">
                    <a href="#">
                        <img src="{{asset('frontend/assets/img/room_4.jpg')}}" alt="Images">
                    </a>
                    <div class="content">
                        <h3>
                             <a href="#" class="sp-color">ViP room</a>
                        </h3>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <p>Elevate your stay with our VIP Room. Enjoy personalized service, VIP perks, and exclusive access to enhance your luxury experience at our hotel.</p>

                        <a href="{{ route('booking.search.all',['idcode' => 1]) }}" class="default-btn btn-bg-three">
                            Book now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
