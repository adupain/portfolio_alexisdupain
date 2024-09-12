<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
