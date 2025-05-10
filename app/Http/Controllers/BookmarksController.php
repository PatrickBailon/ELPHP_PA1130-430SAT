<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookmarksController extends Controller
{
    public function index()
    {
        return response()->json(Bookmarks::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicles_id' => 'required|exists:vehicles,vehicles_id',
        ]);

        $bookmark = Bookmarks::create([
            'users_id' => Auth::id(),
            'vehicles_id' => $request->vehicles_id,
        ]);

        return response()->json($bookmark, 201);
    }

    public function destroy($id)
    {
        $bookmark = Bookmarks::findOrFail($id);

        $this->authorize('delete', $bookmark);

        $bookmark->delete();

        return response()->json(['message' => 'Bookmark removed successfully']);
    }
}
