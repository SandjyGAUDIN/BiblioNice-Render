@extends('layouts.app')

@section('content')
    <h1> Modification d'un abonnement </h1>

    <form action="{{ route('ModifAbonnementEnrg') }}" method="POST">
        @csrf
        <label for="id_abonnement"> ID du type abonnement :</label>
        <input type="number" name="id_abonnement" value="{{$Abonnement->id_type_abonnement}}" readonly/>
        <br/>
        <label for="id_utilisateur"> ID de l'utilisateur :</label>
        <input type="text" name="id_utilisateur" value="{{$Abonnement->id_utilisateur}}" required/>
        <br/>
        <label for="id_type_abonnement"> ID de l'abonnement :</label>
        <input type="number" name="id_type_abonnement" value="{{$Abonnement->id_type_abonnement}}" required/>
        <br/>
        <label for="date_debut"> Date de début de l'abonnement:</label>
        <input type="date" name="date_debut" value="{{$Abonnement->date_debut}}" required/>
        <br/>
        <label for="date_fin"> Date de fin de l'abonnement:</label>
        <input type="date" name="date_fin" value="{{$Abonnement->date_fin}}" required/>
        <br/>
        <input type="submit" value="Modifier" class="btn">
    </form>

@endsection
