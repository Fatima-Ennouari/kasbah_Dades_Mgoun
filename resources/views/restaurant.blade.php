@extends('layouts.app')

@section('title', 'Restaurant — Kasbah Dades Mgoun')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Notre Restaurant</h1>
        <p>Cuisine marocaine authentique — Halal, végétarien, végan et sans gluten disponibles</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="restaurant-layout">

            <div class="restaurant-main">

                {{-- Ambiance --}}
                <div class="restaurant-intro">
                    <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800&q=80"
                         alt="Restaurant de la Kasbah" class="restaurant-hero-img" loading="lazy">
                    <div class="restaurant-intro-text">
                        <span class="section-eyebrow">Notre table</span>
                        <h2>Des saveurs authentiques du Maroc</h2>
                        <p>
                            Notre restaurant vous invite à découvrir la richesse de la cuisine marocaine traditionelle.
                            Préparés chaque matin avec des produits locaux frais de la région de Kelâat M'Gouna,
                            nos plats respectent les recettes familiales transmises depuis des générations.
                        </p>
                        <p>
                            L'ambiance peut être traditionnelle, moderne ou romantique selon vos préférences.
                            Nous servons le brunch, le déjeuner, le dîner et le thé de l'après-midi.
                        </p>
                        <div class="restaurant-labels">
                            <span class="label-badge">🥩 Halal certifié</span>
                            <span class="label-badge">🥗 Végétarien</span>
                            <span class="label-badge">🌱 Végan</span>
                            <span class="label-badge">🌾 Sans gluten</span>
                        </div>
                    </div>
                </div>

                {{-- Menus --}}
                <div class="menu-section">
                    <h3 class="menu-category-title">🌅 Petit-déjeuner (inclus dans le séjour)</h3>
                    <p class="menu-category-note">Servi de 7h à 10h — Continental, buffet, végétarien, végan et halal</p>
                    <div class="menu-grid">
                        <div class="menu-item">
                            <div class="menu-item-info">
                                <span class="menu-item-name">Petit-déjeuner Continental</span>
                                <span class="menu-item-desc">Pain, beurre, confiture, fromage, jus d'orange</span>
                            </div>
                            <span class="menu-item-price included">Inclus</span>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-info">
                                <span class="menu-item-name">Msemen et Rghaif</span>
                                <span class="menu-item-desc">Crêpes marocaines traditionnelles avec miel et amlou</span>
                            </div>
                            <span class="menu-item-price included">Inclus</span>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-info">
                                <span class="menu-item-name">Œufs Berbère</span>
                                <span class="menu-item-desc">Œufs au plat avec khlii (viande séchée) et tomates</span>
                            </div>
                            <span class="menu-item-price included">Inclus</span>
                        </div>
                    </div>
                </div>

                <div class="menu-section">
                    <h3 class="menu-category-title">☀️ Déjeuner</h3>
                    <div class="menu-grid">
                        <div class="menu-item">
                            <div class="menu-item-info">
                                <span class="menu-item-name">Tajine Poulet Olives & Citron</span>
                                <span class="menu-item-desc">Poulet fermier, olives beldi, citron confit, épices maison</span>
                            </div>
                            <span class="menu-item-price">85 MAD</span>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-info">
                                <span class="menu-item-name">Tajine Agneau aux Pruneaux</span>
                                <span class="menu-item-desc">Agneau tendre, pruneaux, amandes grillées, sésame</span>
                            </div>
                            <span class="menu-item-price">95 MAD</span>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-info">
                                <span class="menu-item-name">Couscous Royal</span>
                                <span class="menu-item-desc">Semoule aux 7 légumes, viande mixte et merguez (vendredi uniquement)</span>
                            </div>
                            <span class="menu-item-price">90 MAD</span>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-info">
                                <span class="menu-item-name">Pastilla au Poulet</span>
                                <span class="menu-item-desc">Feuilleté traditionnel au poulet, amandes et cannelle</span>
                            </div>
                            <span class="menu-item-price">70 MAD</span>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-info">
                                <span class="menu-item-name">Tajine Légumes (Végan)</span>
                                <span class="menu-item-desc">Légumes frais de saison avec chermoula maison</span>
                            </div>
                            <span class="menu-item-price">55 MAD</span>
                        </div>
                    </div>
                </div>

                <div class="menu-section">
                    <h3 class="menu-category-title">🌙 Dîner</h3>
                    <div class="menu-grid">
                        <div class="menu-item">
                            <div class="menu-item-info">
                                <span class="menu-item-name">Harira & Chebakia</span>
                                <span class="menu-item-desc">Soupe marocaine traditionnelle avec dattes et miel</span>
                            </div>
                            <span class="menu-item-price">35 MAD</span>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-info">
                                <span class="menu-item-name">Brochettes Kefta Grillées</span>
                                <span class="menu-item-desc">Viande hachée épicée, pain khobz, salade marocaine</span>
                            </div>
                            <span class="menu-item-price">65 MAD</span>
                        </div>
                    </div>
                </div>

                <div class="menu-section">
                    <h3 class="menu-category-title">☕ Boissons</h3>
                    <div class="menu-grid">
                        <div class="menu-item">
                            <div class="menu-item-info">
                                <span class="menu-item-name">Thé à la Menthe Marocain</span>
                                <span class="menu-item-desc">Thé vert Gunpowder, menthe fraîche et sucre</span>
                            </div>
                            <span class="menu-item-price">15 MAD</span>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-info">
                                <span class="menu-item-name">Jus d'Orange Pressé</span>
                                <span class="menu-item-desc">Oranges de la région, fraîchement pressées</span>
                            </div>
                            <span class="menu-item-price">20 MAD</span>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-info">
                                <span class="menu-item-name">Café Marocain (Nous-nous)</span>
                                <span class="menu-item-desc">Moitié café, moitié lait chaud</span>
                            </div>
                            <span class="menu-item-price">12 MAD</span>
                        </div>
                    </div>
                </div>

            </div>

            <aside class="restaurant-sidebar">
                <div class="sidebar-info-box">
                    <h4>⏰ Horaires</h4>
                    <ul>
                        <li><strong>Petit-déjeuner</strong><br>7h00 — 10h00</li>
                        <li><strong>Déjeuner</strong><br>12h00 — 15h00</li>
                        <li><strong>Thé de l'après-midi</strong><br>16h00 — 18h00</li>
                        <li><strong>Dîner</strong><br>19h00 — 22h00</li>
                    </ul>
                </div>
                <div class="sidebar-info-box">
                    <h4>📋 Service de chambre</h4>
                    <p>Le service de chambre est disponible sur demande auprès de la réception.</p>
                </div>
                <div class="sidebar-info-box">
                    <h4>🌿 Régimes spéciaux</h4>
                    <p>Nous proposons des menus adaptés : halal, végétarien, végan et sans gluten. Informez-nous lors de votre réservation.</p>
                </div>
            </aside>

        </div>
    </div>
</section>

@endsection