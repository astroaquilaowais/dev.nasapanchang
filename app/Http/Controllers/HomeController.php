<?php

namespace App\Http\Controllers;

use App\Models\kundali;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    $kundalis = kundali::orderBy('created_at', 'DESC')->where('status', 1)->get();
    return view('home', ['kundalis' => $kundalis]); // Make sure 'kundalis' is passed correctly
}

    public function detail($id)
    {
        // Use the 'latest' method as an alternative to 'orderBy' for readability
        $relatedKundalis = Kundali::where('status', 1)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        // Using 'with' for eager loading relations (this part remains the same)
        $kundali = Kundali::with('reviews', 'reviews.user')->findOrFail($id);

        return view('kundali-detail', [
            'kundali' => $kundali,
            'relatedKundalis' => $relatedKundalis, // fixed inconsistent variable name
        ]);
    }

    public function saveReview(Request $request)
    {
        // Simplified validation with more descriptive error messages
        $validator = Validator::make($request->all(), [
            'review' => 'required|min:10',
            'rating' => 'required|integer|min:1|max:5', // Added validation for rating range
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        // Review creation
        $review = new Review();
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->user_id = Auth::user()->id;
        $review->kundali_id = $request->kundali_id; // Consistent camelCase 'kundali_id'
        $review->save();

        // Flash success message
        session()->flash('success', 'Review Submitted Successfully');

        return response()->json([
            'status' => true,
        ]);
    }
}
