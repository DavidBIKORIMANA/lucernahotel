<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomNumber;
use App\Models\RoomBookedDate;
use App\Models\Review;
use App\Models\Contact;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
 
class AdminController extends Controller
{
    public function AdminDashboard(){

        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $startOfYear = Carbon::now()->startOfYear();
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        // ── Bookings ──
        $allBookings = Booking::with(['user', 'room.type'])->get();
        $monthlyBookings = $allBookings->filter(fn($b) => $b->created_at >= $startOfMonth);
        $lastMonthBookings = Booking::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

        // ── Revenue ──
        $monthlyRevenue = Booking::where('payment_status', 1)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total_price');
        $lastMonthRevenue = Booking::where('payment_status', 1)
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->sum('total_price');
        $revenueTrend = $lastMonthRevenue > 0
            ? round((($monthlyRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1)
            : ($monthlyRevenue > 0 ? 100 : 0);

        $yearlyRevenue = Booking::where('payment_status', 1)
            ->where('created_at', '>=', $startOfYear)
            ->sum('total_price');

        // ── Booking counts ──
        $bookingsTrend = $lastMonthBookings > 0
            ? round((($monthlyBookings->count() - $lastMonthBookings) / $lastMonthBookings) * 100, 1)
            : ($monthlyBookings->count() > 0 ? 100 : 0);

        // ── Total rooms & occupancy ──
        $totalRooms = RoomNumber::where('status', 'Active')->count();
        $occupiedToday = RoomBookedDate::where('book_date', $today)->distinct('room_id')->count('room_id');
        $occupancyRate = $totalRooms > 0 ? round(($occupiedToday / $totalRooms) * 100) : 0;

        // ── Guests this year ──
        $yearlyGuests = Booking::where('created_at', '>=', $startOfYear)->sum('persion');
        $lastYearGuests = Booking::whereBetween('created_at', [
            Carbon::now()->subYear()->startOfYear(),
            Carbon::now()->subYear()->endOfYear()
        ])->sum('persion');
        $guestsTrend = $lastYearGuests > 0
            ? round((($yearlyGuests - $lastYearGuests) / $lastYearGuests) * 100, 1)
            : ($yearlyGuests > 0 ? 100 : 0);

        // ── Monthly revenue chart data (12 months) ──
        $monthlyRevenueData = [];
        $lastYearRevenueData = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyRevenueData[] = (int) Booking::where('payment_status', 1)
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $m)
                ->sum('total_price');
            $lastYearRevenueData[] = (int) Booking::where('payment_status', 1)
                ->whereYear('created_at', Carbon::now()->subYear()->year)
                ->whereMonth('created_at', $m)
                ->sum('total_price');
        }

        // ── Room types with availability ──
        $roomTypes = RoomType::where('status', 'active')->withCount([
            'room_numbers as total_rooms' => fn($q) => $q->where('status', 'Active'),
        ])->get();

        $bookedRoomIdsToday = RoomBookedDate::where('book_date', $today)->pluck('room_id')->unique();

        foreach ($roomTypes as $type) {
            $typeRoomIds = RoomNumber::where('room_type_id', $type->id)->where('status', 'Active')->pluck('rooms_id')->unique();
            $bookedCount = RoomBookedDate::where('book_date', $today)
                ->whereIn('room_id', $typeRoomIds)
                ->distinct('room_id')
                ->count('room_id');
            $type->available_rooms = $type->total_rooms - $bookedCount;
            $type->occupied_pct = $type->total_rooms > 0 ? round(($bookedCount / $type->total_rooms) * 100) : 0;
        }

        // ── Donut chart data ──
        $reservedToday = Booking::where('status', 1)
            ->whereDate('check_in', '>', $today)
            ->count();
        $availableRooms = max(0, $totalRooms - $occupiedToday);

        // ── Recent bookings (last 8) ──
        $recentBookings = Booking::with(['user', 'room.type'])
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // ── Recent activity ──
        $recentActivity = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // ── Pending counts for sidebar badges ──
        $pendingBookings = $allBookings->where('status', 0)->count();
        $pendingReviews = Review::where('is_approved', false)->count();
        $contactCount = Contact::whereDate('created_at', '>=', Carbon::now()->subDays(30))->count();

        return view('admin.index', compact(
            'monthlyRevenue', 'revenueTrend', 'yearlyRevenue',
            'monthlyBookings', 'bookingsTrend', 'lastMonthBookings',
            'totalRooms', 'occupiedToday', 'occupancyRate', 'availableRooms',
            'yearlyGuests', 'guestsTrend',
            'monthlyRevenueData', 'lastYearRevenueData',
            'roomTypes', 'reservedToday',
            'recentBookings', 'recentActivity',
            'pendingBookings', 'pendingReviews', 'contactCount'
        ));

    } // End Method 

    public function AdminLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    } // End Method 

    public function AdminLogin(){

        return view('admin.admin_login');

    }// End Method 

    public function AdminProfile(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view',compact('profileData'));

    }// End Method 


    public function AdminProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();  
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;

        }
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method 


    public function AdminChangePassword(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password',compact('profileData'));

    }// End Method 

    public function AdminPasswordUpdate(Request $request){

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


    //////////// Admin User all Method//////////

    public function AllAdmin(){

        $alladmin = User::role('admin')->get();
        return view('backend.pages.admin.all_admin',compact('alladmin'));

    }// End Method 

    public function AddAdmin(){

        $roles = Role::all();
        return view('backend.pages.admin.add_admin',compact('roles'));

    }// End Method 

    public function StoreAdmin(Request $request){

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'phone'    => 'nullable|string|max:30',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password =  Hash::make($request->password);
        $user->status = 'inactive';
        $user->save();

        $user->assignRole('admin');
        if ($request->roles) {
           $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'Admin User Created Successfully. Account needs verification before login.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification); 

    }// End Method 


    public function EditAdmin($id){

        $user = User::find($id);
        $roles = Role::all();
        return view('backend.pages.admin.edit_admin',compact('user','roles'));
        
    }// End Method 

    public function UpdateAdmin(Request $request,$id){

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'phone' => 'nullable|string|max:30',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address; 
        $user->save();

        $user->roles()->detach();
        $user->assignRole('admin');
        if ($request->roles) {
           $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'Admin User Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification); 

    }// End Method 


    public function ToggleAdminStatus($id){

        $user = User::findOrFail($id);
        $user->status = ($user->status === 'active') ? 'inactive' : 'active';
        $user->save();

        $statusLabel = ($user->status === 'active') ? 'verified' : 'unverified';

        $notification = array(
            'message' => 'Admin User ' . $user->name . ' is now ' . $statusLabel,
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method 


    public function DeleteAdmin($id){

        $user = User::find($id);
        if (!is_null($user)) {
            $user->delete();
        }

        $notification = array(
            'message' => 'Admin User Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 




}
 