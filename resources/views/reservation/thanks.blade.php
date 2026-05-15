@extends('layouts.app')

@section('title', 'Merci — Kasbah Dades Mgoun')

@section('content')

<section class="section">
    <div class="container">
        <div class="thanks-page">
            <div class="thanks-icon">✅</div>
            <h1>Demande envoyée avec succès!</h1>
            <p class="thanks-text">
                Merci pour votre demande de réservation à la Kasbah Dades Mgoun.<br>
                Notre équipe vous contactera dans les <strong>24 heures</strong> pour confirmer votre séjour.
            </p>
            <div class="thanks-contact">
                <p>📞 <strong>+212 708 127 300</strong></p>
                <p>✉️ contact@kasbah-dades.ma</p>
            </div>
            <div class="thanks-actions">
                <a href="{{ route('home') }}" class="btn btn-primary">Retour à l'accueil</a>
                <a href="{{ route('rooms.index') }}" class="btn btn-outline">Voir d'autres chambres</a>
            </div>
        </div>
    </div>
</section>

@endsection