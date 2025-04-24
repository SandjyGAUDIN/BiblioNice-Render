<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Ouvrages;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Models\User;


class ReservationController extends Controller
{
    // Afficher la liste des réservations
    public function index()
    {
        $reservations = Reservation::with(['ouvrage', 'utilisateur'])->get();
        return view('reservations.index', compact('reservations'));
    }

    // Afficher un formulaire pour créer une nouvelle réservation
    public function create()
    {
        $ouvrages = Ouvrages::all();
        $utilisateurs = User::all();
        return view('reservations.create', compact('ouvrages', 'utilisateurs'));
    }

    // Enregistrer une nouvelle réservation
    public function store(Request $request)
    {
        $request->validate([
            'id_ouvrage' => 'required|exists:ouvrages,id_ouvrage',
            'id_utilisateur' => 'required|exists:utilisateurs,id_utilisateur',
            'date_reservation' => 'required|date',
        ]);

        Reservation::create($request->all());
        return redirect()->route('reservations.index')->with('success', 'Réservation créée avec succès.');
    }

    // Modifier une réservation existante
    public function edit($id)
    {
        $reservation = Reservation::where('id_reservation', $id)->firstOrFail();
        $ouvrages = Ouvrages::all();
        $utilisateurs = Utilisateur::all();
        return view('reservations.edit', compact('reservation', 'ouvrages', 'utilisateurs'));
    }

    // Mettre à jour une réservation
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_ouvrage' => 'required|exists:ouvrages,id_ouvrage',
            'id_utilisateur' => 'required|exists:utilisateurs,id_utilisateur',
            'date_reservation' => 'required|date',
        ]);

        $reservation = Reservation::where('id_reservation', $id)->firstOrFail();
        $reservation->update($request->all());
        return redirect()->route('reservations.index')->with('success', 'Réservation mise à jour avec succès.');
    }

    // Supprimer une réservation
    public function destroy($id)
    {
        $reservation = Reservation::where('id_reservation', $id)->firstOrFail();
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée avec succès.');
    }
}
