<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\MemoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routes pour afficher les formulaires de connexion et d'inscription.
Route::view('/', 'signin');
Route::view('/signin','signin')->name('view_signin');
Route::view('/signup', 'signup')->name('view_signup');

// Route pour traiter la tentative de connexion d'un utilisateur.
Route::post('/authenticate', [UserController::class, 'connect'])->name('user_authenticate');

// Route pour enregistrer un nouvel utilisateur.
Route::post('/adduser', [UserController::class, 'create'])->name('user_adduser');

// Route pour afficher tous les mémos publics.
Route::get('/memolistpublic',[MemoController::class,'showAll'])->name('view_memopublic');

// Route pour afficher le détail d'un mémo spécifique.
Route::get('/memolistdetaille/{memo}',[MemoController::class,'showDetaille'])->name('memo_detaille');

// Groupe de routes nécessitant une authentification.
Route::prefix('admin')->middleware('auth.myuser')->group(function () {
	Route::view('/account', 'account')->name('view_account'); // Route pour afficher le compte utilisateur.
	Route::view('/formpassword','formpassword')->name('view_formpassword'); // Route pour afficher le formulaire de changement de mot de passe.
	Route::post('/changepassword', [UserController::class, 'updatePassword'])->name('user_changepassword'); // Route pour changer le mot de passe de l'utilisateur.
	Route::get('/deleteuser', [UserController::class, 'delete'])->name('user_deleteuser'); // Route pour supprimer le compte utilisateur.
	Route::get('/signout', [UserController::class, 'disconnect'])->name('user_signout'); // Route pour déconnecter l'utilisateur.

	// Groupe de routes pour la gestion des mémos.
	Route::prefix('note')->group(function () {
		Route::view('/addmemo', 'formmemo')->name('view_formmemo'); // Route pour afficher le formulaire d'ajout de mémo.
		Route::post('/addmemo', [MemoController::class,'add'])->name('memo_add'); // Route pour ajouter un nouveau mémo.
		Route::get('/list',[MemoController::class,'show'])->name('memo_show'); // Route pour lister les mémos de l'utilisateur.

		Route::get('/deleteMemo/{memo}',[MemoController::class,'delete'])->name('memo_delete'); // Route pour supprimer un mémo.
		Route::get('/changeMemoStatus/{memo}', [MemoController::class, 'changeStatus'])->name('memo_change_status'); // Route pour changer le statut de visibilité d'un mémo.
		Route::get('/formmemoupdate/{memo}', [MemoController::class, 'formMemoUpdate'])->name('memo_formupdate'); // Route pour afficher le formulaire de mise à jour d'un mémo.
		Route::post('/memoUpdate/{memo}',[MemoController::class, 'MemoUpdate'])->name('memo_update'); // Route pour mettre à jour un mémo.
	});
});
