@extends('layouts.admin')

@section('title', 'Réservations')

@section('content')

<div class="admin-card">
    <div class="admin-card-header">
        <h3>Toutes les réservations ({{ $reservations->count() }})</h3>
    </div>
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Chambre</th>
                    <th>Arrivée</th>
                    <th>Départ</th>
                    <th>Nuits</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $res)
                <tr>
                    <td>{{ $res->id }}</td>
                    <td>
                        <strong>{{ $res->client_name }}</strong><br>
                        <small>{{ $res->client_phone ?? $res->client_email ?? '—' }}</small>
                    </td>
                    <td>{{ $res->room->name ?? '—' }}</td>
                    <td>{{ $res->check_in->format('d/m/Y') }}</td>
                    <td>{{ $res->check_out->format('d/m/Y') }}</td>
                    <td>{{ $res->nights }}</td>
                    <td>{{ number_format($res->total, 0) }} MAD</td>
                    <td>
                        <span class="status-badge status-{{ $res->status }}">
                            {{ match($res->status) {
                                'pending'   => 'En attente',
                                'confirmed' => 'Confirmée',
                                'cancelled' => 'Annulée',
                                default     => $res->status
                            } }}
                        </span>
                    </td>
                    <td class="admin-actions">
                        <a href="{{ route('admin.reservations.show', $res->id) }}" class="btn btn-sm btn-outline">Voir</a>
                        <a href="{{ route('admin.reservations.delete', $res->id) }}"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Supprimer cette réservation ?')">
                            Suppr.
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="empty-row">Aucune réservation.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection