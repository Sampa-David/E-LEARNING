<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * MODÈLE ROLE
 * Représente un rôle dans le système (student, teacher, superadmin)
 * 
 * Structure:
 * - id: Identifiant unique du rôle
 * - name: Nom du rôle (exemple: "student", "teacher", "superadmin")
 * - description: Description du rôle pour les administrateurs
 * - created_at: Date de création
 * - updated_at: Date de dernière modification
 */
class Role extends Model
{
    // ========== CONFIGURATION DE BASE ==========
    
    // Utiliser la factory pour les tests et seeds
    use HasFactory;

    // Nom de la table en base de données
    protected $table = 'roles';

    // Les colonnes qui peuvent être remplies en mass assignment
    // (protection contre les attaques de mass assignment)
    protected $fillable = [
        'name',        // Nom du rôle
        'description', // Description
    ];

    // ========== RELATIONS ==========

    /**
     * RELATION: Un rôle a plusieurs permissions
     * Un rôle peut avoir plusieurs permissions via la table pivot role_permissions
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        // belongsToMany crée une relation many-to-many
        // Paramètres:
        // 1. Permission::class - Model lié
        // 2. 'role_permissions' - Nom de la table pivot
        // 3. 'role_id' - Clé étrangère du rôle dans la table pivot
        // 4. 'permission_id' - Clé étrangère de la permission dans la table pivot
        return $this->belongsToMany(
            Permission::class,
            'role_permissions',
            'role_id',
            'permission_id'
        );
    }

    /**
     * RELATION: Un rôle a plusieurs utilisateurs
     * Un rôle peut être assigné à plusieurs utilisateurs
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        // hasMany crée une relation one-to-many
        // Cette relation est basée sur la colonne 'role' de la table users
        // (NOT une relation via une table pivot - c'est une simple clé étrangère)
        return $this->hasMany(User::class, 'role', 'name');
    }

    // ========== MÉTHODES D'UTILITY ==========

    /**
     * VÉRIFIER SI LE RÔLE POSSÈDE UNE PERMISSION
     * Vérifie si ce rôle a la permission spécifiée
     * 
     * @param string $permissionName - Le nom de la permission (ex: "create_course")
     * @return bool - true si le rôle a la permission, false sinon
     */
    public function hasPermission($permissionName)
    {
        // ========== ÉTAPE 1: VÉRIFIER DANS LES PERMISSIONS DU RÔLE ==========
        // $this->permissions est la relation définie ci-dessus
        // On cherche si une permission avec ce nom existe
        return $this->permissions()
            ->where('name', $permissionName)
            ->exists(); // exists() retourne true si au moins une ligne existe
    }

    /**
     * ASSIGNER UNE PERMISSION AU RÔLE
     * Ajoute une permission à ce rôle
     * 
     * @param \App\Models\Permission $permission - L'objet Permission à assigner
     * @return void
     */
    public function grantPermission(Permission $permission)
    {
        // ========== ÉTAPE 1: VÉRIFIER QUE LA PERMISSION N'EST PAS DÉJÀ ASSIGNÉE ==========
        // Éviter les doublons dans la table pivot
        if (!$this->hasPermission($permission->name)) {
            // Si la permission n'existe pas encore pour ce rôle...
            
            // ========== ÉTAPE 2: ASSIGNER LA PERMISSION ==========
            // $this->permissions()->attach() ajoute une entrée à la table pivot
            // Le paramètre est l'ID de la permission
            $this->permissions()->attach($permission->id);
        }
    }

    /**
     * RÉVOQUER UNE PERMISSION AU RÔLE
     * Retire une permission de ce rôle
     * 
     * @param \App\Models\Permission $permission - L'objet Permission à retirer
     * @return void
     */
    public function revokePermission(Permission $permission)
    {
        // ========== ÉTAPE 1: VÉRIFIER QUE LA PERMISSION EST ASSIGNÉE ==========
        if ($this->hasPermission($permission->name)) {
            // Si la permission existe pour ce rôle...
            
            // ========== ÉTAPE 2: RETIRER LA PERMISSION ==========
            // $this->permissions()->detach() enlève une entrée de la table pivot
            $this->permissions()->detach($permission->id);
        }
    }

    /**
     * ASSIGNER PLUSIEURS PERMISSIONS AU RÔLE
     * Ajoute plusieurs permissions en une seule opération
     * 
     * @param array $permissionIds - Tableau d'IDs de permissions
     * @return void
     */
    public function syncPermissions(array $permissionIds)
    {
        // ========== ÉTAPE 1: SYNCHRONISER LES PERMISSIONS ==========
        // $this->permissions()->sync() remplace toutes les permissions par celles spécifiées
        // Les permissions non dans le tableau sont supprimées
        // Les permissions du tableau sont ajoutées
        $this->permissions()->sync($permissionIds);
    }
}
