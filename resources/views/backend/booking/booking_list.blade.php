@extends('admin.admin_dashboard')
@section('admin') 

<div class="page-content"> 
	<!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
         
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Bookings</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.room.list') }}" class="btn btn-primary px-5">Add Reservation</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    {{-- ===== Summary Cards ===== --}}
    @php
        $pending   = $allData->where('status', 0)->count();
        $confirmed = $allData->where('status', 1)->count();
        $checkedIn = $allData->where('status', 2)->count();
        $checkedOut= $allData->where('status', 3)->count();
        $cancelled = $allData->where('status', 4)->count();
        $totalRevenue = $allData->where('payment_status', 1)->sum('total_price');
        $unpaidTotal  = $allData->whereIn('payment_status', [0, 3])->sum('total_price');
    @endphp
    <div class="row mb-3">
        <div class="col-md-2 col-6 mb-2">
            <div class="card border-start border-warning border-3 mb-0">
                <div class="card-body py-2 px-3">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-muted" style="font-size:11px">Pending</p>
                            <h5 class="mb-0 text-warning">{{ $pending }}</h5>
                        </div>
                        <div class="ms-auto"><i class="bx bx-time-five fs-3 text-warning"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6 mb-2">
            <div class="card border-start border-success border-3 mb-0">
                <div class="card-body py-2 px-3">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-muted" style="font-size:11px">Confirmed</p>
                            <h5 class="mb-0 text-success">{{ $confirmed }}</h5>
                        </div>
                        <div class="ms-auto"><i class="bx bx-check-circle fs-3 text-success"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6 mb-2">
            <div class="card border-start border-info border-3 mb-0">
                <div class="card-body py-2 px-3">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-muted" style="font-size:11px">Checked In</p>
                            <h5 class="mb-0 text-info">{{ $checkedIn }}</h5>
                        </div>
                        <div class="ms-auto"><i class="bx bx-log-in-circle fs-3 text-info"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6 mb-2">
            <div class="card border-start border-secondary border-3 mb-0">
                <div class="card-body py-2 px-3">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-muted" style="font-size:11px">Checked Out</p>
                            <h5 class="mb-0 text-secondary">{{ $checkedOut }}</h5>
                        </div>
                        <div class="ms-auto"><i class="bx bx-log-out-circle fs-3 text-secondary"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6 mb-2">
            <div class="card border-start border-success border-3 mb-0">
                <div class="card-body py-2 px-3">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-muted" style="font-size:11px">Revenue (Paid)</p>
                            <h6 class="mb-0 text-success" style="font-size:13px">{{ number_format($totalRevenue) }} RwF</h6>
                        </div>
                        <div class="ms-auto"><i class="bx bx-wallet fs-3 text-success"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6 mb-2">
            <div class="card border-start border-danger border-3 mb-0">
                <div class="card-body py-2 px-3">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-muted" style="font-size:11px">Unpaid</p>
                            <h6 class="mb-0 text-danger" style="font-size:13px">{{ number_format($unpaidTotal) }} RwF</h6>
                        </div>
                        <div class="ms-auto"><i class="bx bx-error-circle fs-3 text-danger"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Booking #</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Room / Hall</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Rooms</th>
                            <th>Guests</th>
                            <th>Amount (RwF)</th>
                            <th>Payment</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th style="min-width:160px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($allData as $key=> $item ) 
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><a href="{{ route('edit_booking',$item->id) }}" class="fw-bold">{{ $item->code }}</a></td>
                            <td><small>{{ $item->created_at->format('d/m/Y') }}</small></td>
                            <td>
                                <strong>{{ $item['user']['name'] }}</strong><br>
                                <small class="text-muted">{{ $item['user']['email'] }}</small>
                            </td>
                            <td>{{ $item['room']['type']['name'] ?? 'N/A' }}</td>
                            <td><span class="badge bg-primary">{{ $item->check_in->format('d M Y') }}</span></td>
                            <td><span class="badge bg-warning text-dark">{{ $item->check_out->format('d M Y') }}</span></td>
                            <td class="text-center">{{ $item->number_of_rooms }}</td>
                            <td class="text-center">{{ $item->persion }}</td>
                            <td class="text-end">
                                <strong>{{ number_format($item->total_price) }}</strong>
                                @if($item->discount > 0)
                                    <br><small class="text-success">-{{ $item->discount }}% off</small>
                                @endif
                                @if($item->subtotal && $item->subtotal != $item->total_price)
                                    <br><small class="text-muted"><s>{{ number_format($item->subtotal) }}</s></small>
                                @endif
                            </td>
                            <td>
                                @if ($item->payment_status == 1)
                                    <span class="badge bg-success">Paid</span>
                                @elseif ($item->payment_status == 2)
                                    <span class="badge bg-info">Refunded</span>
                                @elseif ($item->payment_status == 3)
                                    <span class="badge bg-warning text-dark">Partial</span>
                                @else
                                    <span class="badge bg-danger">Unpaid</span>
                                @endif
                            </td>
                            <td><small>{{ $item->payment_method_label }}</small></td>
                            <td>
                                @if ($item->status == 0)
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($item->status == 1)
                                    <span class="badge bg-success">Confirmed</span>
                                @elseif ($item->status == 2)
                                    <span class="badge bg-info">Checked In</span>
                                @elseif ($item->status == 3)
                                    <span class="badge bg-secondary">Checked Out</span>
                                @elseif ($item->status == 4)
                                    <span class="badge bg-danger">Cancelled</span>
                                @elseif ($item->status == 5)
                                    <span class="badge bg-dark">Denied</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    {{-- View / Edit --}}
                                    <a href="{{ route('edit_booking',$item->id) }}" class="btn btn-sm btn-outline-primary" title="View / Edit">
                                        <i class="bx bx-edit"></i>
                                    </a>

                                    {{-- Actions dropdown --}}
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="Actions">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            {{-- STATUS ACTIONS --}}
                                            @if($item->status == 0)
                                                <li>
                                                    <a class="dropdown-item text-success" href="{{ route('booking.confirm', $item->id) }}"
                                                       onclick="return confirm('Confirm this booking?')">
                                                        <i class="bx bx-check-circle me-1"></i> Confirm
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-dark" href="#" data-bs-toggle="modal" data-bs-target="#denyModal{{ $item->id }}">
                                                        <i class="bx bx-x-circle me-1"></i> Deny
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $item->id }}">
                                                        <i class="bx bx-block me-1"></i> Cancel
                                                    </a>
                                                </li>
                                            @endif

                                            @if($item->status == 1)
                                                <li>
                                                    <a class="dropdown-item text-info" href="{{ route('booking.checkin', $item->id) }}"
                                                       onclick="return confirm('Check in this guest?')">
                                                        <i class="bx bx-log-in-circle me-1"></i> Check In
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $item->id }}">
                                                        <i class="bx bx-block me-1"></i> Cancel
                                                    </a>
                                                </li>
                                            @endif

                                            @if($item->status == 2)
                                                <li>
                                                    <a class="dropdown-item text-secondary" href="{{ route('booking.checkout', $item->id) }}"
                                                       onclick="return confirm('Check out this guest?')">
                                                        <i class="bx bx-log-out-circle me-1"></i> Check Out
                                                    </a>
                                                </li>
                                            @endif

                                            {{-- PAYMENT ACTIONS --}}
                                            @if(!in_array($item->status, [4, 5]))
                                                <li><hr class="dropdown-divider"></li>
                                                <li class="dropdown-header">Payment</li>
                                                @if($item->payment_status != 1)
                                                    <li>
                                                        <form action="{{ route('booking.mark.payment', $item->id) }}" method="POST"
                                                              onsubmit="return confirm('Mark this booking as PAID?')">
                                                            @csrf
                                                            <input type="hidden" name="payment_status" value="1">
                                                            <button type="submit" class="dropdown-item text-success">
                                                                <i class="bx bx-check-double me-1"></i> Mark as Paid
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endif
                                                @if($item->payment_status == 1)
                                                    <li>
                                                        <form action="{{ route('booking.mark.payment', $item->id) }}" method="POST"
                                                              onsubmit="return confirm('Mark this booking as REFUNDED?')">
                                                            @csrf
                                                            <input type="hidden" name="payment_status" value="2">
                                                            <button type="submit" class="dropdown-item text-info">
                                                                <i class="bx bx-undo me-1"></i> Mark as Refunded
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endif
                                                @if($item->payment_status != 3 && $item->payment_status != 1)
                                                    <li>
                                                        <form action="{{ route('booking.mark.payment', $item->id) }}" method="POST"
                                                              onsubmit="return confirm('Mark this payment as PARTIAL?')">
                                                            @csrf
                                                            <input type="hidden" name="payment_status" value="3">
                                                            <button type="submit" class="dropdown-item text-warning">
                                                                <i class="bx bx-adjust me-1"></i> Mark as Partial
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endif
                                            @endif

                                            {{-- DOWNLOAD INVOICE --}}
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('download.invoice', $item->id) }}">
                                                    <i class="bx bx-download me-1"></i> Download Invoice
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ===== CANCEL MODALS ===== --}}
    @foreach ($allData as $item)
        @if(in_array($item->status, [0, 1]))
        <div class="modal fade" id="cancelModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('booking.cancel', $item->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Cancel Booking #{{ $item->code }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to cancel this booking?</p>
                            <p><strong>Guest:</strong> {{ $item->name }}<br>
                               <strong>Room:</strong> {{ $item['room']['type']['name'] ?? 'N/A' }}<br>
                               <strong>Amount:</strong> {{ number_format($item->total_price) }} RwF</p>
                            <div class="mb-3">
                                <label class="form-label">Cancellation Reason</label>
                                <textarea name="cancellation_reason" class="form-control" rows="3" placeholder="Enter reason for cancellation..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Cancel Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    @endforeach

    {{-- ===== DENY MODALS ===== --}}
    @foreach ($allData as $item)
        @if($item->status == 0)
        <div class="modal fade" id="denyModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('booking.deny', $item->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Deny Booking #{{ $item->code }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>This will deny the booking and free up the room dates.</p>
                            <p><strong>Guest:</strong> {{ $item->name }}<br>
                               <strong>Room:</strong> {{ $item['room']['type']['name'] ?? 'N/A' }}<br>
                               <strong>Amount:</strong> {{ number_format($item->total_price) }} RwF</p>
                            <div class="mb-3">
                                <label class="form-label">Denial Reason <span class="text-danger">*</span></label>
                                <textarea name="denial_reason" class="form-control" rows="3" required placeholder="Enter reason for denial..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark">Deny Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    @endforeach
     
</div>

@endsection