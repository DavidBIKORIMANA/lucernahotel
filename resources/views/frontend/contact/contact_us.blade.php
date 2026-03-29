@extends('frontend.main_master')
@section('main')
<!-- Inner Banner -->
<!-- <div class="inner-banner inner-bg2">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>Contact</li>
            </ul>
            <h3>Contact</h3>
        </div>
    </div>
</div> -->
<!-- Inner Banner End -->

<!-- Contact Area -->
<div class="contact-area pt-25 pb-70">
    <div class="container">
        <div class="section-title text-center pt-5 pb-5">
            <!-- <span class="sp-color">BLOGS</span> -->
            <h2 class="sp-color">Contact us</h2>
            <!-- <button type="button" class="btn btn-xs btn-bg-three rounded-pill">View menu</button> -->
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6 col-sm-6">
                <div class="contact-content">
                    <div class="section-title">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6149.053947903886!2d29.754994947779355!3d-2.08832623103027!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dccb9e7e84a8c1%3A0xbf93699bed85f0f!2sLucerna-Kabgayi%20Hotel!5e0!3m2!1sen!2sus!4v1707836567416!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-6">
                <div class="contact-form">
                    <form method="POST" action="{{ route('store.contact') }}" >
                        @csrf

                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name" placeholder="Name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="Email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="phone" id="phone_number" required data-error="Please enter your number" class="form-control" placeholder="Phone">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="subject" id="msg_subject" class="form-control" required data-error="Please enter your subject" placeholder="Your Subject">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="8" required data-error="Write your message" placeholder="Your Message"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                 

                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="default-btn btn-bg-three">
                                    Send Message
                                </button>
                                
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Area End -->

@php
    $setting = App\Models\SiteSetting::find(1);
@endphp

<!-- contact Another -->
<div class="contact-another pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-another-content">
                    <div class="section-title">
                        <h2>Contacts Info</h2>
                        <p>
                            
                        </p>
                    </div>

                    <div class="contact-item">
                        <ul>
                            <li>
                                <i class='bx bx-home-alt'></i>
                                <div class="content">
                                    <span>{{ $setting->address }}</span>
                                    <!-- <span>{{ $setting->address }}</span> -->
                                </div>
                            </li>
                            <li>
                                <i class='bx bx-phone-call'></i>
                                <div class="content">
                                    <span><a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a></span>
                                    <!-- <span><a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a></span> -->
                                </div>
                            </li>
                            <li>
                                <i class='bx bx-envelope'></i>
                <div class="content">
                    <span><a href="{{ $setting->email }}">{{ $setting->email }}</a></span>
                    <!-- <span><a href="{{ $setting->email }}">{{ $setting->email }}</a></span> -->
                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- contact Another End -->




@endsection

