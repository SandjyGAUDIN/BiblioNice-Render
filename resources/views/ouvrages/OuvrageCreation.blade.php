@extends('layouts.app')

@section('title', 'Créer un ouvrage')

@section('content')
    <h1>Créer un ouvrage</h1>

    <div class="form-container">
        <form class="form" action="{{ route('ouvrages.store') }}" method="POST">
            @csrf

            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" required>

            <label for="code_isbn">Code ISBN (facultatif) :</label>
            <input type="text" id="code_isbn" name="code_isbn">

            <label for="id_editeur">Éditeur :</label>
            <input type="text" id="id_editeur" name="id_editeur" required>

            <label for="type">Type :</label>
            <select id="type" name="type" required>
                <option value="livre">Livre</option>
                <option value="magazine">Magazine</option>
                <option value="ebook">Ebook</option>
            </select>

            <label for="genres">Genres :</label>
            <div class="genres">
                @foreach ($genres as $genre)
                    <label>
                        <input type="checkbox" name="genres[]" value="{{ $genre->id_genre }}">
                        {{ $genre->libelle }}
                    </label>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Créer l'ouvrage</button>
        </form>

        <a href="{{ route('ouvrages') }}" class="btn btn-warning back-link">Retour à la liste des ouvrages</a>
    </div>
@endsection
