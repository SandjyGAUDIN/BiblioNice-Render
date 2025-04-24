@extends('layouts.app')

@section('content')
    <h1> Ajout d'un type abonnement </h1>

    <form action="{{ route('enregistreTypeAbonnement') }}" method="POST">
        @csrf
        <label for="nameType"> Nom du type d'abonnement :</label>
        <input type="text" name="nameType" id="nameType" required/>
        <br/>
        <label for="prixType"> Prix de l'abonnement :</label>
        <input type="number" name="prixType" id="prixType" required/>
        <br/>
        <input type="submit" value="Ajouter" class="btn">
    </form>

@endsection
