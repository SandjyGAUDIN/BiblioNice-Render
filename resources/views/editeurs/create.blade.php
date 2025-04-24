@extends('layouts.app') 

@section('title', 'Créer un nouvel éditeur')

@section('content')
<h1>Créer un nouvel éditeur</h1>

<form method="POST" action="{{ route('editeurs.store') }}">
    @csrf
    <label for="id_editeur">ID :</label>
    <input type="text" id="id_editeur" name="id_editeur"><br><br>
    <label for="libelle">Libelle :</label>
    <input type="text" id="libelle" name="libelle"><br><br>
    <input type="submit" value="Créer">
</form>
@endsection