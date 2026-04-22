@extends('layouts.app')

@section('title', 'Réservation — Kasbah Dades Mgoun')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Réserver votre séjour</h1>
        <p>Remplissez le formulaire — confirmation par téléphone ou email sous 24h</p>
    </div>
</div>

<section class="section">
    <div class="container">

        @if($errors->any())
        <div class="alert alert-error">
            <strong>Veuillez corriger les erreurs suivantes :</strong>
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="reservation-layout">

            {{-- FORM --}}
            <div class="reservation-form-wrapper">
                <form action="{{ route('reservation.store') }}" method="POST" class="reservation-form">
                    @csrf

                    <div class="form-section">
                        <h3 class="form-section-title">👤 Vos informations</h3>

                        <div class="form-group">
                            <label for="client_name">Nom complet <span class="required">*</span></label>
                            <input type="text" id="client_name" name="client_name"
                                   value="{{ old('client_name') }}"
                                   placeholder="Ex: Hassan Benali"
                                   class="{{ $errors->has('client_name') ? 'input-error' : '' }}">
                            @error('client_name')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="client_email">Email</label>
                                <input type="email" id="client_email" name="client_email"
                                       value="{{ old('client_email') }}"
                                       placeholder="votre@email.com">
                                @error('client_email')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="client_phone">Téléphone</label>
                                <input type="text" id="client_phone" name="client_phone"
                                       value="{{ old('client_phone') }}"
                                       placeholder="+212 6XX XXX XXX">
                                @error('client_phone')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="form-section-title">🛏️ Votre séjour</h3>

                        <div class="form-group">
                            <label for="room_id">Chambre souhaitée <span class="required">*</span></label>
                            <select id="room_id" name="room_id"
                                    class="{{ $errors->has('room_id') ? 'input-error' : '' }}">
                                <option value="">— Choisir une chambre —</option>
                                @foreach($rooms->groupBy('type') as $type => $typeRooms)
                                    @php
                                        $labels = [
                                            'single' => 'Chambre Simple',
                                            'double' => 'Chambre Double',
                                            'family' => 'Chambre Familiale',
                                            'suite'  => 'Suite',
                                        ];
                                    @endphp
                                    <optgroup label="{{ $labels[$type] ?? $type }}">
                                        @foreach($typeRooms as $room)
                                        <option value="{{ $room->id }}"
                                            {{ (old('room_id', $selectedRoomId) == $room->id) ? 'selected' : '' }}>
                                            {{ $room->name }} — {{ number_format($room->price, 0) }} MAD/nuit ({{ $room->capacity }} pers.)
                                        </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @error('room_id')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="check_in">Date d'arrivée <span class="required">*</span></label>
                                <input type="date" id="check_in" name="check_in"
                                       value="{{ old('check_in') }}"
                                       min="{{ date('Y-m-d') }}"
                                       class="{{ $errors->has('check_in') ? 'input-error' : '' }}">
                                @error('check_in')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="check_out">Date de départ <span class="required">*</span></label>
                                <input type="date" id="check_out" name="check_out"
                                       value="{{ old('check_out') }}"
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                       class="{{ $errors->has('check_out') ? 'input-error' : '' }}">
                                @error('check_out')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="num_people">Nombre de personnes <span class="required">*</span></label>
                            <select id="num_people" name="num_people">
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ old('num_people') == $i ? 'selected' : '' }}>
                                        {{ $i }} personne{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                            </select>
                            @error('num_people')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="notes">Demandes spéciales (optionnel)</label>
                            <textarea id="notes" name="notes" rows="3"
                                      placeholder="Ex: arrivée tardive, chambre au calme, régime alimentaire particulier...">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        Envoyer ma demande de réservation
                    </button>
                    <p class="form-note">
                        * Champs obligatoires · Nous vous confirmerons par téléphone ou email sous 24h · Paiement à l'arrivée uniquement
                    </p>
                </form>
            </div>

            {{-- SIDEBAR --}}
            <aside class="reservation-sidebar">
                <div class="sidebar-info-box">
                    <h4>📌 Comment ça marche?</h4>
                    <ol class="sidebar-steps">
                        <li>Remplissez le formulaire ci-contre</li>
                        <li>Nous vérifions la disponibilité</li>
                        <li>Vous recevez une confirmation (24h)</li>
                        <li>Vous payez à votre arrivée</li>
                    </ol>
                </div>

                <div class="sidebar-info-box">
                    <h4>💰 Tarifs & Politique</h4>
                    <ul class="sidebar-policies">
                        <li>✅ Petit-déjeuner inclus</li>
                        <li>✅ Paiement en espèces à l'arrivée</li>
                        <li>✅ Pas d'avance requise</li>
                        <li>✅ Annulation gratuite (48h avant)</li>
                        <li>✅ Animaux acceptés (gratuit)</li>
                    </ul>
                </div>

                <div class="sidebar-info-box sidebar-info-dark">
                    <h4>📞 Réservation directe</h4>
                    <p>Préférez-vous appeler?</p>
                    <a href="tel:+2125XXXXXXX" class="btn btn-outline-light btn-block">
                        +212 5XX XXX XXX
                    </a>
                    <small>Ouvert 24h/24 — 7j/7</small>
                </div>

                <div class="sidebar-info-box">
                    <h4>📍 Localisation</h4>
                    <p>Kelâat M'Gouna, Province de Tinghir</p>
                    <ul>
                        <li>🛬 83 km d'Ouarzazate Airport</li>
                        <li>🏛️ 47 km Kasbah Amridil</li>
                        <li>🌹 Vallée des Roses</li>
                    </ul>
                </div>
            </aside>

        </div>
    </div>
</section>

@endsection