@extends('layouts.app') 

@section('title', 'Liste des éditeurs')

@section('content')
<style>
.table {
    border-collapse: collapse;
    width: 100%;
}

.table th, .table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

.table th {
    background-color: #007bff;
}

.table td {
    background-color: #fff;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9;
}

.table-striped tbody tr:nth-of-type(even) {
    background-color: #fff;
}

.table-bordered {
    border: 1px solid #ddd;
}

.table-bordered th, .table-bordered td {
    border: 1px solid #ddd;
}

.table-hover tbody tr:hover {
    background-color: #f5f5f5;
}

.btn-sm {
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
}

#search {
    margin: 0;
}

#add {
    margin: 5px 0px 0px 0px;
}
</style>
<h1 style="display: flex; align-items: center; justify-content: center;">Liste des éditeurs</h1>

<div style="display: flex; align-items: center; justify-content: center;">
    <input type="text" id="search" placeholder="Rechercher un éditeur">
    @if (session('user.role') == 'gestionnaire')
    <a id="add" href="{{ route('editeurs.create') }}"><img src="/img/add.png" alt="Créer un éditeur" width="40" height="40"></a>
    @endif
</div>
<div style="display: flex; align-items: center; justify-content: center;">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Libelle</th>
                @if (session('user.role') == 'gestionnaire')
                <th>Gérer</th>
                @endif
            </tr>
        </thead>
        <tbody id="editeurs-table">
            @foreach($editeurs as $editeur)
                <tr>
                    <td>{{ $editeur->id_editeur }}</td>
                    <td>{{ $editeur->libelle }}</td>
                    @if (session('user.role') == 'gestionnaire')
                    <td>
                        <a href="{{ route('editeurs.edit', $editeur->id_editeur) }}">
                            <img src="/img/edit.png" alt="Edit" width="40" height="40"></a>
                        <form action="{{ route('editeurs.destroy', $editeur->id_editeur) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet éditeur ?')" style="border: none; background: none; padding: 0; cursor: pointer;">
                                <img src="/img/delete.png" alt="Delete" width="40" height="40">
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var search = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{{ route("editeurs.search") }}',
                data: {search: search},
                success: function(data) {
                    $('#editeurs-table').html(data);
                }
            });
        });
    });
</script>
@endsection