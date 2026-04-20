<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Reservation;

class AdminController extends Controller
{
    // simple auth check - redirect to login if not logged in
    private function requireAuth()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return null;
    }

    // ── AUTH ─────────────────────────────────

    public function loginForm()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect.'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }

    // ── DASHBOARD ────────────────────────────

    public function dashboard()
    {
        if ($r = $this->requireAuth()) return $r;

        $stats = [
            'total_rooms'        => Room::count(),
            'available_rooms'    => Room::where('available', true)->count(),
            'total_reservations' => Reservation::count(),
            'pending'            => Reservation::where('status', 'pending')->count(),
            'confirmed'          => Reservation::where('status', 'confirmed')->count(),
            'total_clients'      => Reservation::distinct('client_name')->count(),
        ];

        $recent = Reservation::with('room')
                              ->latest()
                              ->take(6)
                              ->get();

        return view('admin.dashboard', compact('stats', 'recent'));
    }

    // ── ROOMS CRUD ───────────────────────────

    public function rooms()
    {
        if ($r = $this->requireAuth()) return $r;
        $rooms = Room::orderBy('type')->orderBy('name')->get();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function createRoom()
    {
        if ($r = $this->requireAuth()) return $r;
        return view('admin.rooms.form', ['room' => null]);
    }

    public function storeRoom(Request $request)
    {
        if ($r = $this->requireAuth()) return $r;

        $request->validate([
            'name'        => 'required|max:150',
            'type'        => 'required|in:single,double,family,suite',
            'price'       => 'required|numeric|min:1',
            'capacity'    => 'required|integer|min:1|max:10',
            'view'        => 'nullable|in:river,garden,mountain,pool',
            'description' => 'required|min:20',
            'image'       => 'nullable|url|max:500',
        ]);

        Room::create([
            'name'        => $request->name,
            'type'        => $request->type,
            'price'       => $request->price,
            'capacity'    => $request->capacity,
            'view'        => $request->view,
            'has_balcony' => $request->boolean('has_balcony'),
            'has_ac'      => $request->boolean('has_ac'),
            'description' => $request->description,
            'image'       => $request->image,
            'available'   => $request->boolean('available'),
        ]);

        return redirect()->route('admin.rooms')
                         ->with('success', 'Chambre ajoutée avec succès.');
    }

    public function editRoom($id)
    {
        if ($r = $this->requireAuth()) return $r;
        $room = Room::findOrFail($id);
        return view('admin.rooms.form', compact('room'));
    }

    public function updateRoom(Request $request, $id)
    {
        if ($r = $this->requireAuth()) return $r;

        $room = Room::findOrFail($id);

        $request->validate([
            'name'        => 'required|max:150',
            'type'        => 'required|in:single,double,family,suite',
            'price'       => 'required|numeric|min:1',
            'capacity'    => 'required|integer|min:1|max:10',
            'view'        => 'nullable|in:river,garden,mountain,pool',
            'description' => 'required|min:20',
            'image'       => 'nullable|url|max:500',
        ]);

        $room->update([
            'name'        => $request->name,
            'type'        => $request->type,
            'price'       => $request->price,
            'capacity'    => $request->capacity,
            'view'        => $request->view,
            'has_balcony' => $request->boolean('has_balcony'),
            'has_ac'      => $request->boolean('has_ac'),
            'description' => $request->description,
            'image'       => $request->image,
            'available'   => $request->boolean('available'),
        ]);

        return redirect()->route('admin.rooms')
                         ->with('success', 'Chambre modifiée avec succès.');
    }

    public function deleteRoom($id)
    {
        if ($r = $this->requireAuth()) return $r;

        $room = Room::findOrFail($id);

        if ($room->reservations()->count() > 0) {
            return redirect()->route('admin.rooms')
                             ->with('error', 'Impossible de supprimer: cette chambre a des réservations.');
        }

        $room->delete();
        return redirect()->route('admin.rooms')
                         ->with('success', 'Chambre supprimée.');
    }

    // ── RESERVATIONS ─────────────────────────

    public function reservations()
    {
        if ($r = $this->requireAuth()) return $r;

        $reservations = Reservation::with('room')
                                    ->latest()
                                    ->get();

        return view('admin.reservations.index', compact('reservations'));
    }

    public function showReservation($id)
    {
        if ($r = $this->requireAuth()) return $r;
        $reservation = Reservation::with('room')->findOrFail($id);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function updateStatus(Request $request, $id)
    {
        if ($r = $this->requireAuth()) return $r;

        $request->validate(['status' => 'required|in:pending,confirmed,cancelled']);

        Reservation::findOrFail($id)->update(['status' => $request->status]);

        return back()->with('success', 'Statut mis à jour.');
    }

    public function deleteReservation($id)
    {
        if ($r = $this->requireAuth()) return $r;
        Reservation::findOrFail($id)->delete();
        return redirect()->route('admin.reservations')
                         ->with('success', 'Réservation supprimée.');
    }

    // ── CLIENTS ──────────────────────────────

    public function clients()
    {
        if ($r = $this->requireAuth()) return $r;

        $clients = Reservation::select(
                        'client_name', 'client_email', 'client_phone'
                    )
                    ->selectRaw('COUNT(*) as total_reservations')
                    ->selectRaw('SUM(DATEDIFF(check_out, check_in)) as total_nights')
                    ->groupBy('client_name', 'client_email', 'client_phone')
                    ->orderByDesc('total_reservations')
                    ->get();

        return view('admin.clients', compact('clients'));
    }
}