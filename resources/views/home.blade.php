@extends('layouts.app')

@section('title', 'Kasbah Dades Mgoun — Maison d\'hôtes traditionnelle, Kelâat M\'Gouna')

@section('content')

{{-- ── HERO SECTION ─────────────────────────── --}}
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-content">
        <p class="hero-pre">Bienvenue dans la Vallée des Roses</p>
        <h1 class="hero-title">Kasbah Dades Mgoun</h1>
        <p class="hero-subtitle">
            Maison d'hôtes traditionnelle à Kelâat M'Gouna —
            une expérience berbère authentique au cœur des roses du Dadès.
        </p>
        <div class="hero-badges">
            <span class="hero-badge">★★ 2 étoiles</span>
            <span class="hero-badge">🌊 Piscine eau salée</span>
            <span class="hero-badge">🌐 WiFi gratuit</span>
            <span class="hero-badge">🅿️ Parking gratuit</span>
        </div>
        <div class="hero-actions">
            <a href="{{ route('rooms.index') }}" class="btn btn-primary btn-lg">Voir les chambres</a>
            <a href="{{ route('reservation.create') }}" class="btn btn-outline-light btn-lg">Réserver maintenant</a>
        </div>
    </div>
    <div class="hero-scroll-hint">
        <span>↓</span>
        <span>Découvrir</span>
    </div>
</section>

{{-- ── QUICK INFO BAR ──────────────────────── --}}
<section class="info-bar">
    <div class="container">
        <div class="info-bar-grid">
            <div class="info-bar-item">
                <span class="info-bar-icon">📍</span>
                <div>
                    <strong>Kelâat M'Gouna</strong>
                    <small>Province de Tinghir, Maroc</small>
                </div>
            </div>
            <div class="info-bar-item">
                <span class="info-bar-icon">🛎️</span>
                <div>
                    <strong>Réception 24h/24</strong>
                    <small>Service de chambre disponible</small>
                </div>
            </div>
            <div class="info-bar-item">
                <span class="info-bar-icon">🐾</span>
                <div>
                    <strong>Animaux acceptés</strong>
                    <small>Sans frais supplémentaires</small>
                </div>
            </div>
            <div class="info-bar-item">
                <span class="info-bar-icon">💳</span>
                <div>
                    <strong>Paiement à l'arrivée</strong>
                    <small>Aucun paiement en avance requis</small>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── ABOUT SECTION ───────────────────────── --}}
<section class="section section-about">
    <div class="container">
        <div class="about-grid">
            <div class="about-text">
                <span class="section-eyebrow">Notre histoire</span>
                <h2>Un havre de paix dans la Vallée des Roses</h2>
                <p>
                    Nichée entre les gorges du Dadès et les champs de roses de Kelâat M'Gouna,
                    notre kasbah familiale vous accueille dans un cadre naturel exceptionnel.
                    Les murs de pisé, les zellige colorés et les tapis berbères tissés à la main
                    vous plongent dans l'authenticité du Maroc profond.
                </p>
                <p>
                    Chaque chambre est unique — certaines avec balcon sur la rivière, d'autres
                    avec vue directe sur le Jbel Mgoun. Notre restaurant propose une cuisine marocaine
                    authentique : tajines, couscous et petit-déjeuner halal chaque matin.
                </p>
                <div class="about-features">
                    <div class="about-feature">
                        <span>🏊</span>
                        <span>Piscine à eau salée</span>
                    </div>
                    <div class="about-feature">
                        <span>🌿</span>
                        <span>Jardin & terrasse</span>
                    </div>
                    <div class="about-feature">
                        <span>🍽️</span>
                        <span>Restaurant halal</span>
                    </div>
                    <div class="about-feature">
                        <span>🚿</span>
                        <span>SDB privée avec bidet</span>
                    </div>
                    <div class="about-feature">
                        <span>❄️</span>
                        <span>Climatisation</span>
                    </div>
                    <div class="about-feature">
                        <span>🌐</span>
                        <span>WiFi dans tout l'hôtel</span>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="btn btn-primary" style="margin-top:20px;">Nous contacter</a>
            </div>
            <div class="about-image-wrapper">
                <img
                    src="https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=600&q=80"
                    alt="Kasbah traditionnelle marocaine"
                    class="about-image"
                    loading="lazy"
                >
                <div class="about-image-badge">
                    <span>3 générations</span>
                    <small>d'hospitalité berbère</small>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── FEATURED ROOMS ──────────────────────── --}}
