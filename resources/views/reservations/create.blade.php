@extends('layouts.app')

@section('content')
    <h1>Ajouter une nouvelle Réservation</h1>

    <form class="form" action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_utilisateur">Utilisateur</label>
            <select name="id_utilisateur" id="id_utilisateur" class="form-control">
                @foreach($utilisateurs as $utilisateur)
                    <option value="{{ $utilisateur->id_utilisateur }}">{{ $utilisateur->nom }} {{ $utilisateur->prenom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="id_ouvrage">Ouvrage</label>
            <select name="id_ouvrage" id="id_ouvrage" class="form-control">
                @foreach($ouvrages as $ouvrage)
                    <option value="{{ $ouvrage->id_ouvrage }}">{{ $ouvrage->titre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date_reservation">Date de Réservation</label>
            <input type="datetime-local" name="date_reservation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Créer la réservation</button>
    </form>
@endsection
