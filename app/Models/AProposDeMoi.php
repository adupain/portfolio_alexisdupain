<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $description
 * @property int|null $document_id
 * @method static \Illuminate\Database\Eloquent\Builder|AProposDeMoi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AProposDeMoi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AProposDeMoi query()
 * @method static \Illuminate\Database\Eloquent\Builder|AProposDeMoi whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AProposDeMoi whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AProposDeMoi whereId($value)
 * @mixin \Eloquent
 */
class AProposDeMoi extends Model
{
    protected $table = 'a_propos_de_moi'; //si on veut changer le nom de la table
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true; //pour les cle primaires multiples
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

}
