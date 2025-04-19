<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
	class AProposDeMoi extends \Eloquent {}
}

namespace App\Models{
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
	class Competences extends \Eloquent {}
}

namespace App\Models{
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
	class Document extends \Eloquent {}
}

namespace App\Models{
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
	class Formations extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
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
	class Projets extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent {}
}

