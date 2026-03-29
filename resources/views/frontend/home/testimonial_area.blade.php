@php
    $testimonial = App\Models\Testimonial::latest()->get();
@endphp
<div class="testimonials-area-three pb-70">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="sp-color">Our Latest Testimonials and What Our Client Says</h2>
        </div>
        <div class="row align-items-center pt-45">
            <div class="col-lg-4 col-md-4">
                <div class="testimonials-img-two">
                    <img src="{{ asset('frontend/assets/img/testimonials/testimonials-img5.jpg') }}" alt="Images">
                </div>
            </div>

            <div class="col-lg-8 col-md-8">
                <div class="testimonials-slider-area owl-carousel owl-theme">
                    
                    @foreach ($testimonial as $item) 
                    <div class="testimonials-slider-content">
                        <i class="flaticon-left-quote"></i>
                        <p>
                            {{ $item->message }}
                        </p>
                        <ul>
                            <li>
                                <!-- <img src="{{ asset($item->image) }}" alt="Images"> -->
                                <h3>{{ $item->name }}</h3>
                                <span>{{ $item->city }}</span>
                            </li>
                        </ul>
                    </div>
                    @endforeach
                     
                </div>
            </div>
        </div>
    </div>
</div>