<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * MODÈLE USER
 * Représente un utilisateur du système E-Learning
 * 
 * Structure:
 * - id: Identifiant unique
 * - username: Nom d'utilisateur unique
 * - name: Prénom
 * - surname: Nom de famille
 * - email: Email unique
 * - password: Mot de passe hasé
 * - role: Rôle de l'utilisateur (student, teacher, superadmin)
 * - sexe: Genre de l'utilisateur
 * - Birth_day: Date de naissance
 * - town: Ville
 * - country: Pays
 * - phone: Numéro de téléphone
 */
class User extends Authenticatable
{
    // ========== TRAITS ==========
    // HasFactory: Permet la création de données de test
    // Notifiable: Permet l'envoi de notifications
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * COLONNES REMPLISSABLES
     * Ces colonnes peuvent être remplies avec mass assignment (User::create())
     * Toutes les colonnes de l'utilisateur sauf password et remember_token qui sont spéciaux
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'name',
        'surname',
        'email',
        'password',
        'role',
        'sexe',
        'Birth_day',
        'town',
        'country',
        'phone',
    ];

    /**
     * COLONNES CACHÉES
     * Ces colonnes ne seront pas incluses lors de la sérialisation (toJSON, etc.)
     * Utile pour les données sensibles comme les mots de passe
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',        // Le mot de passe ne doit jamais être retourné
        'remember_token',  // Token pour la fonction "se souvenir de moi"
    ];

    /**
     * TRANSTYPAGE DES COLONNES
     * Définit comment les colonnes sont transposées en types PHP
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Convertir en objet DateTime
            'password' => 'hashed',            // Le mot de passe est hasé automatiquement
        ];
    }

    // ========== RELATIONS ==========

    /**
     * RELATION: Un utilisateur a un rôle
     * La relation se fait via la colonne 'role' qui contient le nom du rôle
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function roleObject()
    {
        // hasOne crée une relation one-to-one
        // Chercher le rôle dont le nom correspond à la colonne 'role' de cet utilisateur
        return $this->hasOne(Role::class, 'name', 'role');
    }

    // ========== MÉTHODES D'UTILITY ==========

    /**
     * VÉRIFIER SI L'UTILISATEUR EST UN ÉTUDIANT
     * 
     * @return bool
     */
    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    /**
     * VÉRIFIER SI L'UTILISATEUR EST UN PROFESSEUR
     * 
     * @return bool
     */
    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    /**
     * VÉRIFIER SI L'UTILISATEUR EST UN SUPERADMIN
     * 
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    /**
     * VÉRIFIER SI L'UTILISATEUR A UNE PERMISSION
     * Cherche la permission dans les permissions du rôle de l'utilisateur
     * 
     * @param string $permissionName - Nom de la permission (ex: "create_course")
     * @return bool
     */
    public function hasPermission($permissionName): bool
    {
        // Récupérer le rôle de cet utilisateur
        $role = Role::where('name', $this->role)->first();

        // Vérifier si le rôle existe et a la permission
        if ($role) {
            return $role->hasPermission($permissionName);
        }

        return false;
    }
}

