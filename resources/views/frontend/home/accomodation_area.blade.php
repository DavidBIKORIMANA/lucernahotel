<div class="blog-area pt-100 pb-70" id="AccomodationDetail">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6">
                <div class="book-img-2">
                    <img src="{{asset('frontend/assets/img/DSC_0224.jpg')}}" alt="Images">
                </div>
                <div class="card">
                  <div class="card-body">
                    Accomodation at {{ config('app.client_name') }} is the epitome of luxury, featuring spacious and elegantly appointed living spaces, panoramic views, and personalized service for an unparalleled and prestigious experience.
                  </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="book-content-two">
                    <div class="section-title">
                        <h2 class="sp-color">{{ __("ACCOMODATION") }}</h2>
                        <a href="#roomDetail" class="badge  badge-success" style="color:#0c4da2">Rooms</a>
                        <a href="#meetingHall" class="badge badge-primary" style="color:#0c4da2">Meetings Hall</a>
                        <a href="#Bar" class="badge badge-primary" style="color:#0c4da2">Bar & Restaurant</a>
                        <a href="#AccomodationDetail" class="badge badge-primary" style="color:#0c4da2">Leisure activities</a>

                        <p>

                            The Presidential Suite at <span>{{ config('app.client_name') }}</span>. is the epitome of luxury, featuring spacious and elegantly appointed living spaces, panoramic views, and personalized service for an unparalleled and prestigious experience.
                        </p>
                    </div>
                    <a href="{{ route('booking.search.all') }}" class="default-btn btn-bg-three">Book now</a>
                    <!-- <a href="#" class="default-btn btn-bg-three">Read More</a> -->
                </div>
            </div>

            
        </div>
    </div>
</div>
