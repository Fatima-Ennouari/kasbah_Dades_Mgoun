@extends('layouts.admin')

@section('title', 'Clients')

@section('content')

<div class="admin-card">
    <div class="admin-card-header">
        <h3>Liste des clients ({{ $clients->count() }})</h3>
    </div>
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Réservations</th>
                    <th>Nuits totales</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td><strong>{{ $client->client_name }}</strong></td>
                    <td>{{ $client->client_email ?? '—' }}</td>
                    <td>{{ $client->client_phone ?? '—' }}</td>
                    <td>
                        <span class="status-badge status-confirmed">
                            {{ $client->total_reservations }} réservation(s)
                        </span>
                    </td>
                    <td>{{ $client->total_nights ?? 0 }} nuit(s)</td>
                </tr>
                @empty
                <tr><td colspan="5" class="empty-row">Aucun client.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection