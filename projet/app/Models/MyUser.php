<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MyUser extends Model {
	public $timestamps = false; // Désactive les timestamps (created_at, updated_at) pour ce modèle.

	protected $table = 'myusers'; // Spécifie le nom de la table utilisée par ce modèle.
	protected $primaryKey = 'login'; // Indique la clé primaire de la table.
	protected $keyType = 'string'; // Définit le type de la clé primaire.

	/**************************************************************************
	 * Cela permet d'accéder aux mémos appartenant à cet utilisateur.
	 */
	public function memos(): HasMany
	{
		return $this->hasMany(Memo::class,'owner');
	}
}
