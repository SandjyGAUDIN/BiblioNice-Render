@extends('layouts.app')

@section('title', 'Modifier un ouvrage')

@section('content')
    <h1>Modifier un ouvrage</h1>

    <div class="form-container">
        <form class="form" action="{{ route('ouvrages.update', $ouvrage->id_ouvrage) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="titre">Titre :</label>
                <input type="text" id="titre" name="titre" class="form-control" value="{{ old('titre', $ouvrage->titre) }}" required>
            </div>

            <div class="form-group">
                <label for="code_isbn">Code ISBN (facultatif) :</label>
                <input type="text" id="code_isbn" name="code_isbn" class="form-control" value="{{ old('code_isbn', $ouvrage->code_isbn) }}">
            </div>

            <div class="form-group">
                <label for="id_editeur">Éditeur :</label>
                <input type="text" id="id_editeur" name="id_editeur" class="form-control" value="{{ old('id_editeur', $ouvrage->id_editeur) }}" required>
            </div>

            <div class="form-group">
                <label for="type">Type :</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="livre" {{ old('type', $ouvrage->type) == 'livre' ? 'selected' : '' }}>Livre</option>
                    <option value="magazine" {{ old('type', $ouvrage->type) == 'magazine' ? 'selected' : '' }}>Magazine</option>
                    <option value="ebook" {{ old('type', $ouvrage->type) == 'ebook' ? 'selected' : '' }}>Ebook</option>
                </select>
            </div>

            <div class="form-group">
                <label for="genres">Genres :</label>
                <div class="genres">
                    @foreach ($genres as $genre)
                        <div class="form-check">
                            <input type="checkbox" id="genre-{{ $genre->id_genre }}" name="genres[]" value="{{ $genre->id_genre }}" 
                                {{ in_array($genre->id_genre, $ouvrage->genres->pluck('id_genre')->toArray()) ? 'checked' : '' }} class="form-check-input">
                            <label for="genre-{{ $genre->id_genre }}" class="form-check-label">{{ $genre->libelle }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour l'ouvrage</button>
        </form>

        <a href="{{ route('ouvrages') }}" class="btn btn-warning mt-3">Retour à la liste des ouvrages</a>
    </div>
@endsection
