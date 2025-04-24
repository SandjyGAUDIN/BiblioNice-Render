@extends('layouts.app')

@section('content')
    <h1> Modification d'un type d'abonnement </h1>

    <form action="{{ route('modifierTypeAbonnement') }}" method="POST">
        @csrf
        <label for="id_type_abonnement"> ID du type abonnement :</label>
        <input type="number" name="id_type_abonnement" value="{{$typeAbonnement->id_type_abonnement}}" readonly/>
        <br/>
        <label for="nameType"> Nom du type d'abonnement :</label>
        <input type="text" name="nameType" id="nameType" value="{{$typeAbonnement->nom}}" required/>
        <br/>
        <label for="prixType"> Prix de l'abonnement :</label>
        <input type="number" name="prixType" id="prixType" value="{{$typeAbonnement->prix}}" required/>
        <br/>
        <input type="submit" value="Modifier" class="btn">
    </form>

@endsection