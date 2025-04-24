<?php
use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\AuteurController;
use App\Http\Controllers\EditeurController;
use App\Http\Controllers\EmpruntsController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\OuvrageController;
use App\Http\Controllers\TypeAbonnementController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\UserController;

Route::get('/emprunt', [\App\Http\Controllers\EmpruntsController::class,'emprunts'])->name('emprunts');
Route::get('/create', [\App\Http\Controllers\EmpruntsController::class,'create']);
Route::post('/create/enregistrement',[\App\Http\Controllers\EmpruntsController::class,'enregistrement']);
Route::post('/suppr/{ouvrage}',[\App\Http\Controllers\EmpruntsController::class,'suppression']);
Route::get('/update/{ouvrage}',[\App\Http\Controllers\EmpruntsController::class,'update']);
Route::post('/update/enregistrement_emp',[\App\Http\Controllers\EmpruntsController::class,'update_enregistrement']);

Route::get('/editeurs', [EditeurController::class, 'index'])->name('editeurs.index');
Route::get('/editeurs/search', [EditeurController::class, 'search'])->name('editeurs.search');
Route::get('/editeurs/create', [EditeurController::class, 'create'])->name('editeurs.create');
Route::post('/editeurs', [EditeurController::class, 'store'])->name('editeurs.store');
Route::get('/editeurs/{id_editeur}', [EditeurController::class, 'show'])->name('editeurs.show');
Route::get('/editeurs/{id_editeur}/edit', [EditeurController::class, 'edit'])->name('editeurs.edit');
Route::put('/editeurs/{id_editeur}', [EditeurController::class, 'update'])->name('editeurs.update');
Route::delete('/editeurs/{id_editeur}', [EditeurController::class, 'destroy'])->name('editeurs.destroy');

Route::get('/ouvrages', [OuvrageController::class, 'index'])->name('ouvrages'); 
Route::get('/ouvrages/create', [OuvrageController::class, 'creer'])->name('ouvrages.create');  
Route::post('/ouvrages', [OuvrageController::class, 'creation'])->name('ouvrages.store'); 
Route::get('/ouvrages/{id_ouvrage}/edit', [OuvrageController::class, 'edit'])->name('ouvrages.edit'); 
Route::put('/ouvrages/{id_ouvrage}', [OuvrageController::class, 'update'])->name('ouvrages.update');  
Route::delete('/ouvrages/{id_ouvrage}', [OuvrageController::class, 'destroy'])->name('ouvrages.destroy');
Route::get('/ouvrages/search', [OuvrageController::class, 'search'])->name('ouvrages.search');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('reservations', ReservationController::class);


Route::resource('commentaires', CommentaireController::class);
Route::post('commentaires', [CommentaireController::class, 'store'])->name('commentaire.store');
Route::get('commentaires', [CommentaireController::class, 'index'])->name('commentaire.index');


Route::resource('auteurs', AuteurController::class);

Route::get('/users', [UserController::class, 'ListeUsers'])->name('users.list');

Route::get('/Inscription',[UserController::class,'Inscription'])->name('Inscription');
Route::post('/Inscription',[UserController::class,'CreateUser']);

Route::get('/Connexion',[UserController::class,'Connexion'])->name('Connexion');
Route::post('/Connexion', [UserController::class, 'login']);

Route::post('/logout',[UserController::class,'logout'])->name('logout');


Route::delete('/utilisateurs/supprimer/{id_utilisateur}', [UserController::class, 'supprimer'])->name('utilisateur.supprimer');


// Afficher le formulaire d'édition
Route::get('utilisateurs/{id_utilisateur}/edit', [UserController::class, 'edit'])->name('utilisateur.edit');

// Mettre à jour l'utilisateur
Route::put('utilisateurs/{id_utilisateur}', [UserController::class, 'update'])->name('utilisateur.update');



// Gestion des types abonnements (Get)
Route::get('/listeTypeAbonnement', [TypeAbonnementController::class,'listeTypeAbonnement'])->name('ListeTypeAbonnement');
Route::get('/AjtTypeAbonnement', [TypeAbonnementController::class,'AjtTypeAbonnement'])->name('AjtTypeAbonnement');
Route::get('/ModifTypeAbonnement/{id}', [TypeAbonnementController::class,'ModifTypeAbonnement']);
Route::get('/SupprTypeAbonnement/{id}', [TypeAbonnementController::class,'SupprTypeAbonnement']);

//Gestion des types abonnements (Post)
Route::post('/AjtTypeAbonnement/enreg', [TypeAbonnementController::class,'enregistreTypeAbonnement'])->name('enregistreTypeAbonnement');
Route::post('/ModifTypeAbonnement/modif', [TypeAbonnementController::class,'modifierTypeAbonnement'])->name('modifierTypeAbonnement');

//Gestion des abonnements (Get)
Route::get('/listeAbonnement', [AbonnementController::class, 'listeAbonnement'])->name('ListeAbonnement');
Route::get('SupprAbonnement/{id}', [AbonnementController::class, 'SupprAbonnement']);
Route::get('/AjtAbonnement', [AbonnementController::class, 'AjtAbonnement'])->name('AjtAbonnement');
Route::get('ModifAbonnement/{id}', [AbonnementController::class, 'ModifAbonnement']);

//Gestion des abonnements (Post)
Route::post('/enregistreAbonnement/enreg', [AbonnementController::class,'enregistreAbonnement'])->name('enregistreAbonnement');
Route::post('/ModifAbonnement/modif', [AbonnementController::class,'ModifAbonnementEnrg'])->name('ModifAbonnementEnrg');

// Fin Gestion Abonnement et Abonnement
