@extends('admin.admin_dashboard')
@section('admin') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@php
  $bookings = App\Models\Booking::latest()->get();
  $pending = App\Models\Booking::where('status','0')->get();
  $complete = App\Models\Booking::where('status','1')->get();
  $checkedIn = App\Models\Booking::where('status','2')->get();
  $cancelled = App\Models\Booking::where('status','4')->get();
  $totalPrice = App\Models\Booking::sum('total_price');

  $today = Carbon\Carbon::now()->toDateString();
  $todayprice = App\Models\Booking::whereDate('created_at',$today)->sum('total_price');
  $todayBookings = App\Models\Booking::whereDate('created_at',$today)->count();

  // This month stats
  $monthStart = Carbon\Carbon::now()->startOfMonth();
  $monthPrice = App\Models\Booking::where('created_at', '>=', $monthStart)->sum('total_price');
  $monthBookings = App\Models\Booking::where('created_at', '>=', $monthStart)->count();

  // Occupancy: guests currently checked in
  $currentGuests = App\Models\Booking::where('status', 2)->count();
  $totalRoomNumbers = App\Models\RoomNumber::where('status', 'Active')->count();
  $occupancyRate = $totalRoomNumbers > 0 ? round(($currentGuests / $totalRoomNumbers) * 100) : 0;

  // Reviews
  $pendingReviews = App\Models\Review::where('is_approved', false)->count();

  $allData = App\Models\Booking::orderBy('id','desc')->limit(10)->get();

  // Monthly revenue for chart (last 6 months)
  $monthlyRevenue = [];
  $monthlyLabels = [];
  for ($i = 5; $i >= 0; $i--) {
      $month = Carbon\Carbon::now()->subMonths($i);
      $monthlyLabels[] = $month->format('M Y');
      $monthlyRevenue[] = App\Models\Booking::whereYear('created_at', $month->year)
          ->whereMonth('created_at', $month->month)
          ->sum('total_price');
  }
@endphp

<div class="page-content">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
       <div class="col">
         <div class="card radius-10 border-start border-0 border-4 border-info">
            <div class="card-body">
                    <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Bookings</p>
                        <h4 class="my-1 text-info">{{ count($bookings) }}</h4>
                        <p class="mb-0 font-13">Today: {{ $todayBookings }} | ${{ $todayprice }}</p>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-cart'></i>
                    </div>
                </div>
            </div>
         </div>
       </div>
       <div class="col">
        <div class="card radius-10 border-start border-0 border-4 border-danger">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                       <p class="mb-0 text-secondary">Pending Bookings</p>
                       <h4 class="my-1 text-danger">{{ count($pending) }}</h4>
                       <p class="mb-0 font-13">Cancelled: {{ count($cancelled) }}</p>
                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bxs-wallet'></i>
                   </div>
               </div>
           </div>
        </div>
      </div>
      <div class="col">
        <div class="card radius-10 border-start border-0 border-4 border-success">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                       <p class="mb-0 text-secondary">Occupancy Rate</p>
                       <h4 class="my-1 text-success">{{ $occupancyRate }}%</h4>
                       <p class="mb-0 font-13">{{ $currentGuests }} / {{ $totalRoomNumbers }} rooms</p>
                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-home' ></i>
                   </div>
               </div>
           </div>
        </div>
      </div>
      <div class="col">
        <div class="card radius-10 border-start border-0 border-4 border-warning">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                       <p class="mb-0 text-secondary">Monthly Revenue</p>
                       <h4 class="my-1 text-warning">${{ number_format($monthPrice, 2) }}</h4>
                       <p class="mb-0 font-13">Total: ${{ number_format($totalPrice, 2) }}</p>
                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-dollar-circle'></i>
                   </div>
               </div>
           </div>
        </div>
      </div> 
    </div><!--end row-->

    <div class="row">
       <div class="col-12 col-lg-8 d-flex">
          <div class="card radius-10 w-100">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Revenue Overview (Last 6 Months)</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
               <canvas id="revenueChart"></canvas>
            </div>
          </div>
       </div>
       <div class="col-12 col-lg-4 d-flex">
          <div class="card radius-10 w-100">
            <div class="card-header">
                <h6 class="mb-0">Booking Status</h6>
            </div>
            <div class="card-body">
               <canvas id="statusChart"></canvas>
            </div>
            <div class="card-footer text-center">
                <p class="mb-0 font-13">
                    @if($pendingReviews > 0)
                    <a href="{{ route('all.review') }}" class="text-danger">{{ $pendingReviews }} reviews pending approval</a>
                    @else
                    All reviews approved
                    @endif
                </p>
            </div>
          </div>
       </div>
    </div><!--end row-->
       </div>
       



    </div><!--end row-->

     <div class="card radius-10">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">Recent Booking</h6>
                </div>
                
            </div>
        </div>

        <div class="card-body">
          <div class="table-responsive">
              <table class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th>Sl</th>
                          <th>B No</th>
                          <th>B Date</th>
                          <th>Customer</th>
                          <th>Room</th>
                          <th>Check IN/Out</th>
                          <th>Total Room</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>
                     @foreach ($allData as $key=> $item ) 
                      <tr>
                          <td>{{ $key+1 }}</td>
                          <td> <a href="{{ route('edit_booking',$item->id) }}"> {{ $item->code }} </a></td>
                          <td> {{ $item->created_at->format('d/m/Y') }} </td>
                          <td> {{ $item['user']['name'] }} </td>
                          <td> {{ ($item['room']['type']['name'])??0 }} </td>
                          <td> <span class="badge bg-primary">{{ $item->check_in }}</span>   <span class="badge bg-warning text-dark">{{ $item->check_out }}</span> </td>
                          <td> {{ $item->number_of_rooms }} </td>
                          <td>
                            @if($item->status == 0)
                              <span class="badge bg-warning">Pending</span>
                            @elseif($item->status == 1)
                              <span class="badge bg-success">Confirmed</span>
                            @elseif($item->status == 2)
                              <span class="badge bg-info">Checked In</span>
                            @elseif($item->status == 3)
                              <span class="badge bg-secondary">Checked Out</span>
                            @elseif($item->status == 4)
                              <span class="badge bg-danger">Cancelled</span>
                            @endif
                          </td>
                    
                           
                      </tr>
                      @endforeach 
                    
                  </tbody>
               
              </table>
          </div>
      </div>


        </div>
 
         
</div>


<script>
  // Revenue Chart (Bar - Last 6 months)
  var revenueCtx = document.getElementById('revenueChart').getContext('2d');
  new Chart(revenueCtx, {
      type: 'bar',
      data: {
          labels: @json($monthlyLabels),
          datasets: [{
              label: 'Revenue ($)',
              data: @json($monthlyRevenue),
              backgroundColor: 'rgba(12, 77, 162, 0.6)',
              borderColor: 'rgba(12, 77, 162, 1)',
              borderWidth: 1
          }]
      },
      options: {
          responsive: true,
          scales: { y: { beginAtZero: true } }
      }
  });

  // Status Doughnut Chart
  var statusCtx = document.getElementById('statusChart').getContext('2d');
  new Chart(statusCtx, {
      type: 'doughnut',
      data: {
          labels: ['Pending', 'Confirmed', 'Checked In', 'Cancelled'],
          datasets: [{
              data: [{{ count($pending) }}, {{ count($complete) }}, {{ count($checkedIn) }}, {{ count($cancelled) }}],
              backgroundColor: ['#ffc107', '#198754', '#0dcaf0', '#dc3545'],
          }]
      },
      options: { responsive: true }
  });
</script>

@endsection