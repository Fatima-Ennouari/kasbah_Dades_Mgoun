<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin — Kasbah Dades Mgoun</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<div class="admin-login-page">
    <div class="admin-login-box">
        <div class="login-logo">
            <span class="brand-icon-large">ⵥ</span>
            <h2>Kasbah Dades Mgoun</h2>
            <p>Espace Administrateur</p>
        </div>

        @if($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST" class="login-form">
            @csrf
            <div class="form-group">
                <label>Adresse email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       placeholder="admin@kasbah-dades.ma" required autofocus>
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
        </form>

        <a href="{{ route('home') }}" class="login-back">← Retour au site</a>
    </div>
</div>
</body>
</html>