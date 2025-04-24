@extends('layouts.app')

@section('title', 'Gestion Abonnement')

@section('content')
    <h1>Gestion des abonnements</h1>
    <br/>

    @if (session('status')) <!--Pour afficher le message si les actions ont été bien faite. -->
        <div class="alert-success">
            {{ session('status') }}
        </div>
    @endif

    <h2> Les abonnements </h2>
    <br/>

    <table class="table">
        <tr>
            <th> Identifiant Abonnement </th>
            <th> Identifiant utilisateur </th>
            <th> identifiant du type d'abonnement </th>
            <th> date de début abonnement </th>
            <th> date de fin abonnement </th>
            <th> Action : Supprimer </th>
            <th> Action : Modifier </th>
        </tr>
        @foreach ($Abonnement as $abo)
            @php
                $ide = 1; //permet de trier en ordre croissant
            @endphp
            <tr>
                <td> {{$abo['id_abonnement']}}</td>
                <td> {{$abo['id_utilisateur']}}</td>
                <td> {{$abo['id_type_abonnement']}}</td>
                <td> {{$abo['date_debut']}}</td>
                <td> {{$abo['date_fin']}}</td>
                <td> <a href="SupprAbonnement/{{ $abo->id_abonnement }}"> <button class="btn btn-danger"> Supprimer </button> </a> </td>
                <td> <a href="ModifAbonnement/{{ $abo->id_abonnement }}"> <button class="btn btn-primary"> Modifier </button> </a> </td>
            </tr>
            @php
                $ide += 1;
            @endphp
        @endforeach
    </table>
    <br/>
    <a href="{{ route('AjtAbonnement') }}">
        <button class="btn"> Ajouter un abonnement </button>
    </a>
    <a href="{{ route('ListeTypeAbonnement') }}">
        <button class="btn"> Accéder à la liste des types d'abonnement </button>
    </a>
@endsection
