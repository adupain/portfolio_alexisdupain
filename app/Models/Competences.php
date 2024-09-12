<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competences extends Model
{
    protected $table = 'competences'; //si on veut changer le nom de la table
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true; //pour les cle primaires multiples

    protected $fillable = [
        'titre',
        'description_competences',
        'number'
    ];
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

}
