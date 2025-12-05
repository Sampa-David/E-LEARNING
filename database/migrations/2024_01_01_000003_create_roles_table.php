<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * MIGRATION: Créer la table ROLES
     * Cette table stocke tous les rôles disponibles dans l'application
     */
    public function up(): void
    {
        // ========== CRÉER LA TABLE ROLES ==========
        Schema::create('roles', function (Blueprint $table) {
            // ========== COLONNE ID ==========
            // Clé primaire auto-incrémentée
            $table->id();

            // ========== COLONNE NAME ==========
            // Nom unique du rôle (ex: "student", "teacher", "superadmin")
            // string(255): Chaîne de caractères, maximum 255 caractères
            // unique(): La valeur doit être unique en base
            $table->string('name')->unique();

            // ========== COLONNE DESCRIPTION ==========
            // Description du rôle pour expliquer son utilité
            // text(): Permet du texte plus long (max 65535 caractères)
            // nullable(): Cette colonne peut être NULL si pas de description
            $table->text('description')->nullable();

            // ========== COLONNES DE TIMESTAMP ==========
            // created_at: Quand le rôle a été créé
            // updated_at: Quand le rôle a été modifié pour la dernière fois
            // Laravel remplit ces colonnes automatiquement
            $table->timestamps();
        });
    }

    /**
     * ROLLBACK: Supprimer la table ROLES
     * Cette méthode est appelée quand on fait 'php artisan migrate:rollback'
     */
    public function down(): void
    {
        // ========== SUPPRIMER LA TABLE ROLES ==========
        Schema::dropIfExists('roles');
    }
};
