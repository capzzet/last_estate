<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewsController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('reviews', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'review' => 'required|string',
        ]);

        Review::create([
            'name' => $request->name,
            'email' => $request->email,
            'review' => $request->review,
        ]);

        return redirect()->back()->with('success', 'Отзыв успешно отправлен!');
    }
}
