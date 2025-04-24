<?php

namespace App\Http\Controllers;
use App\Models\Abonnement;

use Illuminate\Http\Request;

class AbonnementController extends Controller
{
    public function listeAbonnement(){

        if (session()->has('user.role') && session('user.role') === 'utilisateur' or session('user.role') == null) { //check session 
            return redirect()->route('ListeTypeAbonnement')->with('status', 'Vous n\'avez pas les droits pour accéder à la page');
        }

        $Abonnement = Abonnement::all();
        return view('GestionAbonnement.ListeAbonnement', compact('Abonnement'));
    }

    public function SupprAbonnement($id_abonnement){

        $Abonnement = Abonnement::find($id_abonnement);
        $Abonnement->delete($id_abonnement);

        return redirect()->route('ListeAbonnement')->with('status', 'L\'abonnement à bien été supprimer'); //Status dans la session pour informer que la suppression à bien été effectuer
    }

    public function AjtAbonnement() {

        if (session()->has('user.role') && session('user.role') === 'utilisateur' or session('user.role') == null) {
            return redirect()->route('ListeTypeAbonnement')->with('status', 'Vous n\'avez pas les droits pour accéder à la page');
        }

        return view('GestionAbonnement.AjtAbonnement');
    }

    public function enregistreAbonnement(Request $request){

        $request->validate([
            'id_utilisateur' => 'required',
            'id_type_abonnement' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
        ]); //une validation pour éviter de créer une case vide dans la BDD /!\

        $Abonnement = new Abonnement;
        $Abonnement->id_utilisateur = $request->id_utilisateur;
        $Abonnement->id_type_abonnement = $request->id_type_abonnement;
        $Abonnement->date_debut = $request->date_debut;
        $Abonnement->date_fin = $request->date_fin;
        $Abonnement->save(); //mot clé save pour sauvegarder dans la base 
        return redirect()->route('ListeAbonnement')->with('status', 'L\'abonnement à bien été ajouter'); //Status dans la session pour informer que l'ajout à bien été effectuer
    }

    public function ModifAbonnement($id_abonnement) {
        if (session()->has('user.role') && session('user.role') === 'utilisateur' or session('user.role') == null) {
            return redirect()->route('ListeTypeAbonnement')->with('status', 'Vous n\'avez pas les droits pour accéder à la page');
        }

        $Abonnement = new Abonnement;
        $Abonnement = Abonnement::find($id_abonnement); // bien penser à mettre le = sinon ça n'affecte pas la valeur à Abonnement
        
        return view('GestionAbonnement.ModifAbonnement', compact('Abonnement'));
    }

    public function ModifAbonnementEnrg(Request $request){
        //dd($request->all());

        $request->validate([
            'id_abonnement' => 'required',
            'id_utilisateur' => 'required',
            'id_type_abonnement' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
        ]); //une validation pour éviter de créer une case vide dans la BDD /!\

        $Abonnement = Abonnement::find($request->id_abonnement);
        $Abonnement->id_abonnement = $request->id_abonnement;
        $Abonnement->id_utilisateur = $request->id_utilisateur;
        $Abonnement->id_type_abonnement = $request->id_type_abonnement;
        $Abonnement->date_debut = $request->date_debut;
        $Abonnement->date_fin = $request->date_fin;
        $Abonnement->update(); //mot clé update pour modifier dans la base 
        return redirect()->route('ListeAbonnement')->with('status', 'L\'abonnement à bien été modifier'); //Status dans la session pour informer que la modification à bien été effectuer
    }
}
