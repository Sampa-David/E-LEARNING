<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * MIGRATION: Créer la table PERMISSIONS
     * Cette table stocke toutes les permissions disponibles dans l'application
     */
    public function up(): void
    {
        // ========== CRÉER LA TABLE PERMISSIONS ==========
        Schema::create('permissions', function (Blueprint $table) {
            // ========== COLONNE ID ==========
            // Clé primaire auto-incrémentée
            $table->id();

            // ========== COLONNE NAME ==========
            // Nom unique de la permission (ex: "create_course", "edit_lesson", "delete_user")
            // string(255): Chaîne de caractères, maximum 255 caractères
            // unique(): La valeur doit être unique en base
            $table->string('name')->unique();

            // ========== COLONNE DESCRIPTION ==========
            // Description de la permission pour expliquer ce qu'elle fait
            // text(): Permet du texte plus long
            // nullable(): Cette colonne peut être NULL
            $table->text('description')->nullable();

            // ========== COLONNES DE TIMESTAMP ==========
            // created_at: Quand la permission a été créée
            // updated_at: Quand la permission a été modifiée
            $table->timestamps();
        });
    }

    /**
     * ROLLBACK: Supprimer la table PERMISSIONS
     */
    public function down(): void
    {
        // ========== SUPPRIMER LA TABLE PERMISSIONS ==========
        Schema::dropIfExists('permissions');
    }
};
