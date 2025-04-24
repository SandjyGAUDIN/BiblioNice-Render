@extends('layouts.app')

@section('content')
    <h1> Ajout d'un abonnement </h1>

    <form action=" {{ route('enregistreAbonnement') }}" method="POST">
        @csrf
        <label for="id_utilisateur"> Identifiant de l'utilisateur :</label>
        <input type="number" name="id_utilisateur" required/>
        <br/>
        <label for="id_type_abonnement"> Identifiant du type d'abonnement :</label>
        <input type="number" name="id_type_abonnement" required/>
        <br/>
        <label for="date_debut"> Date de debut de l'abonnement :</label>
        <input type="date" name="date_debut" required/>
        <br/>
        <label for="date_fin"> Date de fin de l'abonnement :</label>
        <input type="date" name="date_fin" required/>
        <br/>
        <input type="submit" value="Ajouter" class="btn">
    </form>

@endsection
