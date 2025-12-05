<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * MIGRATION: Ajouter la colonne ROLE à la table USERS
     * Cette migration ajoute la colonne 'role' pour stocker le rôle de l'utilisateur
     */
    public function up(): void
    {
        // ========== AJOUTER LA COLONNE ROLE À LA TABLE USERS ==========
        Schema::table('users', function (Blueprint $table) {
            // ========== COLONNE ROLE ==========
            // Colonne enum avec les rôles possibles: student, teacher, superadmin
            // default('student'): Par défaut, tout nouveau utilisateur est étudiant
            // after('email'): Placer cette colonne après la colonne 'email'
            $table->enum('role', ['student', 'teacher', 'superadmin'])
                ->default('student')
                ->after('email');
        });
    }

    /**
     * ROLLBACK: Supprimer la colonne ROLE de la table USERS
     */
    public function down(): void
    {
        // ========== SUPPRIMER LA COLONNE ROLE ==========
        Schema::table('users', function (Blueprint $table) {
            // Supprimer la colonne role
            $table->dropColumn('role');
        });
    }
};
