@extends('layouts.admin')

@section('title', 'Réservation #' . $reservation->id)

@section('content')

<a href="{{ route('admin.reservations') }}" class="btn btn-sm btn-outline admin-form-back">← Retour</a>

<div class="admin-grid-2">

    <div class="admin-card">
        <div class="admin-card-header">
            <h3>Réservation #{{ $reservation->id }}</h3>
            <span class="status-badge status-{{ $reservation->status }}">
                {{ match($reservation->status) {
                    'pending'   => 'En attente',
                    'confirmed' => 'Confirmée',
                    'cancelled' => 'Annulée',
                    default     => $reservation->status
                } }}
            </span>
        </div>
        <div class="reservation-detail-grid">
            <div class="detail-row"><span>Client</span><strong>{{ $reservation->client_name }}</strong></div>
            <div class="detail-row"><span>Email</span><span>{{ $reservation->client_email ?? '—' }}</span></div>
            <div class="detail-row"><span>Téléphone</span><span>{{ $reservation->client_phone ?? '—' }}</span></div>
            <div class="detail-row"><span>Chambre</span><strong>{{ $reservation->room->name ?? '—' }}</strong></div>
            <div class="detail-row"><span>Arrivée</span><span>{{ $reservation->check_in->format('d/m/Y') }}</span></div>
            <div class="detail-row"><span>Départ</span><span>{{ $reservation->check_out->format('d/m/Y') }}</span></div>
            <div class="detail-row"><span>Durée</span><strong>{{ $reservation->nights }} nuit(s)</strong></div>
            <div class="detail-row"><span>Personnes</span><span>{{ $reservation->num_people }}</span></div>
            <div class="detail-row"><span>Total estimé</span><strong>{{ number_format($reservation->total, 0) }} MAD</strong></div>
            @if($reservation->notes)
            <div class="detail-row detail-row-full">
                <span>Remarques</span>
                <span>{{ $reservation->notes }}</span>
            </div>
            @endif
            <div class="detail-row"><span>Créé le</span><span>{{ $reservation->created_at->format('d/m/Y à H:i') }}</span></div>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card-header"><h3>Changer le statut</h3></div>
        <form action="{{ route('admin.reservations.status', $reservation->id) }}" method="POST" class="admin-form">
            @csrf
            <div class="form-group">
                <label>Nouveau statut</label>
                <select name="status">
                    <option value="pending"   {{ $reservation->status == 'pending'   ? 'selected' : '' }}>En attente</option>
                    <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                    <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #eee;">

        <a href="{{ route('admin.reservations.delete', $reservation->id) }}"
           class="btn btn-danger btn-block"
           onclick="return confirm('Supprimer définitivement cette réservation ?')">
            Supprimer la réservation
        </a>
    </div>
</div>

@endsection