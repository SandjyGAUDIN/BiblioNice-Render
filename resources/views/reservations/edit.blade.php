@extends('layouts.app')

@section('content')
    <h1>Modifier la Réservation</h1>

    <form class="form" action="{{ route('reservations.update', $reservation->id_reservation) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="id_utilisateur">Utilisateur</label>
            <select name="id_utilisateur" id="id_utilisateur" class="form-control">
                @foreach($utilisateurs as $utilisateur)
                    <option value="{{ $utilisateur->id_utilisateur }}" {{ $utilisateur->id_utilisateur == $reservation->id_utilisateur ? 'selected' : '' }}>
                        {{ $utilisateur->nom }} {{ $utilisateur->prenom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="id_ouvrage">Ouvrage</label>
            <select name="id_ouvrage" id="id_ouvrage" class="form-control">
                @foreach($ouvrages as $ouvrage)
                    <option value="{{ $ouvrage->id_ouvrage }}" {{ $ouvrage->id_ouvrage == $reservation->id_ouvrage ? 'selected' : '' }}>
                        {{ $ouvrage->titre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date_reservation">Date de Réservation</label>
            <input type="datetime-local" name="date_reservation" class="form-control" value="{{ $reservation->date_reservation }}">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour la réservation</button>
    </form>
@endsection
