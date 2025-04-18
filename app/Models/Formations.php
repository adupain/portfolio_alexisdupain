<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|Formations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Formations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Formations query()
 * @method static \Illuminate\Database\Eloquent\Builder|Formations whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formations whereName($value)
 * @mixin \Eloquent
 */
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
