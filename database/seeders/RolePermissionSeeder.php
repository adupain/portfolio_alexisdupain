<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les permissions
        $permissions = [
            'voir_articles',
            'voir_formations',
            'voir_dashboard',
            'modifier_articles',
            'creer_articles',
            'supprimer_articles',
            'gerer_utilisateurs',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Créer le rôle "visiteur"
        $visitorRole = Role::firstOrCreate(['name' => 'visiteur']);
        // Créer le rôle "admin"
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Lier les permissions aux rôles
        // Le visiteur a accès seulement à la lecture des articles, formations et dashboard
        $visitorRole->syncPermissions([
            'voir_articles',
            'voir_formations',
            'voir_dashboard',
        ]);

        // L'admin a toutes les permissions
        $adminRole->syncPermissions($permissions);

        // Associer les rôles aux utilisateurs (ex: id 1 pour admin et id 2 pour visiteur)
        $admin = User::find(1);
        if ($admin) {
            $admin->assignRole('admin');
        }

        $visitor = User::find(2);
        if ($visitor) {
            $visitor->assignRole('visiteur');
        }
    }
}
