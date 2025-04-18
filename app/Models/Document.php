<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $path
 * @property string|null $type
 * @method static \Illuminate\Database\Eloquent\Builder|Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document query()
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereType($value)
 * @mixin \Eloquent
 */
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