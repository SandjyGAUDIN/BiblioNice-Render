<?php

namespace App\Http\Controllers;

use App\Models\Editeur;
use Illuminate\Http\Request;

class EditeurController extends Controller
{
    public function index()
    {
        $editeurs = Editeur::all();
        return view('editeurs.index', compact('editeurs'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $editeurs = Editeur::where('libelle', 'like', '%' . $search . '%')->get();
        $html = '';
        foreach ($editeurs as $editeur) {
            $html .= '<tr>';
            $html .= '<td>' . $editeur->id_editeur . '</td>';
            $html .= '<td>' . $editeur->libelle . '</td>';
            $html .= '<td>';
            $html .= '<a href="' . route('editeurs.edit', $editeur->id_editeur) . '" style="display: inline-block;">';
            $html .= '<img src="img/edit.png" alt="Edit" width="40" height="40">';
            $html .= '</a>';
            $html .= '<form action="' . route('editeurs.destroy', $editeur->id_editeur) . '" method="POST" style="display: inline-block;">';
            $html .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
            $html .= '<input type="hidden" name="_method" value="DELETE">';
            $html .= '<button type="submit" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet éditeur ?\')" style="border: none; background: none; padding: 0; cursor: pointer;">';
            $html .= '<img src="/img/delete.png" alt="Delete" width="40" height="40">';
            $html .= '</button>';
            $html .= '</form>';
            $html .= '</td>';
            $html .= '</tr>';
        }
        return $html;
    }

    public function create()
    {
        return view('editeurs.create');
    }

    public function store(Request $request)
    {
        $editeur = new Editeur();
        $editeur->id_editeur = $request->input('id_editeur');
        $editeur->libelle = $request->input('libelle');
        $editeur->save();
        return redirect()->route('editeurs.index');
    }

    public function edit($id_editeur)
    {
        $editeur = Editeur::find($id_editeur);
        return view('editeurs.edit', compact('editeur'));
    }

    public function update(Request $request, $id_editeur)
    {
        $editeur = Editeur::find($id_editeur);
        $editeur->id_editeur = $request->input('id_editeur');
        $editeur->libelle = $request->input('libelle');
        $editeur->save();
        return redirect()->route('editeurs.index');
    }

    public function destroy($id)
    {
        $editeur = Editeur::find($id);
        $editeur->delete();
        return redirect()->route('editeurs.index');
    }
}