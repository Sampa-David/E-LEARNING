<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

/**
 * SEEDER: RoleSeeder
 * Crée les rôles de base pour l'application:
 * - student: Étudiant (accès limité)
 * - teacher: Professeur/Instructeur (accès moyen)
 * - superadmin: Administrateur (accès complet)
 */
class RoleSeeder extends Seeder
{
    /**
     * SEMER LA BASE DE DONNÉES AVEC LES RÔLES
     * 
     * @return void
     */
    public function run(): void
    {
        // ========== SUPPRIMER LES RÔLES EXISTANTS ==========
        // Avant de créer les nouveaux rôles, on supprime les anciens
        // Cela évite les doublons si on relance le seeder
        Role::query()->delete();

        // ========== CRÉER LE RÔLE "STUDENT" ==========
        // Description: Accès aux cours, enrollment, progression
        $studentRole = Role::create([
            'name' => 'student',
            'description' => 'Utilisateur étudiant - Peut s\'inscrire aux cours, consulter les leçons et soumettre des devoirs',
        ]);

        // ========== CRÉER LE RÔLE "TEACHER" ==========
        // Description: Peut créer et gérer des cours
        $teacherRole = Role::create([
            'name' => 'teacher',
            'description' => 'Instructeur/Professeur - Peut créer des cours, ajouter des leçons, corriger les devoirs',
        ]);

        // ========== CRÉER LE RÔLE "SUPERADMIN" ==========
        // Description: Accès complet au système
        $superadminRole = Role::create([
            'name' => 'superadmin',
            'description' => 'Administrateur système - Accès complet à toutes les fonctionnalités',
        ]);

        // ========== (OPTIONNEL) CRÉER UN RÔLE MODERATOR ==========
        // Vous pouvez ajouter d'autres rôles selon vos besoins
        // $moderatorRole = Role::create([
        //     'name' => 'moderator',
        //     'description' => 'Modérateur - Peut gérer les commentaires et signalements',
        // ]);
    }
}
