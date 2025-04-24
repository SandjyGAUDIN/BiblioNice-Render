@extends('layouts.app')

@section('content')
    <h1>Gestion des Réservations</h1>

    <a href="{{ route('reservations.create') }}" class="btn btn-primary">Ajouter une réservation</a>

    <table class="table mt-4">
        <thead>
            <tr>
                {{-- <th>Utilisateur</th> --}}
                <th>Ouvrage</th>
                <th>Date de Réservation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    {{-- <td>{{ $reservation->utilisateur->nom }} {{ $reservation->utilisateur->prenom }}</td> --}}
                    <td>{{ $reservation->ouvrage ? $reservation->ouvrage->titre : 'Aucun ouvrage' }}</td>
                    <td>{{ $reservation->date_reservation }}</td>
                    <td>
                        <a href="{{ route('reservations.edit', $reservation->id_reservation) }}" class="btn btn-warning">Modifier</a>
                        <form class="form" action="{{ route('reservations.destroy', $reservation->id_reservation) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
