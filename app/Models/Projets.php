<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $document_id
 * @property string|null $competence_id
 * @method static \Illuminate\Database\Eloquent\Builder|Projets newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Projets newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Projets query()
 * @method static \Illuminate\Database\Eloquent\Builder|Projets whereCompetenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Projets whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Projets whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Projets whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Projets whereName($value)
 * @mixin \Eloquent
 */
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
