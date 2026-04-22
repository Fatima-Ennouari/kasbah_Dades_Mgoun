@extends('layouts.app')

@section('title', 'Nos Chambres — Kasbah Dades Mgoun')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Nos Chambres & Suites</h1>
        <p>{{ $rooms->count() }} chambre(s) disponible(s) — Vue rivière, montagne, jardin ou piscine</p>
    </div>
</div>

{{-- FILTERS --}}
<section class="filters-bar">
    <div class="container">
        <form method="GET" action="{{ route('rooms.index') }}" class="filters-form">
            <div class="filter-group">
                <label>Type de chambre</label>
                <select name="type">
                    <option value="">Tous les types</option>
                    <option value="single"  {{ request('type') == 'single'  ? 'selected' : '' }}>Simple</option>
                    <option value="double"  {{ request('type') == 'double'  ? 'selected' : '' }}>Double</option>
                    <option value="family"  {{ request('type') == 'family'  ? 'selected' : '' }}>Familiale</option>
                    <option value="suite"   {{ request('type') == 'suite'   ? 'selected' : '' }}>Suite</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Budget max (MAD/nuit)</label>
                <select name="prix_max">
                    <option value="">Sans limite</option>
                    <option value="300" {{ request('prix_max') == '300' ? 'selected' : '' }}>Jusqu'à 300 MAD</option>
                    <option value="400" {{ request('prix_max') == '400' ? 'selected' : '' }}>Jusqu'à 400 MAD</option>
                    <option value="500" {{ request('prix_max') == '500' ? 'selected' : '' }}>Jusqu'à 500 MAD</option>
                    <option value="700" {{ request('prix_max') == '700' ? 'selected' : '' }}>Jusqu'à 700 MAD</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Nombre de personnes</label>
                <select name="capacite">
                    <option value="">Peu importe</option>
                    <option value="1" {{ request('capacite') == '1' ? 'selected' : '' }}>1 personne</option>
                    <option value="2" {{ request('capacite') == '2' ? 'selected' : '' }}>2 personnes</option>
                    <option value="3" {{ request('capacite') == '3' ? 'selected' : '' }}>3+ personnes</option>
                    <option value="4" {{ request('capacite') == '4' ? 'selected' : '' }}>4+ personnes</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filtrer</button>
            @if(request()->hasAny(['type','prix_max','capacite']))
                <a href="{{ route('rooms.index') }}" class="btn btn-outline">Réinitialiser</a>
            @endif
        </form>
    </div>
</section>

{{-- ROOMS LIST --}}
<section class="section">
    <div class="container">
        @if($rooms->isEmpty())
            <div class="empty-state">
                <span>🛏️</span>
                <h3>Aucune chambre ne correspond à vos critères</h3>
                <p>Essayez de modifier vos filtres ou consultez toutes nos chambres.</p>
                <a href="{{ route('rooms.index') }}" class="btn btn-primary">Voir toutes les chambres</a>
            </div>
        @else
            <div class="rooms-grid rooms-grid-full">
                @foreach($rooms as $room)
                <article class="room-card">
                    <div class="room-card-image">
                        @if($room->image)
                            <img src="{{ $room->image }}" alt="{{ $room->name }}" loading="lazy">
                        @else
                            <div class="room-card-placeholder">🛏️</div>
                        @endif
                        <span class="room-type-badge">{{ $room->type_label }}</span>
                        @if($room->view)
                            <span class="room-view-badge">{{ $room->view_label }}</span>
                        @endif
                    </div>
                    <div class="room-card-body">
                        <h3>{{ $room->name }}</h3>
                        <p>{{ Str::limit($room->description, 110) }}</p>
                        <div class="room-card-meta">
                            <span>👥 {{ $room->capacity }} pers. max</span>
                            @if($room->has_ac)     <span>❄️ Clim</span>     @endif
                            @if($room->has_balcony) <span>🪟 Balcon</span> @endif
                            <span>🚿 SDB privée</span>
                        </div>
                        <div class="room-card-footer">
                            <div class="room-price">
                                <span class="price-amount">{{ number_format($room->price, 0) }} MAD</span>
                                <span class="price-unit">/ nuit</span>
                            </div>
                            <div class="room-card-actions">
                                <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-sm btn-outline">Détails</a>
                                <a href="{{ route('reservation.create', ['chambre' => $room->id]) }}" class="btn btn-sm btn-primary">Réserver</a>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection