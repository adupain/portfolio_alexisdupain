<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents'; //si on veut changer le nom de la table
    public $timestamps = false;
    public $incrementing = true; //pour les cle primaires multiples


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

}