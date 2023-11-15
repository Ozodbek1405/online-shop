<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;

class ReviewController extends Controller
{
    public function review(ReviewRequest $request)
    {
        $data = $request->validated();
        Review::query()->create($data);
        return redirect()->back()->with(['success' => 'Saved successfully']);
    }
}
