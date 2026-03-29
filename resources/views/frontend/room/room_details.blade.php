@extends('frontend.main_master')
@section('main')
  <!-- Inner Banner -->
  <!-- <div class="inner-banner inner-bg10">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>Room Details </li>
            </ul>
            <h3>{{ $roomdetails->type->name }}</h3>
        </div>
    </div>
</div> -->
<!-- Inner Banner End -->

<!-- Room Details Area End -->
<div class="room-details-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="room-details-side">
                    <div class="side-bar-form">
                        <h3>Booking Sheet </h3>
                        <form>
                            <div class="row align-items-center">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Check in</label>
                                        <div class="input-group">
                                            <input id="datetimepicker" type="text" class="form-control" placeholder="09/29/2020">
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class='bx bxs-calendar'></i>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Check Out</label>
                                        <div class="input-group">
                                            <input id="datetimepicker-check" type="text" class="form-control" placeholder="09/29/2020">
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class='bx bxs-calendar'></i>
                                    </div>
                                </div>

                                <div class="col-lg-12" style="display: none;">
                                    <div class="form-group">
                                        <label>Numbers of Persons</label>
                                        <select class="form-control">
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                        </select>	
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Numbers of Rooms</label>
                                        <select class="form-control">
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                        </select>	
                                    </div>
                                </div>
    
                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="default-btn btn-bg-three border-radius-5">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                  
                </div>
            </div>

            <div class="col-lg-8">
                <div class="room-details-article">
                    
                    <div class="room-details-slider owl-carousel owl-theme">
                        @foreach ($multiImage as $image) 
                        <div class="room-details-item">
                            <img src="{{ asset('upload/roomimg/multi_img/'.$image->multi_img) }}" alt="Images">
                        </div>
                        @endforeach
                       
                    </div>





                    <div class="room-details-title">
                        <h2>{{ $roomdetails->type->name }}</h2>
                        <ul>
                            
                            <li>
                               <b> Basic : ${{ $roomdetails->price }}/Night/Room</b>
                            </li> 
                         
                        </ul>
                    </div>

                    <div class="room-details-content">
                        <p>
                            {!! $roomdetails->description !!}
                        </p>




<div class="side-bar-plan">
                        <h3>Basic Plan Facilities</h3>
                        <ul>
                            @foreach ($facility as $fac) 
                            <li><a href="#">{{ $fac->facility_name }}</a></li>
                            @endforeach
                        </ul>

                        
                    </div>







<div class="row"> 
<div class="col-lg-6">



<div class="services-bar-widget">
                        <h3 class="title">Room Details </h3>
<div class="side-bar-list">
    <ul>
       <li>
            <a href="#"> <b>Capacity : </b> {{ $roomdetails->room_capacity }} Person <i class='bx bxs-cloud-download'></i></a>
        </li>
        <li>
             <a href="#"> <b>Size : </b> {{ $roomdetails->size }}ft2 <i class='bx bxs-cloud-download'></i></a>
        </li>
       
       
    </ul>
</div>
</div>




</div>



<div class="col-lg-6">
<div class="services-bar-widget">
<h3 class="title">Room Details </h3>
<div class="side-bar-list">
    <ul>
       <li>
            <a href="#"> <b>View : </b> {{ $roomdetails->view }} <i class='bx bxs-cloud-download'></i></a>
        </li>
        <li>
             <a href="#"> <b>Bad Style : </b> {{ $roomdetails->bed_style }} <i class='bx bxs-cloud-download'></i></a>
        </li>
         
    </ul>
</div>
</div> 

            </div> 
                </div>



                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Room Details Area End -->

<!-- Room Details Other -->
<div class="room-details-other pb-70">
    <div class="container">
        <div class="room-details-text">
            <h2>Other Rooms </h2>
        </div>

        <div class="row ">
           
           @foreach ($otherRooms as $item)
            <div class="col-lg-6">
                <div class="room-card-two">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-4 p-0">
                            <div class="room-card-img">
                                <a href="{{ url('room/details/'.$item->id) }}">
                                    <img src="{{ asset( 'upload/roomimg/'.$item->image ) }}" alt="Images">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-8 p-0">
                            <div class="room-card-content">
                                 <h3>
             <a href="{{ url('room/details/'.$item->id) }}">{{ $item['type']['name'] }}</a>
                                </h3>
                                <span>{{ $item->price }} / Per Night </span>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <p>{{ $item->short_desc }}</p>
                                <ul>
                   <li><i class='bx bx-user'></i> {{ $item->room_capacity }} Person</li>
                   <li><i class='bx bx-expand'></i> {{ $item->size }}m</li>
                                </ul>

                                <ul>
        <li><i class='bx bx-show-alt'></i>{{ $item->view }}</li>
        <li><i class='bx bxs-hotel'></i> {{ $item->bed_style }}</li>
                                </ul>
                                
                                <a href="" class="book-more-btn">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 
            @endforeach
           


        </div>
    </div>
</div>
<!-- Room Details Other End -->

<!-- Guest Reviews Section -->
<div class="room-details-other pb-70">
    <div class="container">
        <div class="room-details-text">
            <h2>Guest Reviews</h2>
        </div>

        @php
            $reviews = \App\Models\Review::where('room_id', $roomdetails->id)->where('is_approved', true)->with('user')->latest()->get();
            $avgRating = $reviews->avg('rating');
        @endphp

        @if($reviews->count() > 0)
        <div class="row mb-4">
            <div class="col-md-4 text-center">
                <h1 class="display-4 fw-bold" style="color:#0c4da2">{{ number_format($avgRating, 1) }}</h1>
                <div class="mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <i class='bx {{ $i <= round($avgRating) ? "bxs-star" : "bx-star" }}' style="color:#f5a623;font-size:20px"></i>
                    @endfor
                </div>
                <p class="text-muted">{{ $reviews->count() }} {{ Str::plural('review', $reviews->count()) }}</p>
            </div>
            <div class="col-md-8">
                @foreach($reviews->take(5) as $review)
                <div class="mb-3 p-3" style="background:#f8f9fb;border-radius:8px;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong>{{ $review->user->name ?? 'Guest' }}</strong>
                        <span class="text-muted small">{{ $review->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            <i class='bx {{ $i <= $review->rating ? "bxs-star" : "bx-star" }}' style="color:#f5a623"></i>
                        @endfor
                        @if($review->title)
                            <strong class="ms-2">{{ $review->title }}</strong>
                        @endif
                    </div>
                    <p class="mb-0">{{ $review->comment }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <p class="text-center text-muted py-4">No reviews yet. Be the first to share your experience!</p>
        @endif
    </div>
</div>
<!-- Guest Reviews End -->




@endsection