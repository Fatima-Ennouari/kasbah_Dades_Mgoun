<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', 'Kasbah Dades Mgoun')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Source+Sans+3:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="admin-body">

<div class="admin-layout">

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <span class="brand-icon">⌘</span>
            <div>
                <div class="sidebar-brand-name">Kasbah Admin</div>
                <div class="sidebar-brand-sub">Panneau de gestion</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-nav-section">Général</div>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span>📊</span> Tableau de bord
            </a>

            <div class="sidebar-nav-section">Gestion</div>
            <a href="{{ route('admin.rooms') }}" class="{{ request()->routeIs('admin.rooms*') ? 'active' : '' }}">
                <span>🛏️</span> Chambres
            </a>
            <a href="{{ route('admin.reservations') }}" class="{{ request()->routeIs('admin.reservations*') ? 'active' : '' }}">
                <span>📋</span> Réservations
            </a>
            <a href="{{ route('admin.clients') }}" class="{{ request()->routeIs('admin.clients') ? 'active' : '' }}">
                <span>👥</span> Clients
            </a>

            <div class="sidebar-nav-section">Compte</div>
            <a href="{{ route('home') }}" target="_blank"><span>🌐</span> Voir le site</a>
            <a href="{{ route('admin.logout') }}" class="sidebar-logout"><span>🚪</span> Déconnexion</a>
        </nav>
    </aside>

    <!-- Main content -->
    <div class="admin-main">
        <div class="admin-topbar">
            <h2>@yield('title', 'Tableau de bord')</h2>
            <span class="admin-user">👤 Administrateur</span>
        </div>

        <div class="admin-page-content">

            @if(session('success'))
                <div class="flash flash-success">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="flash flash-error">❌ {{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

</div>

</body>
</html>