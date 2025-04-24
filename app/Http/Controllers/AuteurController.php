<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auteur;

class AuteurController extends Controller
{
    // Afficher tous les auteurs
    public function index()
    {
        $auteurs = Auteur::all()->sortBy('nom')->sortBy('prenom');
        return view('auteurs.index', compact('auteurs'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('auteurs.create');
    }

    // Créer un auteur
    public function store(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
        ]);

        Auteur::create($request->all());

        return redirect()->route('auteurs.index');
    }

    // Afficher le formulaire de modification
    public function edit(Auteur $auteur)
    {
        return view('auteurs.edit', compact('auteur'));
    }

    // Modifier un auteur
    public function update(Request $request, Auteur $auteur)
    {
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
        ]);

        $auteur->update($request->all());

        return redirect()->route('auteurs.index');
    }

    // Supprimer un auteur
    public function destroy(Auteur $auteur)
    {
        $auteur->delete();
        return redirect()->route('auteurs.index');
    }
}