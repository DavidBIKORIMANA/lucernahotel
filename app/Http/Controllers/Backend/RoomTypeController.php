<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\BookArea;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Models\Room;

class RoomTypeController extends Controller
{
    public function RoomTypeList(){

        $allData = RoomType::orderBy('id','desc')->get();
        // dd($allData);
        return view('backend.allroom.roomtype.view_roomtype',compact('allData'));

    }// End Method 

    public function AddRoomType(){
        return view('backend.allroom.roomtype.add_roomtype');
    }// End Method 

    public function RoomTypeStore(Request $request){
        // dd($request);
        $roomtype_id =  RoomType::insertGetId([
            'type' => $request->type,
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        Room::insert([
            'roomtype_id' => $roomtype_id,
        ]);

        $notification = array(
            'message' => 'Room and Type Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('room.type.list')->with($notification);

    }// End Method 
}
 