<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projets extends Model
{
    protected $table = 'projets'; //si on veut changer le nom de la table
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true; //pour les cle primaires multiples

    protected $fillable = [
        'name',
        'description',
        'document_id'
    ];
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

}
