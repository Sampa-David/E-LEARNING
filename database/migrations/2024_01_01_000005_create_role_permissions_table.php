<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * MIGRATION: Créer la table pivot ROLE_PERMISSIONS
     * Cette table relie les rôles aux permissions (relation many-to-many)
     * 
     * Exemple de données:
     * role_id | permission_id
     * ------- | -------
     *    1    |    5        (Le rôle "student" a la permission "view_courses")
     *    1    |    6        (Le rôle "student" a la permission "enroll_course")
     *    2    |    7        (Le rôle "teacher" a la permission "create_course")
     */
    public function up(): void
    {
        // ========== CRÉER LA TABLE PIVOT ==========
        Schema::create('role_permissions', function (Blueprint $table) {
            // ========== COLONNE ROLE_ID ==========
            // Clé étrangère vers la table roles
            // unsignedBigInteger(): Entier non signé (positif), 8 bytes
            $table->unsignedBigInteger('role_id');
            
            // ========== COLONNE PERMISSION_ID ==========
            // Clé étrangère vers la table permissions
            $table->unsignedBigInteger('permission_id');

            // ========== CLÉS PRIMAIRES COMPOSÉES ==========
            // La combinaison (role_id, permission_id) doit être unique
            // On ne peut pas assigner deux fois la même permission à un rôle
            $table->primary(['role_id', 'permission_id']);

            // ========== CONTRAINTES DE CLÉS ÉTRANGÈRES ==========
            // Contrainte pour role_id:
            // Si un rôle est supprimé, supprimer aussi ses permissions
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade'); // cascade = supprimer les entrées si le rôle est supprimé

            // Contrainte pour permission_id:
            // Si une permission est supprimée, retirer de tous les rôles
            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');

            // ========== COLONNES DE TIMESTAMP ==========
            // created_at: Quand la permission a été assignée au rôle
            $table->timestamps();
        });
    }

    /**
     * ROLLBACK: Supprimer la table ROLE_PERMISSIONS
     */
    public function down(): void
    {
        // ========== SUPPRIMER LA TABLE PIVOT ==========
        Schema::dropIfExists('role_permissions');
    }
};
