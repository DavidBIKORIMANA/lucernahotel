<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\BookArea;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Room;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\RoomBookedDate;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Stripe;
use App\Models\BookingRoomList;
use App\Models\RoomNumber;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookConfirm;
use App\Models\User;
use App\Models\PaymentTransaction;
use App\Models\ActivityLog;
use App\Models\Review;
use App\Notifications\BookingComplete;
use Illuminate\Support\Facades\Notification;

class BookingController extends Controller
{
    public function Checkout(){

        if (Session::has('book_date')) {
           $book_data = Session::get('book_date');
           $room = Room::with('type')->find($book_data['room_id']);

           $toDate = Carbon::parse($book_data['check_in']);
           $fromDate = Carbon::parse($book_data['check_out']);
           $nights = $toDate->diffInDays($fromDate);

           return view('frontend.checkout.checkout',compact('book_data','room','nights'));
        }else{

            $notification = array(
                'message' => 'Something want to wrong!',
                'alert-type' => 'error'
            ); 
            return redirect('/')->with($notification); 
        } // end else

    }// End Method 


    public function BookingStore(Request $request){

        $validateData = $request->validate([
            'check_in' => 'required',
            'check_out' => 'required',
            'persion' => 'required',
            'number_of_rooms' => 'required',
        ]);

        if ($request->available_room < $request->number_of_rooms) {
           
            $notification = array(
                'message' => 'Something want to wrong!',
                'alert-type' => 'error'
            ); 
            return redirect()->back()->with($notification); 
        }
        Session::forget('book_date');

        $data = array();
        $data['number_of_rooms'] = $request->number_of_rooms;
        $data['available_room'] = $request->available_room;
        $data['persion'] = $request->persion;
        $data['check_in'] = date('Y-m-d',strtotime($request->check_in));
        $data['check_out'] = date('Y-m-d',strtotime($request->check_out));
        $data['room_id'] = $request->room_id;
        $data['adults'] = $request->adults ?? 1;
        $data['children'] = $request->children ?? 0;
        $data['special_requests'] = $request->special_requests;

        Session::put('book_date',$data);

        return redirect()->route('checkout');

    }// End Method 

