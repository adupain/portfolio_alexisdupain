<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formations extends Model
{
    protected $table = 'formations'; //si on veut changer le nom de la table
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true; //pour les cle primaires multiples

    protected $fillable = [
        'name',
        'description',
    ];
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

}
