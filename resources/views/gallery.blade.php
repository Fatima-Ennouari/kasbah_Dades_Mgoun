@extends('layouts.app')

@section('title', 'Galerie - Kasbah Dades Mgoun')

@section('content')

    <div class="page-header">
        <h1>📸 Galerie Photos</h1>
        <p>Un aperçu de notre kasbah et de son environnement magnifique.</p>
    </div>

    <div class="container">
        <!-- gallery categories text -->
        <div style="text-align: center; padding: 30px 0 10px;">
            <p style="color: var(--color-text-light);">
                Photos des chambres, du restaurant, de la piscine et des alentours de la vallée du Dadès.
            </p>
        </div>

        <!-- gallery grid - using emoji placeholders (replace with real images) -->
        <div class="gallery-grid">
            <div class="gallery-item" title="Vue sur la vallée du Dadès">🏔️</div>
            <div class="gallery-item" title="Chambre double traditionnelle">🛏️</div>
            <div class="gallery-item" title="Notre piscine extérieure">🏊</div>
            <div class="gallery-item" title="Tajine maison">🍲</div>
            <div class="gallery-item" title="Terrasse glissa">🌅</div>
            <div class="gallery-item" title="Salon berbère traditionnel">🪑</div>
            <div class="gallery-item" title="La kasbah vue de l'extérieur">🏯</div>
            <div class="gallery-item" title="Chemin vers les gorges">🌿</div>
            <div class="gallery-item" title="Thé à la menthe">☕</div>
            <div class="gallery-item" title="Coucher de soleil">🌄</div>
            <div class="gallery-item" title="Palmiers du jardin">🌴</div>
            <div class="gallery-item" title="Ciel étoilé">⭐</div>
        </div>

        <p style="text-align: center; color: #999; padding: 20px 0 40px; font-size: 0.85rem;">
            <!-- note to self: replace emojis with real photos later -->
            📷 Plus de photos sur demande - contactez-nous!
        </p>
    </div>

@endsection