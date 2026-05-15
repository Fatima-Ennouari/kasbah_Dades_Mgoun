<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Reservation;

class ReservationController extends Controller
{
    ## show the reservation form
    public function create(Request $request)
    {
        $rooms = Room::where('available', true)->orderBy('name')->get();

        $selectedRoomId = $request->get('chambre');

        return view('reservation.form', compact('rooms', 'selectedRoomId'));
    }

    ## save reservation to database
    public function store(Request $request)
    {
        ## validate all fields
        $validated = $request->validate([
            'client_name'  => 'required|min:2|max:100',
            'client_email' => 'nullable|email',
            'client_phone' => 'nullable|min:8',
            'room_id'      => 'required|exists:rooms,id',
            'check_in'     => 'required|date|after_or_equal:today',
            'check_out'    => 'required|date|after:check_in',
            'num_people'   => 'required|integer|min:1|max:10',
            'notes'        => 'nullable|max:500',
        ], [
            'client_name.required'     => 'Le nom est obligatoire.',
            'room_id.required'         => 'Veuillez choisir une chambre.',
            'room_id.exists'           => 'La chambre choisie n\'existe pas.',
            'check_in.required'        => 'La date d\'arrivée est obligatoire.',
            'check_in.after_or_equal'  => 'La date d\'arrivée doit être aujourd\'hui ou plus tard.',
            'check_out.required'       => 'La date de départ est obligatoire.',
            'check_out.after'          => 'La date de départ doit être après l\'arrivée.',
            'num_people.required'      => 'Le nombre de personnes est obligatoire.',
        ]);

        ## check room capacity
        $room = Room::findOrFail($request->room_id);
        if ($request->num_people > $room->capacity) {
            return back()->withInput()
                         ->withErrors(['num_people' => 'Cette chambre accepte maximum ' . $room->capacity . ' personne(s).' ]);
        }

        ## save the reservation
        $reservation = Reservation::create([
            'client_name'  => $validated['client_name'],
            'client_email' => $validated['client_email'] ?? null,
            'client_phone' => $validated['client_phone'] ?? null,
            'room_id'      => $validated['room_id'],
            'check_in'     => $validated['check_in'],
            'check_out'    => $validated['check_out'],
            'num_people'   => $validated['num_people'],
            'notes'        => $validated['notes'] ?? null,
            'status'       => 'pending',
        ]);

        return redirect()->route('reservation.thanks')
                         ->with('reservation_id', $reservation->id);
    }

    public function thanks()
    {
        return view('reservation.thanks');
    }
}