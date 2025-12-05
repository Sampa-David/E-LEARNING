<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

/**
 * SEEDER: PermissionSeeder
 * Crée toutes les permissions disponibles dans l'application
 * 
 * Les permissions définissent les actions que les rôles peuvent effectuer
 * Exemples: "view_courses", "create_course", "edit_lesson", "delete_user", etc.
 */
class PermissionSeeder extends Seeder
{
    /**
     * SEMER LA BASE DE DONNÉES AVEC LES PERMISSIONS
     * 
     * @return void
     */
    public function run(): void
    {
        // ========== SUPPRIMER LES PERMISSIONS EXISTANTES ==========
        Permission::query()->delete();

        // ========== PERMISSIONS POUR LES COURS ==========
        // Permission: Consulter la liste des cours
        Permission::create([
            'name' => 'view_courses',
            'description' => 'Voir la liste des cours disponibles',
        ]);

        // Permission: Créer un nouveau cours
        Permission::create([
            'name' => 'create_course',
            'description' => 'Créer un nouveau cours',
        ]);

        // Permission: Modifier un cours
        Permission::create([
            'name' => 'edit_course',
            'description' => 'Modifier un cours existant',
        ]);

        // Permission: Supprimer un cours
        Permission::create([
            'name' => 'delete_course',
            'description' => 'Supprimer un cours',
        ]);

        // ========== PERMISSIONS POUR LES LEÇONS ==========
        // Permission: Consulter les leçons
        Permission::create([
            'name' => 'view_lessons',
            'description' => 'Consulter les leçons d\'un cours',
        ]);

        // Permission: Créer une leçon
        Permission::create([
            'name' => 'create_lesson',
            'description' => 'Ajouter une nouvelle leçon à un cours',
        ]);

        // Permission: Modifier une leçon
        Permission::create([
            'name' => 'edit_lesson',
            'description' => 'Modifier une leçon existante',
        ]);

        // Permission: Supprimer une leçon
        Permission::create([
            'name' => 'delete_lesson',
            'description' => 'Supprimer une leçon',
        ]);

        // ========== PERMISSIONS POUR L'INSCRIPTION ==========
        // Permission: S'inscrire à un cours
        Permission::create([
            'name' => 'enroll_course',
            'description' => 'S\'inscrire à un cours',
        ]);

        // Permission: Se désinscrire d'un cours
        Permission::create([
            'name' => 'unenroll_course',
            'description' => 'Se désinscrire d\'un cours',
        ]);

        // ========== PERMISSIONS POUR LES UTILISATEURS ==========
        // Permission: Consulter les utilisateurs
        Permission::create([
            'name' => 'view_users',
            'description' => 'Voir la liste des utilisateurs',
        ]);

        // Permission: Créer un utilisateur
        Permission::create([
            'name' => 'create_user',
            'description' => 'Créer un nouvel utilisateur',
        ]);

        // Permission: Modifier un utilisateur
        Permission::create([
            'name' => 'edit_user',
            'description' => 'Modifier un utilisateur existant',
        ]);

        // Permission: Supprimer un utilisateur
        Permission::create([
            'name' => 'delete_user',
            'description' => 'Supprimer un utilisateur',
        ]);

        // ========== PERMISSIONS POUR L'ADMINISTRATION ==========
        // Permission: Accès au tableau de bord admin
        Permission::create([
            'name' => 'access_admin_dashboard',
            'description' => 'Accès au tableau de bord d\'administration',
        ]);

        // Permission: Gérer les rôles
        Permission::create([
            'name' => 'manage_roles',
            'description' => 'Créer, modifier et supprimer les rôles',
        ]);

        // Permission: Gérer les permissions
        Permission::create([
            'name' => 'manage_permissions',
            'description' => 'Créer, modifier et supprimer les permissions',
        ]);

        // ========== PERMISSIONS POUR LES ÉVALUATIONS ==========
        // Permission: Consulter les avis
        Permission::create([
            'name' => 'view_reviews',
            'description' => 'Consulter les avis des cours',
        ]);

        // Permission: Créer un avis
        Permission::create([
            'name' => 'create_review',
            'description' => 'Créer un avis sur un cours',
        ]);

        // Permission: Modifier un avis
        Permission::create([
            'name' => 'edit_review',
            'description' => 'Modifier un avis existant',
        ]);

        // Permission: Supprimer un avis
        Permission::create([
            'name' => 'delete_review',
            'description' => 'Supprimer un avis',
        ]);
    }
}
