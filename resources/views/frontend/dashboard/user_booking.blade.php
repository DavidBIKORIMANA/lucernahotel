@extends('frontend.main_master')
@section('main')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <!-- Inner Banner -->
 <!--  <div class="inner-banner inner-bg6">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>User Booking List </li>
            </ul>
            <h3>User Booking List</h3>
        </div>
    </div>
</div> -->
<!-- Inner Banner End -->

<!-- Service Details Area -->
<div class="service-details-area pt-100 pb-70">
    <div class="container">
        <div class="row">
             <div class="col-lg-3">

                @include('frontend.dashboard.user_menu')

            </div>


            <div class="col-lg-9">
                <div class="service-article">
                    

    <section class="checkout-area pb-70">
    <div class="container">
        <form action="{{ route('password.change.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="billing-details">
                        <h3 class="title">User Booking List  </h3>

    

    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">B No</th>
            <th scope="col">B Date</th>
            <th scope="col">Customer</th>
            <th scope="col">Room</th>
            <th scope="col">Check In/Out</th>
            <th scope="col">Total Room</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($allData as $item) 
            <tr>
            <td> <a href="{{ route('user.invoice',$item->id) }}">{{ $item->code }}</a> </td>
            <td>{{ $item->created_at->format('d/m/Y') }}</td>
            <td>{{ $item['user']['name'] }}</td>
            <td>{{ $item['room']['type']['name']??"No type Available" }}</td>
            <td> <span class="badge bg-primary">{{ $item->check_in }}</span>  <span class="badge bg-warning text-dark">{{ $item->check_out }}</span> </td>
            <td>{{ $item->number_of_rooms }}</td>
            <td> 
                @if ($item->status == 0)
                <span class="badge bg-warning">Pending</span>
                @elseif ($item->status == 1)
                <span class="badge bg-success">Confirmed</span>
                @elseif ($item->status == 2)
                <span class="badge bg-info">Checked In</span>
                @elseif ($item->status == 3)
                <span class="badge bg-secondary">Checked Out</span>
                @elseif ($item->status == 4)
                <span class="badge bg-danger">Cancelled</span>
                @endif
            </td>
            <td>
                @php $existingReview = \App\Models\Review::where('booking_id', $item->id)->where('user_id', Auth::id())->first(); @endphp
                @if($item->status == 3 && !$existingReview)
                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $item->id }}">Review</button>
                @elseif($existingReview)
                <span class="text-success"><i class="bx bx-check"></i> Reviewed</span>
                @endif
            </td>
            </tr>

            {{-- Review Modal --}}
            @if($item->status == 3 && !$existingReview)
            <div class="modal fade" id="reviewModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('store.review') }}" method="POST">
                            @csrf
                            <input type="hidden" name="booking_id" value="{{ $item->id }}">
                            <input type="hidden" name="room_id" value="{{ $item->rooms_id }}">
                            <div class="modal-header">
                                <h5 class="modal-title">Leave a Review</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Rating</label>
                                    <select name="rating" class="form-select" required>
                                        <option value="">Select...</option>
                                        <option value="5">5 - Excellent</option>
                                        <option value="4">4 - Very Good</option>
                                        <option value="3">3 - Good</option>
                                        <option value="2">2 - Fair</option>
                                        <option value="1">1 - Poor</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Title (optional)</label>
                                    <input type="text" name="title" class="form-control" maxlength="255">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Your Review</label>
                                    <textarea name="comment" class="form-control" rows="4" required maxlength="1000"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit Review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif

            @endforeach
            
        </tbody>
        </table>



</div>
</div>
</div>
</form>      
        
    </div>
</section>
                    
                </div>
            </div>

           
        </div>
    </div>
</div>
<!-- Service Details Area End -->

 


@endsection