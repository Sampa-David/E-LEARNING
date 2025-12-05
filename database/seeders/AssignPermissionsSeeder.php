<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

/**
 * SEEDER: AssignPermissionsSeeder
 * Assigne les permissions appropriées à chaque rôle
 * 
 * Logique d'assignation:
 * - STUDENT: Peut voir les cours, s'inscrire, voir les leçons, créer des avis
 * - TEACHER: Peut gérer ses cours et leçons
 * - SUPERADMIN: Peut tout faire
 */
class AssignPermissionsSeeder extends Seeder
{
    /**
     * SEMER LA BASE DE DONNÉES AVEC LES ASSIGNATIONS DE PERMISSIONS
     * 
     * @return void
     */
    public function run(): void
    {
        // ========== RÉCUPÉRER LES RÔLES ==========
        // Chercher les rôles créés par RoleSeeder
        $studentRole = Role::where('name', 'student')->first();
        $teacherRole = Role::where('name', 'teacher')->first();
        $superadminRole = Role::where('name', 'superadmin')->first();

        // ========== VÉRIFIER QUE LES RÔLES EXISTENT ==========
        // Si les rôles n'existent pas, arrêter le seeder
        if (!$studentRole || !$teacherRole || !$superadminRole) {
            $this->command->error('Les rôles doivent être créés d\'abord. Lancez RoleSeeder.');
            return;
        }

        // ========== RÉCUPÉRER LES PERMISSIONS ==========
        // Récupérer toutes les permissions créées par PermissionSeeder
        $permissions = Permission::all();

        // ========== ASSIGNER LES PERMISSIONS AU RÔLE STUDENT ==========
        // Les étudiants peuvent:
        $studentPermissions = [
            'view_courses',      // Voir les cours
            'view_lessons',      // Voir les leçons
            'enroll_course',     // S'inscrire aux cours
            'unenroll_course',   // Se désinscrire
            'view_reviews',      // Voir les avis
            'create_review',     // Créer un avis
            'edit_review',       // Modifier leur propre avis
        ];

        // Boucler sur les noms de permissions et les assigner
        foreach ($studentPermissions as $permissionName) {
            // ========== CHERCHER LA PERMISSION ==========
            $permission = $permissions->firstWhere('name', $permissionName);
            
            // ========== VÉRIFIER QUE LA PERMISSION EXISTE ==========
            if ($permission) {
                // Assigner la permission au rôle student
                $studentRole->grantPermission($permission);
            }
        }

        // ========== ASSIGNER LES PERMISSIONS AU RÔLE TEACHER ==========
        // Les professeurs peuvent:
        $teacherPermissions = [
            'view_courses',      // Voir les cours
            'create_course',     // Créer un cours
            'edit_course',       // Modifier un cours
            'delete_course',     // Supprimer un cours
            'view_lessons',      // Voir les leçons
            'create_lesson',     // Créer une leçon
            'edit_lesson',       // Modifier une leçon
            'delete_lesson',     // Supprimer une leçon
            'view_reviews',      // Voir les avis sur leurs cours
            'view_users',        // Voir les utilisateurs inscrits
        ];

        // Boucler sur les noms de permissions et les assigner
        foreach ($teacherPermissions as $permissionName) {
            // ========== CHERCHER LA PERMISSION ==========
            $permission = $permissions->firstWhere('name', $permissionName);
            
            // ========== VÉRIFIER QUE LA PERMISSION EXISTE ==========
            if ($permission) {
                // Assigner la permission au rôle teacher
                $teacherRole->grantPermission($permission);
            }
        }

        // ========== ASSIGNER TOUTES LES PERMISSIONS AU RÔLE SUPERADMIN ==========
        // Les superadmins peuvent faire absolument tout
        // On assigne toutes les permissions
        foreach ($permissions as $permission) {
            // Assigner chaque permission au rôle superadmin
            $superadminRole->grantPermission($permission);
        }

        // ========== AFFICHER UN MESSAGE DE CONFIRMATION ==========
        $this->command->info('Permissions assignées avec succès aux rôles!');
    }
}
