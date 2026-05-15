<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kasbah Dades Mgoun — Kelâat M\'Gouna')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+3:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

    <!-- NAVBAR -->
    <header class="header">
        <nav class="navbar">
            <div class="nav-container">

                <a href="{{ route('home') }}" class="nav-brand">
                    <span class="brand-icon">ⵥ</span>
                    <div class="brand-text">
                        <span class="brand-name">Kasbah Dades Mgoun</span>
                        <span class="brand-tagline">Kelâat M'Gouna, Maroc</span>
                    </div>
                </a>

                <input type="checkbox" id="nav-toggle" class="nav-toggle-input">
                <label for="nav-toggle" class="nav-hamburger">
                    <span></span><span></span><span></span>
                </label>

                <ul class="nav-menu">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a></li>
                    <li><a href="{{ route('rooms.index') }}" class="{{ request()->routeIs('rooms.*') ? 'active' : '' }}">Chambres</a></li>
                    <li><a href="{{ route('restaurant') }}" class="{{ request()->routeIs('restaurant') ? 'active' : '' }}">Restaurant</a></li>
                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                    <li><a href="{{ route('reservation.create') }}" class="nav-cta">Réserver</a></li>
                </ul>

            </div>
        </nav>
    </header>

    @if(session('success'))
        <div class="flash flash-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash flash-error">{{ session('error') }}</div>
    @endif

    <!--  PAGE CONTENT  -->
    <main>
        @yield('content')
    </main>

    <!--  FOOTER -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col">
                <h3>Kasbah Dades Mgoun</h3>
                <p>Maison d'hôtes traditionnelle au cœur de la Vallée des Roses. Trois étages, 7 chambres uniques, une hospitalité berbère authentique.</p>
                <div class="footer-stars">★★</div>
                <small>2 étoiles — Kelâat M'Gouna, Maroc</small>
            </div>
            <div class="footer-col">
                <h4>Navigation</h4>
                <ul>
                    <li><a href="{{ route('rooms.index') }}">Nos Chambres</a></li>
                    <li><a href="{{ route('restaurant') }}">Restaurant</a></li>
                    <li><a href="{{ route('reservation.create') }}">Réservation</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Équipements</h4>
                <ul>
                    <li>🏊 Piscine eau salée</li>
                    <li>🌐 WiFi gratuit</li>
                    <li>🍽️ Restaurant halal</li>
                    <li>🅿️ Parking privé gratuit</li>
                    <li>🌿 Jardin & Terrasse</li>
                    <li>🛎️ Réception 24h/24</li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contact</h4>
                <p>📍 Kelâat M'Gouna, province de Tinghir, Maroc</p>
                <p>📞 +212 708 127 300</p>
                <p>✉️ contact@kasbah-dades.ma</p>
                <p>🕐 Réception ouverte 24h/24</p>
                <p style="margin-top: 10px; font-size: 0.8rem; color: rgba(255,255,255,0.5);">
                    À 83 km d'Ouarzazate · À 47 km de Kasbah Amridil
                </p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} Kasbah Dades Mgoun. Tous droits réservés.</p>
        </div>
    </footer>

</body>
</html>