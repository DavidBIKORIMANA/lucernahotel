<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\ActivityLog;

class ReviewController extends Controller
{
    public function AllReview()
    {
        $reviews = Review::with(['user', 'room', 'booking'])->latest()->get();
        return view('backend.review.all_review', compact('reviews'));
    }

    public function ApproveReview($id)
    {
        $review = Review::findOrFail($id);
        $review->approve();

        ActivityLog::record('review_approved', $review);

        $notification = array(
            'message' => 'Review Approved Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function DeleteReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        $notification = array(
            'message' => 'Review Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
