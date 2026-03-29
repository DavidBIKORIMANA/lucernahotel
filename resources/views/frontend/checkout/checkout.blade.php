@extends('frontend.main_master')
@section('main')

<section class="checkout-area pt-100 pb-70">
    <div class="container">
        <form method="post" role="form" action="{{ route('checkout.store') }}" enctype="multipart/form-data" class="checkout-form require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="billing-details">
                        <h3 class="title">Billing Details</h3>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Country <span class="required">*</span></label>
                                    <input type="text" name="country" class="form-control" value="{{ old('country') }}">
                                    @error('country') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>National ID / Passport <span class="required">*</span></label>
                                    <input type="text" name="nid" class="form-control" value="{{ old('nid') }}">
                                    @error('nid') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Name <span class="required">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', \Auth::user()->name) }}">
                                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', \Auth::user()->email) }}">
                                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Phone <span class="required">*</span></label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone', \Auth::user()->phone) }}">
                                    @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Address <span class="required">*</span></label>
                                    <input type="text" name="address" class="form-control" value="{{ old('address', \Auth::user()->address) }}">
                                    @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>State / Province <span class="required">*</span></label>
                                    <input type="text" name="state" class="form-control" value="{{ old('state') }}">
                                    @error('state') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Zip Code <span class="required">*</span></label>
                                    <input type="text" name="zip_code" class="form-control" value="{{ old('zip_code') }}">
                                    @error('zip_code') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Special Requests <small class="text-muted">(optional)</small></label>
                                    <textarea name="special_requests" class="form-control" rows="3" placeholder="Any special requests or preferences...">{{ $book_data['special_requests'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- ===== PAYMENT METHOD SELECTION ===== --}}
                        <div class="col-lg-12 col-md-12 mt-4">
                            <div class="payment-box">
                                <h4 class="title mb-3">Choose Payment Method</h4>
                                <div class="payment-methods-grid">

                                    {{-- MTN MoMo --}}
                                    <div class="payment-card" onclick="selectPayment('MTN_MOMO')">
                                        <input type="radio" id="mtn_momo" name="payment_method" value="MTN_MOMO" class="payment-radio" {{ old('payment_method') == 'MTN_MOMO' ? 'checked' : '' }}>
                                        <label for="mtn_momo" class="payment-label">
                                            <div class="payment-icon" style="background:#ffcb05;">
                                                <i class="bx bx-phone" style="color:#003399;font-size:28px;"></i>
                                            </div>
                                            <span class="payment-name">MTN MoMo</span>
                                            <small class="text-muted">Pay via MTN Mobile Money</small>
                                        </label>
                                    </div>

                                    {{-- Airtel MoMo --}}
                                    <div class="payment-card" onclick="selectPayment('AIRTEL_MOMO')">
                                        <input type="radio" id="airtel_momo" name="payment_method" value="AIRTEL_MOMO" class="payment-radio" {{ old('payment_method') == 'AIRTEL_MOMO' ? 'checked' : '' }}>
                                        <label for="airtel_momo" class="payment-label">
                                            <div class="payment-icon" style="background:#ed1c24;">
                                                <i class="bx bx-phone" style="color:#fff;font-size:28px;"></i>
                                            </div>
                                            <span class="payment-name">Airtel Money</span>
                                            <small class="text-muted">Pay via Airtel Mobile Money</small>
                                        </label>
                                    </div>

                                    {{-- Bank Transfer --}}
                                    <div class="payment-card" onclick="selectPayment('BANK_TRANSFER')">
                                        <input type="radio" id="bank_transfer" name="payment_method" value="BANK_TRANSFER" class="payment-radio" {{ old('payment_method') == 'BANK_TRANSFER' ? 'checked' : '' }}>
                                        <label for="bank_transfer" class="payment-label">
                                            <div class="payment-icon" style="background:#0c4da2;">
                                                <i class="bx bx-building" style="color:#fff;font-size:28px;"></i>
                                            </div>
                                            <span class="payment-name">Bank Transfer</span>
                                            <small class="text-muted">Direct bank deposit</small>
                                        </label>
                                    </div>

                                    {{-- Cash at Hotel --}}
                                    <div class="payment-card" onclick="selectPayment('CASH')">
                                        <input type="radio" id="cash_pay" name="payment_method" value="CASH" class="payment-radio" {{ old('payment_method') == 'CASH' ? 'checked' : '' }}>
                                        <label for="cash_pay" class="payment-label">
                                            <div class="payment-icon" style="background:#28a745;">
                                                <i class="bx bx-money" style="color:#fff;font-size:28px;"></i>
                                            </div>
                                            <span class="payment-name">Pay at Hotel</span>
                                            <small class="text-muted">Cash on arrival</small>
                                        </label>
                                    </div>
                                </div>

                                @error('payment_method') <div class="text-danger mt-2">{{ $message }}</div> @enderror

                                {{-- === MTN MOMO Fields === --}}
                                <div id="mtn_momo_fields" class="payment-fields mt-3" style="display:none;">
                                    <div class="alert alert-warning">
                                        <strong>MTN MoMo Instructions:</strong><br>
                                        Dial <code>*182*8*1*</code> then enter merchant code, or send the payment to <strong>+250794191115</strong>
                                    </div>
                                    <div class="form-group">
                                        <label>Your MoMo Phone Number <span class="required">*</span></label>
                                        <input type="text" name="payment_phone" class="form-control momo-phone" placeholder="07XXXXXXXX" value="{{ old('payment_phone') }}">
                                        @error('payment_phone') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label>MoMo Transaction ID <small class="text-muted">(if already paid)</small></label>
                                        <input type="text" name="momo_transaction_id" class="form-control" placeholder="e.g. TXN123456789" value="{{ old('momo_transaction_id') }}">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label>Payment Screenshot <small class="text-muted">(optional proof)</small></label>
                                        <input type="file" name="payment_proof" class="form-control" accept="image/*,.pdf">
                                    </div>
                                </div>

                                {{-- === AIRTEL MOMO Fields === --}}
                                <div id="airtel_momo_fields" class="payment-fields mt-3" style="display:none;">
                                    <div class="alert alert-danger border-0" style="background:#fff0f0;">
                                        <strong>Airtel Money Instructions:</strong><br>
                                        Send payment to <strong>+250794191115</strong> (Lucerna Kabgayi Hotel)
                                    </div>
                                    <div class="form-group">
                                        <label>Your Airtel Phone Number <span class="required">*</span></label>
                                        <input type="text" name="payment_phone" class="form-control momo-phone" placeholder="07XXXXXXXX" value="{{ old('payment_phone') }}">
                                        @error('payment_phone') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label>Transaction ID <small class="text-muted">(if already paid)</small></label>
                                        <input type="text" name="momo_transaction_id" class="form-control" placeholder="e.g. TXN123456789" value="{{ old('momo_transaction_id') }}">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label>Payment Screenshot <small class="text-muted">(optional proof)</small></label>
                                        <input type="file" name="payment_proof" class="form-control" accept="image/*,.pdf">
                                    </div>
                                </div>

                                {{-- === BANK TRANSFER Fields === --}}
                                <div id="bank_transfer_fields" class="payment-fields mt-3" style="display:none;">
                                    <div class="alert alert-info">
                                        <strong>Bank Transfer Details:</strong><br>
                                        <table class="table table-sm table-borderless mb-0 mt-1">
                                            <tr><td><strong>Bank:</strong></td><td>Bank of Kigali</td></tr>
                                            <tr><td><strong>Account Name:</strong></td><td>Lucerna Kabgayi Hotel</td></tr>
                                            <tr><td><strong>Account No:</strong></td><td>100109876543</td></tr>
                                            <tr><td><strong>Branch:</strong></td><td>Muhanga</td></tr>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Your Bank Name</label>
                                                <input type="text" name="payment_bank_name" class="form-control" placeholder="e.g. Bank of Kigali" value="{{ old('payment_bank_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Bank Reference / Receipt No <span class="required">*</span></label>
                                                <input type="text" name="payment_bank_ref" class="form-control" placeholder="Transfer reference number" value="{{ old('payment_bank_ref') }}">
                                                @error('payment_bank_ref') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label>Upload Bank Slip / Receipt <small class="text-muted">(recommended)</small></label>
                                        <input type="file" name="payment_proof" class="form-control" accept="image/*,.pdf">
                                    </div>
                                </div>

                                {{-- === CASH Fields === --}}
                                <div id="cash_fields" class="payment-fields mt-3" style="display:none;">
                                    <div class="alert alert-success">
                                        <i class="bx bx-check-circle"></i> <strong>Pay at Hotel</strong><br>
                                        You will pay in cash upon arrival at Lucerna Kabgayi Hotel, Muhanga.<br>
                                        Your booking will be confirmed once the hotel approves it.
                                    </div>
                                </div>

                                <button type="submit" class="order-btn mt-3" id="myButton">
                                    <i class="bx bx-lock-alt"></i> Confirm Booking
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== BOOKING SUMMARY SIDEBAR ===== --}}
                <div class="col-lg-4">
                    <section class="checkout-area pb-70">
                        <div class="card-body">
                            <div class="billing-details">
                                <h3 class="title">Booking Summary</h3>
                                <hr>
                                <div style="display: flex">
                                    <img style="height:100px; width:120px;object-fit: cover" src="{{ (!empty($room->image))? url('upload/roomimg/'.$room->image):url('upload/no_image.jpg') }}" alt="Room Image">
                                    <div style="padding-left: 10px;">
                                        <a href="#" style="font-size: 20px; color: #595959;font-weight: bold">{{ @$room->type->name }}</a>
                                        <p><b>{{ number_format($room->price) }} RWF / Night</b></p>
                                    </div>
                                </div>
                                <br>
                                <table class="table" style="width: 100%">
                                    @php
                                    $subtotal = $room->price * $nights * $book_data['number_of_rooms'];
                                    $discount = ($room->discount/100) * $subtotal;
                                    @endphp
                                    <tr>
                                        <td><p>Total Nights<br><b>({{ $book_data['check_in'] }} - {{ $book_data['check_out'] }})</b></p></td>
                                        <td style="text-align: right"><p>{{ $nights }} Nights</p></td>
                                    </tr>
                                    <tr>
                                        <td><p>Rooms</p></td>
                                        <td style="text-align: right"><p>{{ $book_data['number_of_rooms'] }}</p></td>
                                    </tr>
                                    <tr>
                                        <td><p>Subtotal</p></td>
                                        <td style="text-align: right"><p>{{ number_format($subtotal) }} RWF</p></td>
                                    </tr>
                                    @if($discount > 0)
                                    <tr>
                                        <td><p>Discount ({{ $room->discount }}%)</p></td>
                                        <td style="text-align:right"><p>-{{ number_format($discount) }} RWF</p></td>
                                    </tr>
                                    @endif
                                    <tr style="border-top:2px solid #0c4da2;">
                                        <td><p><strong>Total</strong></p></td>
                                        <td style="text-align:right"><p><strong style="color:#0c4da2;font-size:18px;">{{ number_format($subtotal - $discount) }} RWF</strong></p></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </form>
    </div>
