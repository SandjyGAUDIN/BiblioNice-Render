@extends('layouts.app')

@section('content')
    <h1>Liste des Auteurs</h1>

    @if(session('user.role') == 'gestionnaire')
    <a href="{{ route('auteurs.create') }}" class="btn btn-primary">Créer un auteur</a>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                @if(session('user.role') == 'gestionnaire')
                <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($auteurs as $auteur)
                <tr>
                    <td>{{ $auteur->prenom }}</td>
                    <td>{{ $auteur->nom }}</td>
                    @if (session('user.role') == 'gestionnaire')
                    <td>
                        <a href="{{ route('auteurs.edit', $auteur->id_auteur) }}" class="btn btn-warning btn-sm">Modifier</a>

                        <form action="{{ route('auteurs.destroy', $auteur->id_auteur) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet auteur ?')">Supprimer</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