    public function CheckoutStore(Request $request){

        $user = User::role('admin')->get();
        
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'payment_method' => 'required', 
            'nid' => 'required',
        ]);

           $book_data = Session::get('book_date'); 
           $toDate = Carbon::parse($book_data['check_in']);
           $fromDate = Carbon::parse($book_data['check_out']);
           $total_nights = $toDate->diffInDays($fromDate);
           
           $room = Room::find($book_data['room_id']);
           $effectivePrice = $room->getEffectivePrice();
           $subtotal = $effectivePrice * $total_nights * $book_data['number_of_rooms'];
           $discount = ($room->discount/100)*$subtotal;
           $total_price = $subtotal-$discount;
           $code = 'LKH'.date('Ymd').rand(1000,9999);

         $payment_status = 0;
         $transation_id = '';

         // === STRIPE PAYMENT ===
         if ($request->payment_method == 'Stripe') {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $s_pay = Stripe\Charge::create ([
                "amount" => $total_price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Booking ".$code." - Lucerna Kabgayi Hotel",
            ]);

            if ($s_pay['status'] == 'succeeded') {
                $payment_status = 1;
                $transation_id = $s_pay->id;
            } else {
                $notification = array(
                    'message' => 'Payment failed. Please try again.',
                    'alert-type' => 'error'
                ); 
                return redirect()->back()->with($notification);  
            }
         }

         // === MTN MOMO / AIRTEL MOMO ===
         if (in_array($request->payment_method, ['MTN_MOMO', 'AIRTEL_MOMO'])) {
            $this->validate($request, [
                'payment_phone' => 'required|regex:/^[0-9+]{10,15}$/',
            ]);
            $transation_id = $request->momo_transaction_id;
         }

         // === BANK TRANSFER ===
         if ($request->payment_method == 'BANK_TRANSFER') {
            $this->validate($request, [
                'payment_bank_ref' => 'required|string|max:100',
            ]);
            $transation_id = $request->payment_bank_ref;
         }

           // Create booking
           $data = new Booking();
           $data->rooms_id = $room->id;
           $data->user_id = Auth::user()->id;
           $data->check_in = date('Y-m-d',strtotime($book_data['check_in']));
           $data->check_out = date('Y-m-d',strtotime($book_data['check_out']));
           $data->persion = $book_data['persion'];
           $data->number_of_rooms = $book_data['number_of_rooms'];
           $data->total_night = $total_nights;
           $data->adults = $book_data['adults'] ?? 1;
           $data->children = $book_data['children'] ?? 0;
           $data->special_requests = $book_data['special_requests'] ?? null;

           $data->actual_price = $effectivePrice;
           $data->subtotal = $subtotal;
           $data->discount = $discount;
           $data->total_price = $total_price;
           $data->currency = 'RWF';
           $data->payment_method = $request->payment_method;
           $data->transation_id = $transation_id;
           $data->payment_status = $payment_status;
           $data->payment_phone = $request->payment_phone;
           $data->payment_bank_name = $request->payment_bank_name;
           $data->payment_bank_ref = $request->payment_bank_ref;
           $data->source = 'website';

           $data->name = $request->name;
           $data->email = $request->email;
           $data->phone = $request->phone;
           $data->country = $request->country;
           $data->state = $request->state;
           $data->zip_code = $request->zip_code;
           $data->address = $request->address;
           $data->nid = $request->nid;

           $data->code = $code;
           $data->status = 0;
           $data->created_at = Carbon::now();

           // Handle proof upload for MoMo / Bank
           if ($request->hasFile('payment_proof')) {
               $file = $request->file('payment_proof');
               $filename = $code.'_proof_'.time().'.'.$file->getClientOriginalExtension();
               $file->move(public_path('upload/payment_proofs'), $filename);
               $data->payment_proof = $filename;
           }

           $data->save();

        // Log payment transaction
        PaymentTransaction::create([
            'booking_id' => $data->id,
            'method' => $request->payment_method,
            'transaction_id' => $transation_id ?: null,
            'phone' => $request->payment_phone,
            'bank_name' => $request->payment_bank_name,
            'bank_ref' => $request->payment_bank_ref,
            'proof_file' => $data->payment_proof,
            'amount' => $total_price,
            'currency' => 'RWF',
            'status' => $payment_status ? 'success' : 'pending',
        ]);

        // Log activity
        ActivityLog::record('booking_created', $data);

        $sdate = date('Y-m-d',strtotime($book_data['check_in']));
        $edate = date('Y-m-d',strtotime($book_data['check_out']));
        $eldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate,$eldate);
        foreach ($d_period as $period) {
            $booked_dates = new RoomBookedDate();
            $booked_dates->booking_id = $data->id;
            $booked_dates->room_id = $room->id;
            $booked_dates->book_date = date('Y-m-d', strtotime($period));
            $booked_dates->save();
        }

        Session::forget('book_date');

        // Send confirmation email to guest
        try {
            Mail::to($data->email)->send(new BookConfirm($data->toArray()));
        } catch (\Exception $e) {
            // Log email failure but don't block the booking
            \Log::error('Booking confirmation email failed: '.$e->getMessage());
        }

        // Notify admins
        Notification::send($user, new BookingComplete($request->name));

        $notification = array(
            'message' => 'Booking confirmed! A confirmation email has been sent to '.$data->email,
            'alert-type' => 'success'
        ); 

        return redirect()->route('booking.confirmation', $data->id)->with($notification);  

    }// End Method 


    public function BookingConfirmation($id){
        $booking = Booking::with('room.type')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('frontend.checkout.confirmation', compact('booking'));
    }// End Method


    public function BookingList(){

        $allData = Booking::with(['user', 'room.type'])->orderBy('id','desc')->get();
        return view('backend.booking.booking_list',compact('allData'));

    }// End Method 

    public function EditBooking($id){
        $datenow = now()->format('Y-m-d');
        $editData = Booking::with('room')->find($id);
        return view('backend.booking.edit_booking',compact('editData','datenow'));

    }// End Method 

     public function UpdateBookingStatus(Request $request, $id){

        $booking = Booking::find($id);
        $booking->payment_status = $request->payment_status;
        $booking->status = $request->status;

        // Handle check-in
        if ($request->status == 2 && !$booking->checked_in_at) {
            $booking->checked_in_at = now();
        }
        // Handle check-out
        if ($request->status == 3 && !$booking->checked_out_at) {
            $booking->checked_out_at = now();
        }
        // Handle cancellation
        if ($request->status == 4) {
            $booking->cancelled_at = now();
            $booking->cancellation_reason = $request->cancellation_reason;
            RoomBookedDate::where('booking_id', $id)->delete();
        }

        // Handle denial via status dropdown
        if ($request->status == 5) {
            $booking->denied_at = now();
            $booking->denial_reason = $request->cancellation_reason;
            RoomBookedDate::where('booking_id', $id)->delete();
        }

        $booking->save();

        ActivityLog::record('booking_status_updated', $booking, [
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ]);
          
        /// Start Sent Email 
        if (!in_array($request->status, [4, 5])) {
            $sendmail = Booking::find($id);

            $data = [
                'check_in' => $sendmail->check_in,
                'check_out' => $sendmail->check_out,
                'name' => $sendmail->name,
                'email' => $sendmail->email,
                'phone' => $sendmail->phone,
            ];

            Mail::to($sendmail->email)->send(new BookConfirm($data));
        }
        /// End Sent Email 
 
        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        ); 
        return redirect()->back()->with($notification);  

     }   // End Method 


     // ===== CONFIRM BOOKING =====
     public function ConfirmBooking($id){
        $booking = Booking::findOrFail($id);
        $booking->confirm(Auth::id());

        ActivityLog::record('booking_confirmed', $booking);

        // Send confirmation email
        $data = [
            'check_in' => $booking->check_in,
            'check_out' => $booking->check_out,
            'name' => $booking->name,
            'email' => $booking->email,
            'phone' => $booking->phone,
        ];
        Mail::to($booking->email)->send(new BookConfirm($data));

        $notification = array(
            'message' => 'Booking Confirmed Successfully',
            'alert-type' => 'success'
        ); 
        return redirect()->back()->with($notification);  
     } // End Method


     // ===== DENY BOOKING =====
     public function DenyBooking(Request $request, $id){
        $this->validate($request, [
            'denial_reason' => 'required|string|max:500',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->deny($request->denial_reason, Auth::id());

        // Remove booked dates
        RoomBookedDate::where('booking_id', $id)->delete();

        ActivityLog::record('booking_denied', $booking, [
            'reason' => $request->denial_reason,
        ]);

        $notification = array(
            'message' => 'Booking Denied',
            'alert-type' => 'warning'
        ); 
        return redirect()->back()->with($notification);  
     } // End Method


     // ===== VERIFY PAYMENT =====
     public function VerifyPayment(Request $request, $id){
        $booking = Booking::findOrFail($id);
        $booking->payment_status = $request->payment_action == 'approve' ? 1 : 0;
        $booking->admin_notes = $request->admin_notes;
        $booking->save();

        // Update payment transaction
        $transaction = PaymentTransaction::where('booking_id', $id)->latest()->first();
        if ($transaction) {
            if ($request->payment_action == 'approve') {
                $transaction->verify(Auth::id());
            } else {
                $transaction->status = 'failed';
                $transaction->notes = $request->admin_notes;
                $transaction->save();
            }
        }

        ActivityLog::record('payment_verified', $booking, [
            'action' => $request->payment_action,
        ]);

        $notification = array(
            'message' => $request->payment_action == 'approve' ? 'Payment Verified Successfully' : 'Payment Rejected',
            'alert-type' => $request->payment_action == 'approve' ? 'success' : 'warning'
        ); 
        return redirect()->back()->with($notification);  
     } // End Method


     // ===== VIEW PAYMENT PROOF =====
     public function ViewPaymentProof($id){
        $booking = Booking::findOrFail($id);
        if (!$booking->payment_proof) {
            abort(404);
        }
        $path = public_path('upload/payment_proofs/' . $booking->payment_proof);
        if (!file_exists($path)) {
            abort(404);
        }
        return response()->file($path);
     } // End Method


     public function UpdateBooking(Request $request, $id){

        if ($request->available_room < $request->number_of_rooms) {

            $notification = array(
                'message' => 'Something Want To Wrong!',
                'alert-type' => 'error'
            ); 
            return redirect()->back()->with($notification);  
        }

        $data = Booking::find($id);
        $data->number_of_rooms = $request->number_of_rooms;
        $data->check_in = date('Y-m-d', strtotime($request->check_in));
        $data->check_out = date('Y-m-d', strtotime($request->check_out));
        $data->save();

        BookingRoomList::where('booking_id', $id)->delete();
        RoomBookedDate::where('booking_id', $id)->delete();

        $sdate = date('Y-m-d',strtotime($request->check_in ));
        $edate = date('Y-m-d',strtotime($request->check_out));
        $eldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate,$eldate);
        foreach ($d_period as $period) {
            $booked_dates = new RoomBookedDate();
            $booked_dates->booking_id = $data->id;
            $booked_dates->room_id = $data->rooms_id;
            $booked_dates->book_date = date('Y-m-d', strtotime($period));
            $booked_dates->save();
        }

        $notification = array(
            'message' => 'Booking Updated Successfully',
            'alert-type' => 'success'
        ); 
        return redirect()->back()->with($notification);   

     }  // End Method 


     public function AssignRoom($booking_id){

        $booking = Booking::find($booking_id);

        $booking_date_array = RoomBookedDate::where('booking_id',$booking_id)->pluck('book_date')->toArray();

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date',$booking_date_array)->where('room_id',$booking->rooms_id)->distinct()->pluck('booking_id')->toArray();
        
        $booking_ids = Booking::whereIn('id',$check_date_booking_ids)->pluck('id')->toArray();

        $assign_room_ids = BookingRoomList::whereIn('booking_id',$booking_ids)->pluck('room_number_id')->toArray();

        $room_numbers = RoomNumber::where('rooms_id',$booking->rooms_id)->whereNotIn('id',$assign_room_ids)->where('status','Active')->get();

        return view('backend.booking.assign_room',compact('booking','room_numbers'));
        

     } // End Method 


     public function AssignRoomStore($booking_id,$room_number_id){

        $booking = Booking::find($booking_id);
        $check_data = BookingRoomList::where('booking_id',$booking_id)->count();

        if ($check_data < $booking->number_of_rooms) {
           $assign_data = new BookingRoomList();
           $assign_data->booking_id = $booking_id;
           $assign_data->room_id = $booking->rooms_id;
           $assign_data->room_number_id = $room_number_id;
           $assign_data->save();

           $notification = array(
            'message' => 'Room Assign Successfully',
            'alert-type' => 'success'
        ); 
        return redirect()->back()->with($notification);   

        }else {

            $notification = array(
                'message' => 'Room Already Assign',
                'alert-type' => 'error'
            ); 
            return redirect()->back()->with($notification);   

        }

     }// End Method 


     public function AssignRoomDelete($id){

        $assign_room = BookingRoomList::find($id);
        $assign_room->delete();

        $notification = array(
            'message' => 'Assign Room Deleted Successfully',
            'alert-type' => 'success'
        ); 
        return redirect()->back()->with($notification); 

     }// End Method 

     public function DownloadInvoice($id){

        $editData = Booking::with('room')->find($id);
        // return view('backend.booking.booking_invoice',compact('editData'));
        
        $pdf = Pdf::loadView('backend.booking.booking_invoice',compact('editData'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);

        return $pdf->download('invoice.pdf');

     }// End Method 


     public function UserBooking(){
        $id = Auth::user()->id;
        $allData = Booking::with('room.type')->where('user_id',$id)->orderBy('id','desc')->get();
        return view('frontend.dashboard.user_booking',compact('allData'));

     }// End Method 


     public function UserInvoice($id){

        $editData = Booking::with('room')->find($id);
        $pdf = Pdf::loadView('backend.booking.booking_invoice',compact('editData'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

     }// End Method 


     public function UserCancelBooking(Request $request, $id){
        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if (!in_array($booking->status, [0, 1])) {
            return redirect()->back()->with([
                'message' => 'This booking cannot be cancelled',
                'alert-type' => 'error'
            ]);
        }

        $booking->cancel($request->cancellation_reason);
        ActivityLog::record('booking_cancelled_by_guest', $booking, [
            'reason' => $request->cancellation_reason,
        ]);

        return redirect()->back()->with([
            'message' => 'Booking cancelled successfully',
            'alert-type' => 'warning'
        ]);
     }// End Method


     public function MarkAsRead(Request $request , $notificationId){

        $user = Auth::user();
        $notification = $user->notifications()->where('id',$notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }

  return response()->json(['count' => $user->unreadNotifications()->count()]);

     }// End Method 


     // ===== CHECK IN BOOKING =====
     public function CheckInBooking($id){
        $booking = Booking::findOrFail($id);

        if ($booking->status != 1) {
            return redirect()->back()->with([
                'message' => 'Booking must be confirmed before check-in',
                'alert-type' => 'error'
            ]);
        }

        $booking->checkIn();
        ActivityLog::record('booking_checked_in', $booking);

        return redirect()->back()->with([
            'message' => 'Guest Checked In Successfully',
            'alert-type' => 'success'
        ]);
     } // End Method


     // ===== CHECK OUT BOOKING =====
     public function CheckOutBooking($id){
        $booking = Booking::findOrFail($id);

        if ($booking->status != 2) {
            return redirect()->back()->with([
                'message' => 'Guest must be checked in before check-out',
                'alert-type' => 'error'
            ]);
        }

        $booking->checkOut();
        ActivityLog::record('booking_checked_out', $booking);

        return redirect()->back()->with([
            'message' => 'Guest Checked Out Successfully',
            'alert-type' => 'success'
        ]);
     } // End Method


     // ===== CANCEL BOOKING (from list) =====
     public function CancelBooking(Request $request, $id){
        $booking = Booking::findOrFail($id);

        if (in_array($booking->status, [3, 4, 5])) {
            return redirect()->back()->with([
                'message' => 'This booking cannot be cancelled',
                'alert-type' => 'error'
            ]);
        }

        $booking->cancel($request->cancellation_reason);
        ActivityLog::record('booking_cancelled', $booking, [
            'reason' => $request->cancellation_reason,
        ]);

        return redirect()->back()->with([
            'message' => 'Booking Cancelled Successfully',
            'alert-type' => 'warning'
        ]);
     } // End Method


     // ===== MARK PAYMENT (quick action from list) =====
     public function MarkPayment(Request $request, $id){
        $booking = Booking::findOrFail($id);
        $booking->payment_status = $request->payment_status;
        $booking->save();

        ActivityLog::record('payment_status_updated', $booking, [
            'payment_status' => $request->payment_status,
        ]);

        $statusLabels = [0 => 'Unpaid', 1 => 'Paid', 2 => 'Refunded', 3 => 'Partial'];

        return redirect()->back()->with([
            'message' => 'Payment marked as ' . ($statusLabels[$request->payment_status] ?? 'Updated'),
            'alert-type' => 'success'
        ]);
     } // End Method


}
 