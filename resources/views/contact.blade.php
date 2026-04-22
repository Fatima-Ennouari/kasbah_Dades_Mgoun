@extends('layouts.app')

@section('title', 'Contact — Kasbah Dades Mgoun')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Nous Contacter</h1>
        <p>Notre équipe vous répond dans les 24 heures</p>
    </div>
</div>

<section class="section">
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="contact-layout">

            <div class="contact-info">
                <h2>Informations pratiques</h2>

                <div class="contact-card">
                    <span class="contact-icon">📍</span>
                    <div>
                        <strong>Adresse</strong>
                        <p>Kelâat M'Gouna (Ait Ali Ouhsain Ait Yahya),<br>Province de Tinghir, Maroc</p>
                    </div>
                </div>
                <div class="contact-card">
                    <span class="contact-icon">📞</span>
                    <div>
                        <strong>Téléphone</strong>
                        <p>+212 5XX XXX XXX<br><small>Réception 24h/24 — 7j/7</small></p>
                    </div>
                </div>
                <div class="contact-card">
                    <span class="contact-icon">✉️</span>
                    <div>
                        <strong>Email</strong>
                        <p>contact@kasbah-dades.ma</p>
                    </div>
                </div>
                <div class="contact-card">
                    <span class="contact-icon">🛬</span>
                    <div>
                        <strong>Accès</strong>
                        <p>83 km d'Ouarzazate Airport<br>47 km de la Kasbah Amridil</p>
                    </div>
                </div>

                <div class="contact-note">
                    <h4>🅿️ Parking</h4>
                    <p>Parking privé gratuit sur place. Pas besoin de réserver.</p>
                    <h4 style="margin-top:15px;">🐾 Animaux</h4>
                    <p>Les animaux de compagnie sont acceptés sans frais supplémentaires.</p>
                </div>
            </div>

            <div class="contact-form-wrapper">
                <h2>Envoyer un message</h2>
                <form action="{{ route('contact.send') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="form-group">
                        <label>Nom complet *</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Votre nom">
                        @error('name') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="votre@email.com">
                        @error('email') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Sujet</label>
                        <select name="subject">
                            <option>Question sur les chambres</option>
                            <option>Réservation</option>
                            <option>Informations générales</option>
                            <option>Autre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Message *</label>
                        <textarea name="message" rows="5" placeholder="Votre message...">{{ old('message') }}</textarea>
                        @error('message') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Envoyer le message</button>
                </form>
            </div>

        </div>
    </div>
</section>

@endsection