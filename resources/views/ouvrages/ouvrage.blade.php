@extends('layouts.app')

@section('title', 'Les ouvrages')

@section('content')

<div class="container text-center">
    <h1>Liste des ouvrages</h1>

    <form class="form" action="{{ route('ouvrages.search') }}" method="GET" class="mb-4">
        <div class="form-group">
            <input type="text" name="titre" class="form-control" placeholder="Rechercher par titre" value="{{ request('titre') }}">
        </div>
        <div class="form-group">
            <input type="text" name="auteur" class="form-control" placeholder="Rechercher par auteur" value="{{ request('auteur') }}">
        </div>
        <div class="form-group">
            <input type="text" name="genre" class="form-control" placeholder="Rechercher par genre" value="{{ request('genre') }}">
        </div>
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>

    <a href="{{ route('ouvrages.create') }}" class="btn btn-warning">
        Ajouter un ouvrage
    </a>

    <table class="table table-bordered mt-4 mx-auto" style="max-width: 90%;">
        <thead>
            <tr>
                <th>Titre</th>
                <th>ISBN</th>
                <th>Genres</th>
                <th>Actions</th>
                <th>Avis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ouvrages as $ouvrage)
                <tr>
                    <td>{{ $ouvrage->titre }}</td>
                    <td>{{ $ouvrage->code_isbn }}</td>
                    <td>
                        @foreach ($ouvrage->genres as $genre)
                            {{ $genre->libelle }}@if (!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('ouvrages.edit', $ouvrage->id_ouvrage) }}" class="btn btn-primary">Modifier</a>
                        <form class="form" action="{{ route('ouvrages.destroy', $ouvrage->id_ouvrage) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                    <td>
                    
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
