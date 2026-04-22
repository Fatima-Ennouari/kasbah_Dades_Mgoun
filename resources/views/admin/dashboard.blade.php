@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')

{{-- Stats cards --}}
<div class="admin-stats-grid">
    <div class="stat-card">
        <div class="stat-icon">🛏️</div>
        <div class="stat-body">
            <div class="stat-number">{{ $stats['total_rooms'] }}</div>
            <div class="stat-label">Total chambres</div>
            <div class="stat-sub">{{ $stats['available_rooms'] }} disponibles</div>
        </div>
    </div>
    <div class="stat-card stat-card-primary">
        <div class="stat-icon">📋</div>
        <div class="stat-body">
            <div class="stat-number">{{ $stats['total_reservations'] }}</div>
            <div class="stat-label">Réservations</div>
            <div class="stat-sub">{{ $stats['pending'] }} en attente</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">✅</div>
        <div class="stat-body">
            <div class="stat-number">{{ $stats['confirmed'] }}</div>
            <div class="stat-label">Confirmées</div>
            <div class="stat-sub">ce mois</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">👥</div>
        <div class="stat-body">
            <div class="stat-number">{{ $stats['total_clients'] }}</div>
            <div class="stat-label">Clients uniques</div>
            <div class="stat-sub">depuis l'ouverture</div>
        </div>
    </div>
</div>

{{-- Recent reservations --}}
<div class="admin-card">
    <div class="admin-card-header">
        <h3>Réservations récentes</h3>
        <a href="{{ route('admin.reservations') }}" class="btn btn-sm btn-outline">Voir tout →</a>
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
                    <th>Personnes</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent as $res)
                <tr>
                    <td>{{ $res->id }}</td>
                    <td>
                        <strong>{{ $res->client_name }}</strong>
                        @if($res->client_phone)
                            <br><small>{{ $res->client_phone }}</small>
                        @endif
                    </td>
                    <td>{{ $res->room->name ?? '—' }}</td>
                    <td>{{ $res->check_in->format('d/m/Y') }}</td>
                    <td>{{ $res->check_out->format('d/m/Y') }}</td>
                    <td>{{ $res->num_people }}</td>
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
                    <td>
                        <a href="{{ route('admin.reservations.show', $res->id) }}"
                           class="btn btn-sm btn-outline">Voir</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="empty-row">Aucune réservation pour le moment.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection