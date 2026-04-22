@extends('layouts.admin')

@section('title', $room ? 'Modifier ' . $room->name : 'Ajouter une chambre')

@section('content')

<div class="admin-form-back">
    <a href="{{ route('admin.rooms') }}" class="btn btn-sm btn-outline">← Retour aux chambres</a>
</div>

<div class="admin-card admin-form-card">
    <div class="admin-card-header">
        <h3>{{ $room ? 'Modifier : ' . $room->name : 'Nouvelle chambre' }}</h3>
    </div>

    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $e) <div>• {{ $e }}</div> @endforeach
        </div>
    @endif

    <form action="{{ $room ? route('admin.rooms.update', $room->id) : route('admin.rooms.store') }}"
          method="POST"
          class="admin-form">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label>Nom de la chambre *</label>
                <input type="text" name="name"
                       value="{{ old('name', $room?->name) }}"
                       placeholder="Ex: Chambre Double Vue Rivière">
            </div>
            <div class="form-group">
                <label>Type *</label>
                <select name="type">
                    @foreach(['single' => 'Simple', 'double' => 'Double', 'family' => 'Familiale', 'suite' => 'Suite'] as $val => $label)
                        <option value="{{ $val }}" {{ old('type', $room?->type) == $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Prix par nuit (MAD) *</label>
                <input type="number" name="price" min="1"
                       value="{{ old('price', $room?->price) }}"
                       placeholder="350">
            </div>
            <div class="form-group">
                <label>Capacité (personnes) *</label>
                <input type="number" name="capacity" min="1" max="10"
                       value="{{ old('capacity', $room?->capacity ?? 2) }}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Vue depuis la chambre</label>
                <select name="view">
                    <option value="">— Aucune vue spéciale —</option>
                    @foreach(['river' => 'Rivière', 'garden' => 'Jardin', 'mountain' => 'Montagne', 'pool' => 'Piscine'] as $val => $label)
                        <option value="{{ $val }}" {{ old('view', $room?->view) == $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group form-checkboxes">
                <label>Équipements</label>
                <div class="checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="has_balcony" value="1"
                               {{ old('has_balcony', $room?->has_balcony) ? 'checked' : '' }}>
                        Balcon privé
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="has_ac" value="1"
                               {{ old('has_ac', $room?->has_ac ?? true) ? 'checked' : '' }}>
                        Climatisation
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="available" value="1"
                               {{ old('available', $room?->available ?? true) ? 'checked' : '' }}>
                        Disponible à la réservation
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Description *</label>
            <textarea name="description" rows="4"
                      placeholder="Décrivez la chambre en détail — vue, décoration, équipements...">{{ old('description', $room?->description) }}</textarea>
        </div>

        <div class="form-group">
            <label>URL de l'image</label>
            <input type="url" name="image"
                   value="{{ old('image', $room?->image) }}"
                   placeholder="https://images.unsplash.com/...">
            @if($room?->image)
                <div class="image-preview">
                    <img src="{{ $room->image }}" alt="Aperçu">
                    <small>Image actuelle</small>
                </div>
            @endif
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                {{ $room ? 'Sauvegarder les modifications' : 'Ajouter la chambre' }}
            </button>
            <a href="{{ route('admin.rooms') }}" class="btn btn-outline">Annuler</a>
        </div>
    </form>
</div>

@endsection