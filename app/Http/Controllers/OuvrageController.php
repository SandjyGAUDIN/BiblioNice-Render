<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Ouvrages;

class OuvrageController extends Controller
{



    public function index()
    {
        $ouvrages = Ouvrages::all()->sortBy('titre');
        return view('ouvrages.ouvrage', compact('ouvrages'));
    }

    public function search(Request $request)
    {
        $query = Ouvrages::query();

        if ($request->has('titre') && !empty($request->input('titre'))) {
            $query->where('titre', 'LIKE', '%' . $request->input('titre') . '%');
        }

        if ($request->has('auteur') && !empty($request->input('auteur'))) {
            $query->whereHas('auteurs', function ($q) use ($request) {
                $q->where('nom', 'LIKE', '%' . $request->input('auteur') . '%');
            });
        }

        if ($request->has('genre') && !empty($request->input('genre'))) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->where('libelle', 'LIKE', '%' . $request->input('genre') . '%');
            });
        }

        $ouvrages = $query->get();

        return view('ouvrages.ouvrage', compact('ouvrages'));
    }

    public function creer()
    {
        $genres = Genre::all();
        return view('ouvrages.OuvrageCreation', compact('genres'));
    }

    public function creation(Request $request)
    {

        $request->validate([
            'id_editeur' => 'required|integer|exists:editeurs,id_editeur',
            'code_isbn' => 'nullable|integer|unique:ouvrages,code_isbn',
            'titre' => 'required|string|max:255',
            'type' => 'required|in:livre,magazine,ebook',
            'genres' => 'nullable|array',
        ]);

        $ouvrage = Ouvrages::create([
            'id_editeur' => $request->input('id_editeur'),
            'code_isbn' => $request->input('code_isbn'),
            'titre' => $request->input('titre'),
            'type' => $request->input('type')
        ]);

        if ($request->has('genres')) {
            $ouvrage->genres()->sync($request->input('genres'));
        }

        return redirect()->route('ouvrages')->with('success', 'Ouvrage ajouté avec succès.');
    }




    public function edit($id_ouvrage)
    {
        $ouvrage = Ouvrages::with('genres')->findOrFail($id_ouvrage); 
        $genres = Genre::all(); 
        return view('ouvrages.OuvrageModifier', compact('ouvrage', 'genres'));
    }

    public function update($id_ouvrage, Request $request)
{
    $request->validate([
        'id_editeur' => 'required|integer|exists:editeurs,id_editeur',
        'code_isbn' => 'nullable|integer|unique:ouvrages,code_isbn,' . $id_ouvrage . ',id_ouvrage',
        'titre' => 'required|string|max:255',
        'type' => 'required|in:livre,magazine,ebook',
        'genres' => 'nullable|array',
        'genres.*' => 'exists:genres,id_genre'
    ]);

    $ouvrage = Ouvrages::findOrFail($id_ouvrage);
    $ouvrage->update([
        'id_editeur' => $request->input('id_editeur'),
        'code_isbn' => $request->input('code_isbn'),
        'titre' => $request->input('titre'),
        'type' => $request->input('type')
    ]);

    if ($request->has('genres')) {
        $ouvrage->genres()->sync($request->input('genres'));
    }
    return redirect()->route('ouvrages')->with('success', 'Ouvrage mis à jour avec succès.');
}


    public function destroy($id_ouvrage)
    {
        $ouvrage = Ouvrages::findOrFail($id_ouvrage);
        $ouvrage->delete();
        return redirect()->route('ouvrages');
    }
}