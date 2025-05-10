<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function index()
    {
        return response()->json(Reviews::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicles_id' => 'required|exists:vehicles,vehicles_id',
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review = Reviews::create([
            'users_id' => Auth::id(),
            'vehicles_id' => $request->vehicles_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json($review, 201);
    }

    public function update(Request $request, $id)
    {
        $review = Reviews::findOrFail($id);

        $this->authorize('update', $review);

        $review->update($request->only(['rating', 'comment']));

        return response()->json($review);
    }

    public function destroy($id)
    {
        $review = Reviews::findOrFail($id);

        $this->authorize('delete', $review);

        $review->delete();

        return response()->json(['message' => 'Review deleted successfully']);
    }
}
