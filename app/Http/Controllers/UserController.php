<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Index(){
        $rooms = Room::with('type')
            ->where('status', 1)
            ->whereHas('type', fn($q) => $q->where('type', 'Room'))
            ->latest()
            ->limit(9)
            ->get();

        $halls = Room::with('type')
            ->where('status', 1)
            ->whereHas('type', fn($q) => $q->where('type', 'Hall'))
            ->latest()
            ->get();

        $roomTypes = \App\Models\RoomType::where('status','active')->orderBy('sort_order')->get();
        $testimonials = \App\Models\Testimonial::latest()->get();
        $diningItems = \App\Models\DiningItem::orderBy('sort_order')->get();
        $hotelInfos = \App\Models\HotelInfo::orderBy('sort_order')->get()->groupBy('group');
        $heroSlides = \App\Models\HeroSlide::where('status', 1)->orderBy('sort_order')->get();
        $heroStats = \App\Models\HeroStat::orderBy('sort_order')->get();
        $aboutPillars = \App\Models\AboutPillar::orderBy('sort_order')->get();
        $amenities = \App\Models\Amenity::where('status', 1)->orderBy('sort_order')->get();
        $featuredAmenities = \App\Models\FeaturedAmenity::where('status', 1)->orderBy('sort_order')->get();
        $eventFeatures = \App\Models\EventFeature::orderBy('sort_order')->get();
        $homeSections = \App\Models\HomeSection::all()->keyBy('section_key');
        $siteSettings = \App\Models\SiteSetting::first();

        return view('frontend.index', compact(
            'rooms', 'halls', 'roomTypes', 'testimonials', 'diningItems', 'hotelInfos',
            'heroSlides', 'heroStats', 'aboutPillars', 'amenities', 'featuredAmenities',
            'eventFeatures', 'homeSections', 'siteSettings'
        ));
    }// End Method 

    public function UserProfile(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('frontend.dashboard.edit_profile',compact('profileData'));

    }// End Method 

    public function UserStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();  
            $file->move(public_path('upload/user_images'),$filename);
            $data['photo'] = $filename;

        }
        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method 


    public function UserLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }// End Method


    public function UserChangePassword(){

        return view('frontend.dashboard.user_change_password');

    }// End Method


    public function ChangePasswordStore(Request $request){

        // Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if(!Hash::check($request->old_password, auth::user()->password)){

            $notification = array(
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error'
            );
    
            return back()->with($notification);

        }

        /// Update The New Password 
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        
        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification); 

    }// End Method 


}
 