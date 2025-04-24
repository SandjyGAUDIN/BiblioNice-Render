@extends('layouts.app') 

@section('title', 'Modifier un éditeur')

@section('content')
<h1>Modifier un éditeur</h1>

<form method="POST" action="{{ route('editeurs.update', $editeur->id_editeur) }}">
    @csrf
    @method('PUT')
    <label for="id_editeur">ID :</label>
    <input type="text" id="id_editeur" name="id_editeur" value="{{ $editeur->id_editeur }}"><br><br>
    <label for="libelle">Libelle :</label>
    <input type="text" id="libelle" name="libelle" value="{{ $editeur->libelle }}"><br><br>
    <input type="submit" value="Modifier">
</form>
@endsection