<section class="section section-gray">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Nos hébergements</span>
            <h2>Chambres sélectionnées</h2>
            <p>Vue rivière, vue montagne, vue jardin... chaque chambre raconte une histoire.</p>
        </div>

        <div class="rooms-grid">
            @foreach($featured as $room)
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
                    <p>{{ Str::limit($room->description, 100) }}</p>
                    <div class="room-card-meta">
                        <span title="Capacité">👥 {{ $room->capacity }} pers.</span>
                        @if($room->has_ac) <span title="Climatisation">❄️ Clim</span> @endif
                        @if($room->has_balcony) <span title="Balcon">🪟 Balcon</span> @endif
                    </div>
                    <div class="room-card-footer">
                        <div class="room-price">
                            <span class="price-amount">{{ number_format($room->price, 0) }} MAD</span>
                            <span class="price-unit">/ nuit</span>
                        </div>
                        <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-sm btn-primary">
                            Voir détails
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="section-action">
            <a href="{{ route('rooms.index') }}" class="btn btn-outline">Voir toutes les chambres →</a>
        </div>
    </div>
</section>

{{-- ── AMENITIES GRID ──────────────────────── --}}
<section class="section section-amenities">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Équipements & Services</span>
            <h2>Tout ce qu'il vous faut</h2>
        </div>
        <div class="amenities-grid">
            <div class="amenity-card">
                <span class="amenity-icon">🏊</span>
                <h4>Piscine à eau salée</h4>
                <p>Plongez dans notre belle piscine extérieure avec vue sur le jardin et les montagnes.</p>
            </div>
            <div class="amenity-card">
                <span class="amenity-icon">🍽️</span>
                <h4>Restaurant Halal</h4>
                <p>Cuisine marocaine authentique avec options végétariennes, veganes et sans gluten.</p>
            </div>
            <div class="amenity-card">
                <span class="amenity-icon">🌿</span>
                <h4>Jardin & Terrasse</h4>
                <p>Profitez de notre jardin fleuri et de la terrasse panoramique avec vue sur la vallée.</p>
            </div>
            <div class="amenity-card">
                <span class="amenity-icon">❄️</span>
                <h4>Climatisation</h4>
                <p>Toutes nos chambres sont climatisées pour votre confort en toutes saisons.</p>
            </div>
            <div class="amenity-card">
                <span class="amenity-icon">🅿️</span>
                <h4>Parking Privé</h4>
                <p>Stationnement gratuit et sécurisé sur place. Pas besoin de chercher.</p>
            </div>
            <div class="amenity-card">
                <span class="amenity-icon">🐾</span>
                <h4>Animaux Bienvenus</h4>
                <p>Votre animal de compagnie est le bienvenu sans frais supplémentaires.</p>
            </div>
        </div>
    </div>
</section>

{{-- ── CTA BAND ─────────────────────────────── --}}
<section class="cta-band">
    <div class="container">
        <div class="cta-band-content">
            <h2>Prêt à vivre l'expérience berbère?</h2>
            <p>Réservez directement et bénéficiez du meilleur tarif. Paiement à l'arrivée.</p>
            <div class="cta-band-actions">
                <a href="{{ route('reservation.create') }}" class="btn btn-primary btn-lg">Réserver maintenant</a>
                <a href="tel:+2125XXXXXXX" class="btn btn-outline-light">📞 Nous appeler</a>
            </div>
        </div>
    </div>
</section>

@endsection