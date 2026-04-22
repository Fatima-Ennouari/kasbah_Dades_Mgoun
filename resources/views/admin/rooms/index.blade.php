@extends('layouts.admin')

@section('title', 'Gestion des Chambres')

@section('content')

<div class="admin-card">
    <div class="admin-card-header">
        <h3>Toutes les chambres ({{ $rooms->count() }})</h3>
        <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary btn-sm">+ Ajouter une chambre</a>
    </div>
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Chambre</th>
                    <th>Type</th>
                    <th>Vue</th>
                    <th>Capacité</th>
                    <th>Prix/nuit</th>
                    <th>Disponible</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                <tr>
                    <td>
                        <div class="admin-room-name">
                            @if($room->image)
                                <img src="{{ $room->image }}" alt="" class="admin-room-thumb">
                            @endif
                            <strong>{{ $room->name }}</strong>
                        </div>
                    </td>
                    <td>{{ $room->type_label }}</td>
                    <td>{{ $room->view_label ?: '—' }}</td>
                    <td>{{ $room->capacity }} pers.</td>
                    <td><strong>{{ number_format($room->price, 0) }} MAD</strong></td>
                    <td>
                        @if($room->available)
                            <span class="status-badge status-confirmed">Oui</span>
                        @else
                            <span class="status-badge status-cancelled">Non</span>
                        @endif
                    </td>
                    <td class="admin-actions">
                        <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-sm btn-outline">Modifier</a>
                        <a href="{{ route('admin.rooms.delete', $room->id) }}"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Supprimer cette chambre ? Cette action est irréversible.')">
                            Supprimer
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection