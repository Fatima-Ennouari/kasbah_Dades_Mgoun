@extends('layouts.app')

@section('title', $room->name . ' — Kasbah Dades Mgoun')

@section('content')

{{-- breadcrumb --}}
<div class="breadcrumb-bar">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Accueil</a>
            <span>›</span>
            <a href="{{ route('rooms.index') }}">Chambres</a>
            <span>›</span>
            <span>{{ $room->name }}</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="room-detail-grid">

            {{-- LEFT: image & details --}}
            <div class="room-detail-left">

                <div class="room-detail-image">
                    @if($room->image)
                        <img src="{{ $room->image }}" alt="{{ $room->name }}">
                    @else
                        <div class="room-detail-placeholder">🛏️</div>
                    @endif
                </div>

                <div class="room-detail-info">
                    <div class="room-detail-badges">
                        <span class="badge badge-type">{{ $room->type_label }}</span>
                        @if($room->view)
                            <span class="badge badge-view">{{ $room->view_label }}</span>
                        @endif
                        @if($room->available)
                            <span class="badge badge-available">Disponible</span>
                        @else
                            <span class="badge badge-unavailable">Non disponible</span>
                        @endif
                    </div>

                    <h1>{{ $room->name }}</h1>
                    <p class="room-detail-description">{{ $room->description }}</p>

                    {{-- Room features --}}
                    <div class="room-features-grid">
                        <div class="room-feature">
                            <span class="room-feature-icon">👥</span>
                            <div>
                                <strong>Capacité</strong>
                                <span>{{ $room->capacity }} personne(s) maximum</span>
                            </div>
                        </div>
                        <div class="room-feature">
                            <span class="room-feature-icon">🚿</span>
                            <div>
                                <strong>Salle de bain</strong>
                                <span>Privée avec bidet, sèche-cheveux</span>
                            </div>
                        </div>
                        @if($room->has_ac)
                        <div class="room-feature">
                            <span class="room-feature-icon">❄️</span>
                            <div>
                                <strong>Climatisation</strong>
                                <span>Incluse dans la chambre</span>
                            </div>
                        </div>
                        @endif
                        @if($room->has_balcony)
                        <div class="room-feature">
                            <span class="room-feature-icon">🪟</span>
                            <div>
                                <strong>Balcon privé</strong>
                                <span>{{ $room->view_label }}</span>
                            </div>
                        </div>
                        @endif
                        <div class="room-feature">
                            <span class="room-feature-icon">🛏️</span>
                            <div>
                                <strong>Produits de toilette</strong>
                                <span>Offerts à l'arrivée</span>
                            </div>
                        </div>
                        <div class="room-feature">
                            <span class="room-feature-icon">🌐</span>
                            <div>
                                <strong>WiFi</strong>
                                <span>Gratuit dans toute la kasbah</span>
                            </div>
                        </div>
                    </div>

                    {{-- Hotel amenities reminder --}}
                    <div class="hotel-amenities-reminder">
                        <h4>Accès aux équipements de l'hôtel</h4>
                        <div class="amenities-tags">
                            <span>🏊 Piscine eau salée</span>
                            <span>🌿 Jardin</span>
                            <span>🌅 Terrasse panoramique</span>
                            <span>🍽️ Restaurant halal</span>
                            <span>🅿️ Parking gratuit</span>
                            <span>🛎️ Service de chambre</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- RIGHT: booking box --}}
            <div class="room-detail-right">
                <div class="booking-box">
                    <div class="booking-box-price">
                        <span class="booking-price-amount">{{ number_format($room->price, 0) }} MAD</span>
                        <span class="booking-price-unit">par nuit</span>
                    </div>
                    <p class="booking-included">Petit-déjeuner inclus · Paiement à l'arrivée</p>

                    @if($room->available)
                        <a href="{{ route('reservation.create', ['chambre' => $room->id]) }}"
                           class="btn btn-primary btn-block btn-lg">
                            Réserver cette chambre
                        </a>
                    @else
                        <button class="btn btn-disabled btn-block" disabled>
                            Non disponible actuellement
                        </button>
                    @endif

                    <div class="booking-policies">
                        <div class="policy-item">
                            <span>✅</span>
                            <span>Annulation flexible disponible</span>
                        </div>
                        <div class="policy-item">
                            <span>💳</span>
                            <span>Aucun paiement en avance</span>
                        </div>
                        <div class="policy-item">
                            <span>📞</span>
                            <span>Confirmation sous 24h</span>
                        </div>
                        <div class="policy-item">
                            <span>🐾</span>
                            <span>Animaux acceptés (gratuit)</span>
                        </div>
                    </div>

                    <div class="booking-contact">
                        <p>Des questions? Contactez-nous:</p>
                        <a href="tel:+212708127300" class="btn btn-outline btn-block">📞 Appeler l'hôtel</a>
                    </div>
                </div>

                {{-- Location info --}}
                <div class="location-box">
                    <h4>📍 Localisation</h4>
                    <p>Kelâat M'Gouna, Province de Tinghir</p>
                    <ul>
                        <li>83 km d'Ouarzazate Airport</li>
                        <li>47 km de la Kasbah Amridil</li>
                        <li>Gorges du Dadès à proximité</li>
                        <li>Champs de roses de M'Gouna</li>
                    </ul>
                </div>
            </div>

        </div>

        {{-- Similar rooms --}}
        @if($similar->isNotEmpty())
        <div class="similar-rooms">
            <h3>Chambres similaires</h3>
            <div class="rooms-grid">
                @foreach($similar as $sim)
                <article class="room-card">
                    <div class="room-card-image">
                        @if($sim->image)
                            <img src="{{ $sim->image }}" alt="{{ $sim->name }}" loading="lazy">
                        @else
                            <div class="room-card-placeholder">🛏️</div>
                        @endif
                        <span class="room-type-badge">{{ $sim->type_label }}</span>
                    </div>
                    <div class="room-card-body">
                        <h3>{{ $sim->name }}</h3>
                        <p>{{ Str::limit($sim->description, 80) }}</p>
                        <div class="room-card-footer">
                            <div class="room-price">
                                <span class="price-amount">{{ number_format($sim->price, 0) }} MAD</span>
                                <span class="price-unit">/ nuit</span>
                            </div>
                            <a href="{{ route('rooms.show', $sim->id) }}" class="btn btn-sm btn-primary">Voir</a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

@endsection