</section>

<style>
    .hide{display:none}
    .payment-methods-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
    .payment-card{position:relative;cursor:pointer;}
    .payment-card .payment-radio{position:absolute;opacity:0;width:0;height:0;}
    .payment-card .payment-label{display:flex;flex-direction:column;align-items:center;padding:16px 10px;border:2px solid #e0e0e0;border-radius:10px;cursor:pointer;transition:all .2s;text-align:center;background:#fff;}
    .payment-card .payment-radio:checked + .payment-label{border-color:#0c4da2;background:#f0f5ff;box-shadow:0 0 0 3px rgba(12,77,162,.15);}
    .payment-icon{width:50px;height:50px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin-bottom:8px;}
    .payment-name{font-weight:700;font-size:14px;color:#333;}
    .payment-card small{font-size:11px;}
    .order-btn{background:#0c4da2;color:#fff;border:none;padding:14px 40px;border-radius:6px;font-size:16px;font-weight:600;cursor:pointer;width:100%;transition:background .2s;}
    .order-btn:hover{background:#093a7a;}
    @media(max-width:576px){.payment-methods-grid{grid-template-columns:1fr;}}
</style>

<script type="text/javascript">
function selectPayment(method) {
    document.getElementById(method.toLowerCase() + '_momo') ?.click() 
        || document.getElementById(method.toLowerCase()) ?.click()
        || document.querySelector('input[value="'+method+'"]') ?.click();
}

document.addEventListener('DOMContentLoaded', function() {
    var radios = document.querySelectorAll('.payment-radio');
    var allFields = document.querySelectorAll('.payment-fields');

    function showFields() {
        allFields.forEach(function(f){ f.style.display = 'none'; });
        // Disable hidden inputs to avoid validation conflicts
        allFields.forEach(function(f){ 
            f.querySelectorAll('input[name="payment_phone"]').forEach(function(i){ i.disabled = true; });
        });

        var checked = document.querySelector('.payment-radio:checked');
        if (!checked) return;
        var val = checked.value;
        var fieldMap = {
            'MTN_MOMO': 'mtn_momo_fields',
            'AIRTEL_MOMO': 'airtel_momo_fields',
            'BANK_TRANSFER': 'bank_transfer_fields',
            'CASH': 'cash_fields'
        };
        if (fieldMap[val]) {
            var el = document.getElementById(fieldMap[val]);
            el.style.display = 'block';
            el.querySelectorAll('input[name="payment_phone"]').forEach(function(i){ i.disabled = false; });
        }
    }

    radios.forEach(function(r) {
        r.addEventListener('change', showFields);
    });
    showFields();

    // Form validation
    document.querySelector('.checkout-form').addEventListener('submit', function(e) {
        var checked = document.querySelector('.payment-radio:checked');
        if (!checked) {
            e.preventDefault();
            alert('Please select a payment method');
            return false;
        }
        document.getElementById('myButton').disabled = true;
        document.getElementById('myButton').innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Processing...';
    });
});
</script>
@endsection
