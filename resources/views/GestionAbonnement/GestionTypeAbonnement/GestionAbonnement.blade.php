@extends('layouts.app')

@section('title', 'Gestion Abonnement')

@section('content')
    <h1>Gestion des abonnements</h1>
    <br/>

    @if (session('status')) <!--Pour afficher le message si l'action de modifier à bien été faite. -->
        <div class="alert-success">
            {{ session('status') }}
        </div>
    @endif

    <h2> Type d'abonnement </h2>
    <br/>

    <table class="table">
        <tr>
            <th> Id de l'abonnement </th>
            <th> Nom de l'abonnement </th>
            <th> Prix de l'abonnement </th>
            @if ((session()->has('user.role') && session('user.role') === 'gestionnaire'))
                <th> Action : Supprimer </th>
                <th> Action : Modifier </th>
            @endif
        </tr>
        @foreach ($typeAbonnement as $tabo)
            @php
                $ide = 1; //permet de trier en ordre croissant
            @endphp
            <tr>
                <td> {{$tabo['id_type_abonnement']}}</td>
                <td> {{$tabo['nom']}}</td>
                <td> {{$tabo['prix']}}€</td>
                @if ((session()->has('user.role') && session('user.role') === 'gestionnaire'))
                    <td> <a href="SupprTypeAbonnement/{{ $tabo->id_type_abonnement }}"> <button class="btn btn-danger"> Supprimer </button> </a> </td>
                    <td> <a href="ModifTypeAbonnement/{{ $tabo->id_type_abonnement }}"> <button class="btn btn-primary"> Modifier </button> </a> </td>
                @endif
            </tr>
            @php
                $ide += 1;
            @endphp
        @endforeach
    </table>
    <br/>

    @if ((session()->has('user.role') && session('user.role') === 'gestionnaire'))
        <a href="{{ route('AjtTypeAbonnement') }}">
            <button class="btn"> Ajouter un type d'abonnement  </button>
        </a>
        <a href="{{ route('ListeAbonnement') }}">
            <button class="btn"> Accéder à la liste des abonnements </button>
        </a>
    @endif
    <br/>
@endsection