<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;

class MemoController extends Controller
{
	/**************************************************************************
	 * Ajoute un nouveau mémo à la base de données. Vérifie d'abord si les
	 * champs 'title' et 'content' sont remplis. Si oui, crée le mémo avec les
	 * informations fournies et le sauvegarde. Redirige ensuite l'utilisateur
	 * vers la vue de son compte avec un message de succès.
	 */
    public function add( Request $request ) {
		if ( !$request->filled(['title','content']) )
			return to_route('view_formmemo')->with('message',"Some POST data are missing.");

		$memo = new Memo;
		$memo->title = $request->title;
		$memo->content = $request->input("content");
		$memo->owner = $request->user->login;
		$memo->save();

		return to_route('view_account')->with('message',"New memo added.");
	}

	/**************************************************************************
	 * Affiche la liste des mémos de l'utilisateur connecté. Récupère tous les
	 * mémos associés à l'utilisateur et retourne la vue correspondante avec
	 * ces mémos pour affichage.
	 */
	public function show( Request $request ) {
		$memos = $request->user->memos;
		return view('memolist',['memos'=>$memos]);
	}

	/**************************************************************************
	 * Affiche les détails d'un mémo spécifique.
	 */
	public function showDetaille( Request $request, Memo $memo) {
		return view('memolistdetaille', ['memo' => $memo]);
	}

	/**************************************************************************
	 * Affiche tous les mémos publics, triés par date de création décroissante.
	 */
	public function showAll(Request $request) {
		$memos = Memo::where('is_public',true)
		->orderByRaw('created_at DESC')
		->get();
		return view('memolistpublic',['memos'=>$memos]);
	}

	/**************************************************************************
	 * Supprime un mémo spécifique. Tente de supprimer le mémo et renvoie un
	 * message de succès ou d'échec en fonction du résultat de l'opération.
	 */
	public function delete(Request $request, Memo $memo)
    {
        try
        {
            Memo::where('id',$memo->id)->firstOrFail()->delete();
        }
        catch(\Exception $e)
        {
            return to_route('memo_show')
            ->with('message','ECHEC DE SUPPRESSION DU MEMO : '.$memo->title);
        }

        return to_route('memo_show')
        ->with('message','Le  mémo '.$memo->title.' a été supprimé avec succès');
    }

	/**************************************************************************
	 * Change le statut de visibilité d'un mémo (public/privé). Inverse le
	 * statut actuel du mémo, tente de sauvegarder le changement en base de
	 * données, et retourne un message de succès ou d'échec.
	 */
	public function changeStatus(Request $request, Memo $memo)
    {

        $memo->is_public = !$memo->is_public;

        try {
			$memo->save();
		} catch (\Exception $e) {
			return to_route('memo_show')
				   ->with('message', 'ECHEC DE CHANGEMENT DU STATUT DU MEMO : ' . $memo->title);
		}

        return to_route('memo_show')
        ->with('message','Le status du mémo '.$memo->title.' a été changer');
    }

	/**************************************************************************
	 * Affiche le formulaire de mise à jour pour un mémo spécifique. Retourne
	 * la vue avec le formulaire pré-rempli avec les informations du mémo à
	 * modifier.
	 */
	public function formMemoUpdate(Request $request, Memo $memo) {
		return view('/formmemoupdate',['memo' => $memo]);
	}

	/**************************************************************************
	 * Met à jour un mémo spécifique avec de nouvelles informations. Vérifie si
	 * les champs 'title' et 'content' sont remplis avant de procéder à la mise
	 * à jour. Retourne ensuite un message de succès.
	 */
	public function MemoUpdate(Request $request, Memo $memo)
    {
		if ( !$request->filled(['title','content']) )
			return to_route('memo_update')->with('message',"Some POST data are missing.");

		$memo->title = $request->title;
		$memo->content = $request->input("content");

		$memo->save();

        return to_route('memo_show')
        ->with('message','Le mémo '.$memo->title.' a été modifier !');
    }
}
