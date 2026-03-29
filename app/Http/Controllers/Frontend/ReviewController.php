<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Booking;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function StoreReview(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'room_id' => 'required|exists:rooms,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'title' => 'nullable|string|max:255',
        ]);

        $booking = Booking::where('id', $request->booking_id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();

        // Check if review already exists for this booking
        $existing = Review::where('booking_id', $booking->id)
                          ->where('user_id', Auth::id())
                          ->first();

        if ($existing) {
            $notification = array(
                'message' => 'You have already reviewed this booking',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        Review::create([
            'booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'rating' => $request->rating,
            'title' => $request->title,
            'comment' => $request->comment,
            'is_approved' => false,
        ]);

        ActivityLog::record('review_submitted', $booking);

        $notification = array(
            'message' => 'Thank you for your review! It will be visible after approval.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
