<?php

namespace App\Http\Controllers;
use App\Models\TypeAbonnement;

use Illuminate\Http\Request;

class TypeAbonnementController extends Controller
{
    //fonction pour récupérer tout les types d'abonnements dans la base (grâce aussi au model) et faire appel à la vue et lui envoyer les données (grâce à compact)
    public function listeTypeAbonnement(){
        session(['user' => ['role' => '']]); //essayer avec différents rôle : laisser vide, utilisateur et gestionnaire.

        $typeAbonnement = TypeAbonnement::all();
        // $tAbonnement = TypeAbonnement::find(2); test de relation
        // $abonnements = $tAbonnement->abonnements;  // Liste des abonnements associés
        return view('GestionAbonnement.GestionTypeAbonnement.GestionAbonnement', compact('typeAbonnement'));
    }


    //fonction pour faire appel à la vue AjtTypeAbonnement
    public function AjtTypeAbonnement() {
        // session(['user' => ['role' => 'utilisateur']]);

        if (session()->has('user.role') && session('user.role') === 'utilisateur' or session('user.role') == null) {
            return redirect()->route('ListeTypeAbonnement')->with('status', 'Vous n\'avez pas les droits pour accéder à la page');
        }

        return view('GestionAbonnement.GestionTypeAbonnement.AjtTypeAbonnement');
    }


    //fonction pour récupérer les informations d'un type abonnement grâce à son ID et afficher ses informations dans la vue pour modifier
    public function ModifTypeAbonnement($id_type_abonnement) {

        if (session()->has('user.role') && session('user.role') === 'utilisateur' or session('user.role') == null) {
            return redirect()->route('ListeTypeAbonnement')->with('status', 'Vous n\'avez pas les droits pour accéder à la page');
        }

        $typeAbonnement = new TypeAbonnement;
        $typeAbonnement = TypeAbonnement::find($id_type_abonnement); // bien penser à mettre le = sinon ça n'affecte pas la valeur à typeAbonnement
        
        return view('GestionAbonnement.GestionTypeAbonnement.ModifTypeAbonnement', compact('typeAbonnement'));
    }

    //fonction supprimer type abonnement
    public function SupprTypeAbonnement($id_type_abonnement){

        $typeAbonnement = TypeAbonnement::find($id_type_abonnement);
        $typeAbonnement->delete($id_type_abonnement);

        return redirect()->route('ListeTypeAbonnement')->with('status', 'Le type d\'abonnement à bien été supprimer'); //Status dans la session pour informer que la suppression à bien été effectuer
    }


    //fonction pour enregistrer dans la BDD un nouveau type d'abonnement et rediriger à la liste des types abonnements
    public function enregistreTypeAbonnement(Request $request){

        $request->validate([
            'nameType' => 'required',
            'prixType' => 'required',
        ]); //une validation pour éviter de créer une case vide dans la BDD /!\

        $typeAbonnement = new TypeAbonnement;
        $typeAbonnement->nom = $request->nameType;
        $typeAbonnement->prix = $request->prixType;
        $typeAbonnement->save(); //mot clé save pour sauvegarder dans la base 
        return redirect()->route('ListeTypeAbonnement')->with('status', 'Le type d\'abonnement à bien été ajouter'); //Status dans la session pour informer que l'ajout à bien été effectuer
    }


    //fonction pour enregistrer la modification d'un type abonnement dans la base de donnée
    public function modifierTypeAbonnement(Request $request){

        $request->validate([
            'nameType' => 'required',
            'prixType' => 'required',
        ]); //une validation pour éviter de créer une case vide dans la BDD /!\

        $typeAbonnement = TypeAbonnement::find($request->id_type_abonnement);
        $typeAbonnement->nom = $request->nameType;
        $typeAbonnement->prix = $request->prixType;
        $typeAbonnement->update(); //mot clé update pour modifier dans la base 
        return redirect()->route('ListeTypeAbonnement')->with('status', 'Le type d\'abonnement à bien été modifier'); //Status dans la session pour informer que la modification à bien été effectuer
    }
}
