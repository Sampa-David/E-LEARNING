<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * MODÈLE PERMISSION
 * Représente une permission (action) que les utilisateurs peuvent avoir
 * Exemples: "create_course", "edit_course", "delete_user", etc.
 * 
 * Structure:
 * - id: Identifiant unique de la permission
 * - name: Nom unique de la permission (ex: "create_course")
 * - description: Description de ce que fait cette permission
 * - created_at: Date de création
 * - updated_at: Date de dernière modification
 */
class Permission extends Model
{
    // ========== CONFIGURATION DE BASE ==========
    
    // Utiliser la factory pour les tests et seeds
    use HasFactory;

    // Nom de la table en base de données
    protected $table = 'permissions';

    // Les colonnes qui peuvent être remplies en mass assignment
    protected $fillable = [
        'name',        // Nom de la permission (unique)
        'description', // Description
    ];

    // ========== RELATIONS ==========

    /**
     * RELATION: Une permission a plusieurs rôles
     * Une permission peut être assignée à plusieurs rôles via la table pivot role_permissions
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        // belongsToMany crée une relation many-to-many
        // Cette permission peut être assignée à plusieurs rôles
        return $this->belongsToMany(
            Role::class,
            'role_permissions',
            'permission_id',
            'role_id'
        );
    }
}
