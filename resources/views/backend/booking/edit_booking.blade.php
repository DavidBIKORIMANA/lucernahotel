@extends('admin.admin_dashboard')
@section('admin') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">

    {{-- ===== STATUS INFO CARDS ===== --}}
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5">
        <div class="col">
         <div class="card radius-10 border-start border-0 border-3 border-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Booking No:</p>
                        <h6 class="my-1 text-info">{{ $editData->code }}</h6>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-cart'></i></div>
                </div>
            </div>
         </div>
       </div>

       <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-danger">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                       <p class="mb-0 text-secondary">Booking Date:</p>
                       <h6 class="my-1 text-danger">{{ \Carbon\Carbon::parse($editData->created_at)->format('d/m/Y') }}</h6>
                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bxs-wallet'></i></div>
               </div>
           </div>
        </div>
      </div>

      <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-success">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                       <p class="mb-0 text-secondary">Payment Method</p>
                       <h6 class="my-1 text-success">{{ $editData->payment_method_label }}</h6>
                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2'></i></div>
               </div>
           </div>
        </div>
      </div>

      <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-warning">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                       <p class="mb-0 text-secondary">Payment Status</p>
                       <h6 class="my-1">
                         @if ($editData->payment_status == 1)
                            <span class="badge bg-success">Paid</span>
                         @elseif ($editData->payment_status == 2)
                            <span class="badge bg-info">Refunded</span>
                         @elseif ($editData->payment_status == 3)
                            <span class="badge bg-warning text-dark">Partial</span>
                         @else
                            <span class="badge bg-danger">Unpaid</span>
                         @endif
                       </h6>
                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-credit-card'></i></div>
               </div>
           </div>
        </div>
      </div> 

      <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-primary">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                       <p class="mb-0 text-secondary">Booking Status</p>
                       <h6 class="my-1">
                        @if ($editData->status == 0)
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif ($editData->status == 1)
                            <span class="badge bg-success">Confirmed</span>
                        @elseif ($editData->status == 2)
                            <span class="badge bg-info">Checked In</span>
                        @elseif ($editData->status == 3)
                            <span class="badge bg-secondary">Checked Out</span>
                        @elseif ($editData->status == 4)
                            <span class="badge bg-danger">Cancelled</span>
                        @elseif ($editData->status == 5)
                            <span class="badge bg-dark">Denied</span>
                        @endif
                       </h6>
                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-check-circle'></i></div>
               </div>
           </div>
        </div>
      </div> 
    </div>

    {{-- ===== QUICK ACTION BUTTONS ===== --}}
    @if(in_array($editData->status, [0, 1, 2]))
    <div class="row mb-3">
        <div class="col-12">
            <div class="card radius-10">
                <div class="card-body d-flex flex-wrap gap-2 align-items-center">
                    <strong class="me-3">Quick Actions:</strong>

                    @if($editData->status == 0)
                        <a href="{{ route('booking.confirm', $editData->id) }}" class="btn btn-success btn-sm" onclick="return confirm('Confirm this booking?')">
                            <i class="bx bx-check-circle"></i> Confirm Booking
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#denyModal">
                            <i class="bx bx-x-circle"></i> Deny Booking
                        </button>
                    @endif

                    @if($editData->status == 1 && $editData->payment_status != 1)
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#verifyPaymentModal">
                            <i class="bx bx-check-shield"></i> Verify Payment
                        </button>
                    @endif

                    @if($editData->payment_proof)
                        <a href="{{ route('booking.payment.proof', $editData->id) }}" target="_blank" class="btn btn-outline-info btn-sm">
                            <i class="bx bx-image"></i> View Payment Proof
                        </a>
                    @endif

                    <a href="{{ route('download.invoice', $editData->id) }}" class="btn btn-warning btn-sm">
                        <i class="lni lni-download"></i> Download Invoice
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
       <div class="col-12 col-lg-8 d-flex">
          <div class="card radius-10 w-100"> 
          <div class="card-body">
              <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Room Type</th>
                            <th>Total Room</th>
                            <th>Price</th>
                            <th>Check In / Out Date</th>
                            <th>Total Days</th>
                            <th>Total </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $editData->room->type->name }}</td>
                            <td>{{ $editData->number_of_rooms }}</td>
                            <td>{{ number_format($editData->actual_price) }} $</td>
                            <td>
                                <span class="badge bg-primary">{{ $editData->check_in }}</span>  /<br> 
                                <span class="badge bg-warning text-dark">{{ $editData->check_out }}</span></td>
                            <td>{{ $editData->total_night }}</td>
                            <td>{{ number_format($editData->actual_price *  $editData->number_of_rooms) }} $</td>

                        </tr>
                    </tbody> 
                </table>
                <div class="col-md-6" style="float: right">
                    <style>
                        .test_table td{text-align: right;}
                    </style>
                    <table class="table test_table" style="float: right" border="none">
                        <tr>
                            <td>Subtotal</td>
                            <td>{{ number_format($editData->subtotal) }} $</td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td>{{ number_format($editData->discount) }} $</td>
                        </tr>
                        <tr style="font-weight:bold;border-top:2px solid #0c4da2;">
                            <td>Grand Total</td>
                            <td>{{ number_format($editData->total_price) }} $</td>
                        </tr>
                    </table>

                </div>
 

    <div style="clear: both"></div>
    <div style="margin-top: 40px; margin-bottom:20px;">
        @if (!in_array($editData->status, [4, 5]))
        <a href="javascript:void(0)" class="btn btn-primary assign_room"> Assign Room</a>
        @else
        <p class="my-1 text-danger">Cannot assign rooms to cancelled/denied bookings</p>
        @endif
    </div>
    @php
        $assign_rooms = App\Models\BookingRoomList::with('room_number')->where('booking_id',$editData->id)->get();
    @endphp

    @if (count($assign_rooms) > 0) 
    <table class="table table-bordered">
        <tr>
            <th>Room Number</th>
            <th>Action</th>
        </tr>
        @foreach ($assign_rooms as $assign_room)  
        <tr>
            <td>{{ $assign_room->room_number->room_no }}</td>
            <td>
                <a href="{{ route('assign_room_delete',$assign_room->id) }}" id="delete">Delete</a>
            </td>
        </tr>
        @endforeach 
    </table>
    @else
    <div class="alert alert-danger text-center">
        Not Found Assign Room
    </div>
    @endif


                </div> 
                 {{-- // end table responsive --}}

         <form action="{{ route('update.booking.status',$editData->id) }}" method="POST">
                    @csrf

                    <div class="row" style="margin-top: 40px;">
                        <div class="col-md-5">
                            <label for="">Payment Status</label>
        <select name="payment_status" id="input7" class="form-select">
            <option value="0" {{ $editData->payment_status == 0 ? 'selected':''}}> Unpaid </option>
            <option value="1" {{ $editData->payment_status == 1 ? 'selected':''}}>Paid </option> 
            <option value="2" {{ $editData->payment_status == 2 ? 'selected':''}}>Refunded </option> 
            <option value="3" {{ $editData->payment_status == 3 ? 'selected':''}}>Partial </option> 
        </select>
                  </div>


                  <div class="col-md-5">
                    <label for="">Booking Status</label>
<select name="status" id="input7" class="form-select">
    <option value="0" {{ $editData->status == 0 ? 'selected':''}}> Pending </option>
    <option value="1" {{ $editData->status == 1 ?'selected':''}}>Confirmed </option>
    <option value="2" {{ $editData->status == 2 ?'selected':''}}>Checked In </option>
    <option value="3" {{ $editData->status == 3 ?'selected':''}}>Checked Out </option>
    <option value="4" {{ $editData->status == 4 ?'selected':''}}>Cancelled </option>
    <option value="5" {{ $editData->status == 5 ?'selected':''}}>Denied </option>
</select>
          </div>

          <div class="col-md-10 mt-2" id="cancellation_reason_box" style="{{ $editData->status == 4 ? '' : 'display:none;' }}">
            <label for="">Cancellation Reason</label>
            <textarea name="cancellation_reason" class="form-control" rows="2">{{ $editData->cancellation_reason }}</textarea>
          </div>

          <div class="col-md-12" style="margin-top: 20px;">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('download.invoice',$editData->id) }}" class="btn btn-warning px-3 radius-10"><i class="lni lni-download"></i> Download Invoice</a>
          </div>

                    </div> 

                 </form>  
               
            </div>  
          </div>
       </div>





       <div class="col-12 col-lg-4">
           <div class="card radius-10 w-100">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Manage Room and Date </h6>
                    </div>
                  
                </div>
            </div>
               <div class="card-body">
                <form action="{{ route('update.booking', $editData->id) }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label for="">CheckIn</label>
                            <input type="date" required name="check_in" id="check_in" class="form-control" value="{{ $editData->check_in }}">
                        </div>

                        <div class="col-md-12 mb-2">
                            <label for="">CheckOut</label>
                            <input type="date" required name="check_out" id="check_out" class="form-control" value="{{ $editData->check_out }}">
                        </div>

                        <div class="col-md-12 mb-2">
                            <label for="">Room</label>
                            <input type="number" required name="number_of_rooms" class="form-control" value="{{ $editData->number_of_rooms }}">
                        </div>

        <input type="hidden" name="available_room" id="available_room"  class="form-control"  >

                        <div class="col-md-12 mb-2">
     <label for="">Availability: <span class="text-success availability"></span> </label> 
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">Update </button>

                        </div>


                    </div>
                </form>
                 
               </div>
              
           </div>




           <div class="card radius-10 w-100">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Customer Infromation </h6>
                    </div>
                  
                </div>
            </div>
    <div class="card-body">
    <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center" style="background:transparent;color:var(--text-2);border-color:var(--border3);">Name <span class="badge bg-success rounded-pill">{{ $editData['user']['name'] }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center" style="background:transparent;color:var(--text-2);border-color:var(--border3);">Email <span class="badge bg-danger rounded-pill">{{ $editData['user']['email'] }} </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center" style="background:transparent;color:var(--text-2);border-color:var(--border3);">Phone <span class="badge bg-primary rounded-pill">{{ $editData['user']['phone'] }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center" style="background:transparent;color:var(--text-2);border-color:var(--border3);">Identity <span class="badge bg-primary rounded-pill">{{ $editData->nid}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center" style="background:transparent;color:var(--text-2);border-color:var(--border3);">Country <span class="badge bg-warning rounded-pill" style="color:var(--bg-void)!important;">{{ $editData->country }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center" style="background:transparent;color:var(--text-2);border-color:var(--border3);">State <span class="badge bg-success rounded-pill">{{ $editData->state }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center" style="background:transparent;color:var(--text-2);border-color:var(--border3);">Zip Code <span class="badge bg-danger rounded-pill"> {{ $editData->zip_code }} </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center" style="background:transparent;color:var(--text-2);border-color:var(--border3);">Address <span class="badge bg-info rounded-pill"> {{ $editData->address }} </span>
        </li>
    </ul>
    </div>

           </div>
           {{-- // end card radius-10 w-100 --}}




       </div>
    </div><!--end row-->

    {{-- ===== PAYMENT DETAILS CARD ===== --}}
    @if(in_array($editData->payment_method, ['MTN_MOMO', 'AIRTEL_MOMO', 'BANK_TRANSFER']))
    <div class="row mt-3">
        <div class="col-12">
            <div class="card radius-10">
                <div class="card-header bg-transparent">
                    <h6 class="mb-0"><i class="bx bx-credit-card"></i> Payment Details</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($editData->payment_phone)
                        <div class="col-md-3">
                            <strong>Phone:</strong><br>
                            <span>{{ $editData->payment_phone }}</span>
                        </div>
                        @endif
                        @if($editData->payment_bank_name)
                        <div class="col-md-3">
                            <strong>Bank:</strong><br>
                            <span>{{ $editData->payment_bank_name }}</span>
                        </div>
                        @endif
                        @if($editData->payment_bank_ref)
                        <div class="col-md-3">
                            <strong>Reference:</strong><br>
                            <span>{{ $editData->payment_bank_ref }}</span>
                        </div>
                        @endif
                        @if($editData->transation_id)
                        <div class="col-md-3">
                            <strong>Transaction ID:</strong><br>
                            <span>{{ $editData->transation_id }}</span>
                        </div>
                        @endif
                        @if($editData->payment_proof)
                        <div class="col-md-3 mt-2">
                            <strong>Payment Proof:</strong><br>
                            <a href="{{ route('booking.payment.proof', $editData->id) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1">
                                <i class="bx bx-image"></i> View Proof
                            </a>
                        </div>
                        @endif
                    </div>

                    {{-- Payment Transactions History --}}
                    @php
                        $transactions = \App\Models\PaymentTransaction::where('booking_id', $editData->id)->orderBy('id','desc')->get();
                    @endphp
                    @if($transactions->count() > 0)
                    <hr>
                    <h6>Transaction History</h6>
                    <table class="table table-sm table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Method</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Reference</th>
                                <th>Verified By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $txn)
                            <tr>
                                <td>{{ $txn->created_at->format('d/m/Y') }}</td>
                                <td>{{ $txn->method_label }}</td>
                                <td>{{ number_format($txn->amount) }} {{ $txn->currency }}</td>
                                <td>
                                    @if($txn->status == 'success') <span class="badge bg-success">Success</span>
                                    @elseif($txn->status == 'pending') <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($txn->status == 'failed') <span class="badge bg-danger">Failed</span>
                                    @endif
                                </td>
                                <td>{{ $txn->transaction_id ?: $txn->bank_ref ?: '-' }}</td>
                                <td>{{ $txn->verified_at ? optional($txn->verifier)->name.' ('.$txn->verified_at->format('d/m').')' : '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== ADMIN NOTES ===== --}}
    @if($editData->admin_notes)
    <div class="row mt-2">
        <div class="col-12">
            <div class="alert alert-info">
                <strong><i class="bx bx-note"></i> Admin Notes:</strong> {{ $editData->admin_notes }}
            </div>
        </div>
    </div>
    @endif
 
</div>


    {{-- ===== DENY BOOKING MODAL ===== --}}
    <div class="modal fade" id="denyModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('booking.deny', $editData->id) }}" method="POST">
                    @csrf
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title"><i class="bx bx-x-circle"></i> Deny Booking</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to deny booking <strong>{{ $editData->code }}</strong>?</p>
                        <div class="form-group">
                            <label>Reason for Denial <span class="text-danger">*</span></label>
                            <textarea name="denial_reason" class="form-control" rows="3" required placeholder="Enter reason for denying this booking..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Deny Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===== VERIFY PAYMENT MODAL ===== --}}
    <div class="modal fade" id="verifyPaymentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('booking.verify.payment', $editData->id) }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title"><i class="bx bx-check-shield"></i> Verify Payment</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Booking: <strong>{{ $editData->code }}</strong></p>
                        <p>Amount: <strong>{{ number_format($editData->total_price) }} $</strong></p>
                        <p>Method: <strong>{{ $editData->payment_method_label }}</strong></p>
                        @if($editData->payment_phone)
                            <p>Phone: <strong>{{ $editData->payment_phone }}</strong></p>
                        @endif
                        @if($editData->payment_bank_ref)
                            <p>Bank Ref: <strong>{{ $editData->payment_bank_ref }}</strong></p>
                        @endif
                        @if($editData->payment_proof)
                            <p><a href="{{ route('booking.payment.proof', $editData->id) }}" target="_blank">View Payment Proof</a></p>
                        @endif
                        <hr>
                        <div class="form-group mb-3">
                            <label>Action</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="payment_action" value="approve" id="payApprove" checked>
                                    <label class="form-check-label text-success" for="payApprove"><strong>Approve Payment</strong></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="payment_action" value="reject" id="payReject">
                                    <label class="form-check-label text-danger" for="payReject"><strong>Reject Payment</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Admin Notes</label>
                            <textarea name="admin_notes" class="form-control" rows="2" placeholder="Optional notes..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===== ASSIGN ROOM MODAL ===== --}}
    <div class="modal fade myModal" id="exampleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>


<script>
     $(document).ready(function (){
        getAvaility();

        $(".assign_room").on('click', function(){
            $.ajax({
                url: "{{ route('assign_room',$editData->id) }}",
                success: function(data){
                    $('.myModal .modal-body').html(data);
                    $('.myModal').modal('show');
                }
            });
            return false;
        });

        // Show/hide cancellation reason
        $('select[name="status"]').on('change', function(){
            if ($(this).val() == '4') {
                $('#cancellation_reason_box').show();
            } else {
                $('#cancellation_reason_box').hide();
            }
        });

     });

    function getAvaility(){
        var check_in = $('#check_in').val();
        var check_out = $('#check_out').val();
        var room_id = "{{ $editData->rooms_id }}";

        $.ajax({
         url: "{{ route('check_room_availability') }}",
         data: {room_id:room_id, check_in:check_in, check_out:check_out},
         success: function(data){
            $(".availability").text(data['available_room']);
            $("#available_room").val(data['available_room']);
         }
      }); 

    }
   

</script>

@endsection