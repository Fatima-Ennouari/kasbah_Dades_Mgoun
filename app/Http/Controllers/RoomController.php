<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    // list all rooms with optional filter
    public function index(Request $request)
    {
        $query = Room::where('available', true);

        // filter by type if selected
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // filter by max price
        if ($request->filled('prix_max')) {
            $query->where('price', '<=', $request->prix_max);
        }

        // filter by capacity
        if ($request->filled('capacite')) {
            $query->where('capacity', '>=', $request->capacite);
        }

        $rooms = $query->orderBy('price')->get();

        return view('rooms.index', compact('rooms'));
    }

    // show one room detail
    public function show($id)
    {
        $room = Room::findOrFail($id);

        // show other similar rooms (same type, not this one)
        $similar = Room::where('type', $room->type)
                       ->where('id', '!=', $id)
                       ->where('available', true)
                       ->take(2)
                       ->get();

        return view('rooms.show', compact('room', 'similar'));
    }
}