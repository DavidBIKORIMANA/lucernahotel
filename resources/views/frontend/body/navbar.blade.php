@php
    $setting = App\Models\SiteSetting::find(1);
@endphp


<div class="navbar-area">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="/" class="logo">
            <img src="{{asset('frontend/assets/img/logos/logo.jpeg'??'')}}" class="logo-one" alt="Logo">
            <img src="{{asset('frontend/assets/img/logos/logo.jpeg'??'')}}" class="logo-two" alt="Logo">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light ">
                <a class="navbar-brand" href="/">
                    <img src="{{asset('frontend/assets/img/logos/logo.jpeg'??'')}}" class="logo-one" alt="Logo">
                    <img src="{{asset('frontend/assets/img/logos/logo.jpeg'??'')}}" class="logo-two" alt="Logo">
                </a>

                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        
                        <li class="nav-item">
                             
                            <a href="#" class="nav-link active">
                                Home |
                            </a>

                        </li>
                        <li class="nav-item">
                              <a href="#AboutDetail" class="nav-link">
                                  About us |
                              </a>
                          </li>
                        <li class="nav-item">
                           <a href="#AccomodationDetail" class="nav-link">
                               Accomodation
                               <i class='bx bx-chevron-down'></i> 
                           </a>
                           <ul class="dropdown-menu">
                               <li class="nav-item">
                                   <a href="#roomDetail" class="nav-link">
                                       Rooms
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="#Bar" class="nav-link">
                                       Bar & Restaurant
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="#meetingHall" class="nav-link">
                                       Meeting Hall
                                   </a>
                               </li>
                           </ul>
                       </li>
                       
                        
                       
                       <!-- <li class="nav-item">
                           <a href="about.html" class="nav-link">
                               Rooms |
                           </a>
                       </li> -->
                       <!-- <li class="nav-item">
                           <a href="about.html" class="nav-link">
                               Meeting Hall |
                           </a>
                       </li> -->
                       <!-- <li class="nav-item">
                           <a href="about.html" class="nav-link">
                               Bar & Restaurant |
                           </a>
                       </li> -->

                        <!--<li class="nav-item">
                            <a href="#" class="nav-link">
                               Restaurant
                            </a>

                        </li>

                        <li class="nav-item">
                            <a href="{{ route('show.gallery') }}" class="nav-link">
                              Gallery
                            </a>

                        </li> -->

                        <!-- <li class="nav-item">
                            <a href="{{ route('blog.list') }}" class="nav-link">
                                Blog
                            </a>

                        </li> -->
                          @php
                              $room = App\Models\Room::latest()->get();
                          @endphp
                        <!-- <li class="nav-item">
                            <a href="{{ route('froom.all') }}" class="nav-link">
                                All Rooms
                                <i class='bx bx-chevron-down'></i> |
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($room  as $item)
                                <li class="nav-item">
                                    <a href="room.html" class="nav-link">
                                        {{ $item['type']['name'] }}
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                        </li> -->

                        <!-- <li class="nav-item">
                            <a href="{{ route('contact.us') }}" class="nav-link">
                                Contact
                            </a>
                        </li> -->

                        <li class="nav-item-btn">
                            <a href="{{ route('booking.search.all') }}" class="default-btn btn-bg-one border-radius-5">Book Now</a>
                        </li>
                    </ul>

                    <div class="nav-btn d-flex align-items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="nav-auth-link">
                                <i class='bx bx-user-circle'></i> {{ Auth::user()->name }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-auth-link" style="background:none;border:none;cursor:pointer;">
                                    <i class='bx bx-log-out'></i> Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="nav-auth-link">
                                <i class='bx bx-log-in'></i> Login
                            </a>
                            <a href="{{ route('register') }}" class="default-btn btn-bg-one border-radius-5" style="padding:8px 20px;font-size:13px;">
                                Join
                            </a>
                        @endauth
                        <a href="{{ route('booking.search.all') }}" class="default-btn btn-bg-one border-radius-5">Book Now</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
