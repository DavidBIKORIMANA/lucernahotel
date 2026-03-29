<div class="blog-area pt-100 pb-70" id="AboutDetail">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="book-img-2">
                    <img src="{{asset('frontend/assets/img/about-img.jpg')}}" alt="Images">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="book-content-two">
                    <div class="section-title">
                        <!-- <span class="sp-color">MAKE A QUICK BOOKING</span> -->
                        <h2 class="sp-color">About {{ config('app.name', 'NoNe') }}</h2>
                        <p>
                            <span>{{ config('app.client_name') }}</span> was established with a deep-rooted commitment to Catholic values and hospitality. Located in the heart of Rwanda, our hotel is more than just a place to stay; it is a sanctuary where guests are welcomed with open hearts and minds, and where the principles of professionalism, respect, and inclusivity guide every interaction.
                            With Rwanda's diverse population and vibrant cultural tapestry, our hotel embraces the opportunity to welcome guests from all walks of life. Whether you are visiting for business, leisure, or spiritual reflection, our doors are open to you, and our team is dedicated to ensuring that your experience with us is nothing short of exceptional.

                        </p>
                    </div>
                    <a href="{{ route('booking.search.all') }}" class="default-btn btn-bg-three">Book now</a>
                    <a href="#modal-1" class="default-btn btn-bg-three">Read More</a>
                </div>
            </div>

            
        </div>
    </div>
</div>


<div data-am-modal id="modal-1">
  <a href="#!" class="modal-overlay"></a>
  <div class="modal-dialog">
    <div class="modal-content">
      <a href="#!" class="modal-close">Close</a>
      <h1>{{ config('app.client_name') }}</h1>
      <p><span>{{ config('app.client_name') }}</span> was established with a deep-rooted commitment to Catholic values and hospitality. Located in the heart of Rwanda, our hotel is more than just a place to stay; it is a sanctuary where guests are welcomed with open hearts and minds, and where the principles of professionalism, respect, and inclusivity guide every interaction.</p><p>
With Rwanda's diverse population and vibrant cultural tapestry, our hotel embraces the opportunity to welcome guests from all walks of life. Whether you are visiting for business, leisure, or spiritual reflection, our doors are open to you, and our team is dedicated to ensuring that your experience with us is nothing short of exceptional.</p><p>
At <span>{{ config('app.client_name') }}</span>, we believe that true hospitality knows no bounds. It is our privilege and responsibility to extend a warm welcome to all who enter our doors, creating a space where everyone feels valued, respected, and cherished.</p><p>
As we continue our journey to fulfill our vision of becoming Rwanda's leading Catholic hotel, we remain steadfast in our commitment to upholding the principles of Catholic hospitality and creating meaningful experiences that leave a lasting impression on our guests.</p><p>
The <span>{{ config('app.client_name') }}</span> aims to be a beacon of hospitality and a source of revenue to further fund the charitable activities and initiatives of the Kabgayi Diocese.

<h1>Vision</h1>
To be Rwanda’s leading catholic hotel radiating warmth and exceptional customer-centered service while embracing the diversity of our guests with open arms. 
<h1>Mission</h1>
 To exemplify catholic hospitality welcoming all guests with open hearts and minds. 
</p>
    </div>
  </div>
</div>

