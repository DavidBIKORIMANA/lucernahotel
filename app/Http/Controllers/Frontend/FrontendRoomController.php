<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookArea;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Room;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\RoomBookedDate;
use App\Models\Booking;
 
class FrontendRoomController extends Controller
{
    public function AllFrontendRoomList(){

        $rooms = Room::with('type')->latest()->get();
        return view('frontend.room.all_rooms',compact('rooms'));
    } // End Method 


    public function RoomDetailsPage($id){

        $roomdetails = Room::with('approved_reviews.user')->find($id);
        $multiImage = MultiImage::where('rooms_id',$id)->get();
        $facility = Facility::where('rooms_id',$id)->get();

        $otherRooms = Room::with('type')->where('id','!=', $id)->orderBy('id','DESC')->limit(2)->get();
        return view('frontend.room.room_details',compact('roomdetails','multiImage','facility','otherRooms'));

    } // End Method 


    public function BookingSeach(Request $request){
   
        $request->flash();

        if ($request->check_in == $request->check_out) {

            $notification = array(
                'message' => 'Something want to worng',
                'alert-type' => 'error'
            );
    
            return redirect()->back()->with($notification);
        }

        $sdate = date('Y-m-d',strtotime($request->check_in));
        $edate = date('Y-m-d',strtotime($request->check_out));
        $alldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate,$alldate);
        $dt_array = [];
        foreach ($d_period as $period) {
           array_push($dt_array, date('Y-m-d', strtotime($period)));
        }

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date',$dt_array)->distinct()->pluck('booking_id')->toArray();

        $query = Room::with('type')->withCount('room_numbers')->where('status',1);

        if ($request->filled('room_type')) {
            $query->where('roomtype_id', $request->room_type);
        }

        $rooms = $query->get();

        return view('frontend.room.search_room',compact('rooms','check_date_booking_ids'));

    } // End Method 


    public function SearchRoomDetails(Request $request,$id){
        $request->flash();
        $roomdetails = Room::with('type')->find($id);
        $multiImage = MultiImage::where('rooms_id',$id)->get();
        $facility = Facility::where('rooms_id',$id)->get();

        $otherRooms = Room::with('type')->where('id','!=', $id)->orderBy('id','DESC')->limit(2)->get();
        $room_id = $id;
        return view('frontend.room.search_room_details',compact('roomdetails','multiImage','facility','otherRooms','room_id'));

    }// End Method 


    public function CheckRoomAvailability(Request $request){

        $sdate = date('Y-m-d',strtotime($request->check_in));
        $edate = date('Y-m-d',strtotime($request->check_out));
        $alldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate,$alldate);
        $dt_array = [];
        foreach ($d_period as $period) {
           array_push($dt_array, date('Y-m-d', strtotime($period)));
        }

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date',$dt_array)->distinct()->pluck('booking_id')->toArray();

        $room = Room::withCount('room_numbers')->find($request->room_id);

        $bookings = Booking::withCount('assign_rooms')->whereIn('id',$check_date_booking_ids)->where('rooms_id',$room->id)->get()->toArray();

        $total_book_room = array_sum(array_column($bookings,'assign_rooms_count'));

        $av_room = @$room->room_numbers_count-$total_book_room;

        $toDate = Carbon::parse($request->check_in);
        $fromDate = Carbon::parse($request->check_out);
        $nights = $toDate->diffInDays($fromDate);

        return response()->json(['available_room'=>$av_room, 'total_nights'=>$nights ]);
    }// End Method 




    public function BookingSeachAll(Request $request){
        
        $start_date = date('Y-m-d',strtotime(Carbon::now()));
        $date = Carbon::createFromFormat('Y-m-d', $start_date);
        $daysToAdd = 5;
        $end_date = date('Y-m-d',strtotime($date->addDays($daysToAdd)));
        // dd($start_date,$end_date);
        $request->flash();

        if ($start_date == $end_date) {

            $notification = array(
                'message' => 'Choose another date',
                'alert-type' => 'error'
            );
    
            return redirect()->back()->with($notification);
        }

        $sdate = date('Y-m-d',strtotime($start_date));
        $edate = date('Y-m-d',strtotime($end_date));
        $alldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate,$alldate);
        $dt_array = [];
        foreach ($d_period as $period) {
           array_push($dt_array, date('Y-m-d', strtotime($period)));
        }

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date',$dt_array)->distinct()->pluck('booking_id')->toArray();

        if ($request->get('idcode') == 2) {
            $rooms = Room::with('type')->withCount('room_numbers')->join('room_types', 'room_types.id', '=', 'rooms.roomtype_id')->where('rooms.status',1)->where('room_types.type','Hall')->get();
            return view('frontend.room.search_hall_top',compact('rooms','check_date_booking_ids'));
        }else{
            $rooms = Room::with('type')->withCount('room_numbers')->join('room_types', 'room_types.id', '=', 'rooms.roomtype_id')->where('rooms.status',1)->where('room_types.type','Room')->get();
            return view('frontend.room.search_room_top',compact('rooms','check_date_booking_ids'));
        }

    } // End Method


}
 