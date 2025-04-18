<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $titre
 * @property int|null $number
 * @property string|null $description_competence
 * @property string|null $projet_id
 * @method static \Illuminate\Database\Eloquent\Builder|Competences newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Competences newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Competences query()
 * @method static \Illuminate\Database\Eloquent\Builder|Competences whereDescriptionCompetence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competences whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competences whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competences whereProjetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competences whereTitre($value)
 * @mixin \Eloquent
 */
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
