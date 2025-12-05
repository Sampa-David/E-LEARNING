<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * SuperAdminDashboardController
 * Gère le tableau de bord pour les superadministrateurs
 * 
 * Fonctionnalités:
 * - Gérer les utilisateurs (créer, modifier, supprimer)
 * - Gérer les rôles et permissions
 * - Voir les statistiques du système
 * - Gérer tous les cours
 */
class SuperAdminDashboardController extends Controller
{
    /**
     * AFFICHER LE TABLEAU DE BORD SUPERADMIN
     * Affiche les statistiques globales du système
     * 
     * @return \Illuminate\View\View - Vue du dashboard superadmin
     */
    public function index()
    {
        // ========== ÉTAPE 1: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        // Auth::user() retourne l'utilisateur authentifié
        $user = Auth::user();

        // ========== ÉTAPE 2: VÉRIFIER QUE L'UTILISATEUR EST SUPERADMIN ==========
        // Sécurité supplémentaire: vérifier que l'utilisateur a le rôle "superadmin"
        if ($user->role !== 'superadmin') {
            // Si ce n'est pas un superadmin, retourner une erreur
            return redirect()->route('home')
                ->with('error', 'Accès réservé aux administrateurs uniquement.');
        }

        // ========== ÉTAPE 3: RÉCUPÉRER LES STATISTIQUES DU SYSTÈME ==========
        
        // Nombre total d'utilisateurs en base de données
        $totalUsers = User::count();
        
        // Nombre d'étudiants (utilisateurs avec le rôle "student")
        $totalStudents = User::where('role', 'student')->count();
        
        // Nombre de professeurs (utilisateurs avec le rôle "teacher")
        $totalTeachers = User::where('role', 'teacher')->count();
        
        // Nombre de superadmins (utilisateurs avec le rôle "superadmin")
        $totalAdmins = User::where('role', 'superadmin')->count();
        
        // Nombre total de rôles disponibles
        $totalRoles = Role::count();
        
        // Nombre total de permissions disponibles
        $totalPermissions = Permission::count();

        // ========== ÉTAPE 4: PRÉPARER LES DONNÉES POUR LA VUE ==========
        $data = [
            'user' => $user,
            'totalUsers' => $totalUsers,
            'totalStudents' => $totalStudents,
            'totalTeachers' => $totalTeachers,
            'totalAdmins' => $totalAdmins,
            'totalRoles' => $totalRoles,
            'totalPermissions' => $totalPermissions,
            'recentUsers' => User::latest()->limit(10)->get(), // 10 utilisateurs les plus récents
        ];

        // ========== ÉTAPE 5: RETOURNER LA VUE ==========
        return view('dashboards.superadmin', $data);
    }

    /**
     * AFFICHER LA LISTE DE TOUS LES UTILISATEURS
     * Liste tous les utilisateurs du système avec pagination
     * 
     * @return \Illuminate\View\View
     */
    public function users()
    {
        // ========== ÉTAPE 1: RÉCUPÉRER TOUS LES UTILISATEURS ==========
        // paginate(15) retourne 15 utilisateurs par page
        $users = User::paginate(15);

        // ========== ÉTAPE 2: RETOURNER LA VUE ==========
        return view('dashboards.superadmin.users', ['users' => $users]);
    }

    /**
     * AFFICHER LE FORMULAIRE DE CRÉATION D'UTILISATEUR
     * Affiche la page pour créer un nouvel utilisateur
     * 
     * @return \Illuminate\View\View
     */
    public function createUserForm()
    {
        // ========== ÉTAPE 1: RÉCUPÉRER LES RÔLES DISPONIBLES ==========
        // Pour que l'admin puisse sélectionner un rôle lors de la création
        $roles = Role::all();

        // ========== ÉTAPE 2: RETOURNER LA VUE ==========
        return view('dashboards.superadmin.create-user', ['roles' => $roles]);
    }

    /**
     * CRÉER UN NOUVEL UTILISATEUR
     * Valide et sauvegarde un nouvel utilisateur
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeUser(Request $request)
    {
        // ========== ÉTAPE 1: VALIDER LES DONNÉES ==========
        $validated = $request->validate([
            'username' => 'required|string|unique:users|min:3|max:20',
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:student,teacher,superadmin',
            'sexe' => 'required|in:masculin,feminin',
            'Birth_day' => 'required|date|before:today',
            'town' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
        ]);

        // ========== ÉTAPE 2: HASHER LE MOT DE PASSE ==========
        // Hash::make() transforme le mot de passe en hash sécurisé
        $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);

        // ========== ÉTAPE 3: CRÉER L'UTILISATEUR ==========
        // User::create() insère le nouvel utilisateur
        User::create($validated);

        // ========== ÉTAPE 4: REDIRIGER ==========
        return redirect()->route('superadmin.users')
            ->with('success', 'Utilisateur créé avec succès!');
    }

    /**
     * AFFICHER LE FORMULAIRE DE MODIFICATION D'UTILISATEUR
     * 
     * @param \App\Models\User $user - L'utilisateur à modifier
     * @return \Illuminate\View\View
     */
    public function editUserForm(User $user)
    {
        // ========== ÉTAPE 1: RÉCUPÉRER LES RÔLES DISPONIBLES ==========
        $roles = Role::all();

        // ========== ÉTAPE 2: RETOURNER LA VUE ==========
        return view('dashboards.superadmin.edit-user', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * METTRE À JOUR UN UTILISATEUR
     * Modifie les informations d'un utilisateur
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUser(Request $request, User $user)
    {
        // ========== ÉTAPE 1: VALIDER LES DONNÉES ==========
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
            'role' => 'required|in:student,teacher,superadmin',
            'phone' => 'required|string|max:20',
            'town' => 'required|string|max:100',
            'country' => 'required|string|max:100',
        ]);

        // ========== ÉTAPE 2: METTRE À JOUR L'UTILISATEUR ==========
        $user->update($validated);

        // ========== ÉTAPE 3: REDIRIGER ==========
        return redirect()->route('superadmin.users')
            ->with('success', 'Utilisateur mis à jour avec succès!');
    }

    /**
     * SUPPRIMER UN UTILISATEUR
     * Supprime complètement un utilisateur du système
     * 
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser(User $user)
    {
        // ========== ÉTAPE 1: VÉRIFIER QUE CE N'EST PAS LE DERNIER SUPERADMIN ==========
        // On veut éviter de supprimer le dernier administrateur
        if ($user->role === 'superadmin') {
            // Vérifier s'il y a d'autres superadmins
            if (User::where('role', 'superadmin')->count() <= 1) {
                // C'est le dernier superadmin, ne pas le supprimer
                return redirect()->route('superadmin.users')
                    ->with('error', 'Impossible de supprimer le dernier administrateur du système.');
            }
        }

        // ========== ÉTAPE 2: SUPPRIMER L'UTILISATEUR ==========
        // $user->delete() supprime l'utilisateur de la base de données
        $user->delete();

        // ========== ÉTAPE 3: REDIRIGER ==========
        return redirect()->route('superadmin.users')
            ->with('success', 'Utilisateur supprimé avec succès!');
    }

    /**
     * AFFICHER LA LISTE DES RÔLES
     * Liste tous les rôles disponibles dans le système
     * 
     * @return \Illuminate\View\View
     */
    public function roles()
    {
        // ========== ÉTAPE 1: RÉCUPÉRER TOUS LES RÔLES ==========
        $roles = Role::with('permissions')->paginate(10);

        // ========== ÉTAPE 2: RETOURNER LA VUE ==========
        return view('dashboards.superadmin.roles', ['roles' => $roles]);
    }

    /**
     * AFFICHER LA LISTE DES PERMISSIONS
     * Liste toutes les permissions disponibles
     * 
     * @return \Illuminate\View\View
     */
    public function permissions()
    {
        // ========== ÉTAPE 1: RÉCUPÉRER TOUTES LES PERMISSIONS ==========
        $permissions = Permission::paginate(15);

        // ========== ÉTAPE 2: RETOURNER LA VUE ==========
        return view('dashboards.superadmin.permissions', ['permissions' => $permissions]);
    }

    /**
     * ASSIGNER UNE PERMISSION À UN RÔLE
     * Ajoute une permission à un rôle spécifique
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignPermissionToRole(Request $request, Role $role)
    {
        // ========== ÉTAPE 1: VALIDER LES DONNÉES ==========
        $validated = $request->validate([
            'permission_id' => 'required|exists:permissions,id',
        ]);

        // ========== ÉTAPE 2: RÉCUPÉRER LA PERMISSION ==========
        $permission = Permission::find($validated['permission_id']);

        // ========== ÉTAPE 3: ASSIGNER LA PERMISSION ==========
        // Utiliser la méthode du modèle Role pour assigner
        $role->grantPermission($permission);

        // ========== ÉTAPE 4: REDIRIGER ==========
        return redirect()->back()
            ->with('success', 'Permission assignée au rôle avec succès!');
    }

    /**
     * RÉVOQUER UNE PERMISSION D'UN RÔLE
     * Retire une permission d'un rôle spécifique
     * 
     * @param \App\Models\Role $role
     * @param \App\Models\Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function revokePermissionFromRole(Role $role, Permission $permission)
    {
        // ========== ÉTAPE 1: RÉVOQUER LA PERMISSION ==========
        // Utiliser la méthode du modèle Role pour révoquer
        $role->revokePermission($permission);

        // ========== ÉTAPE 2: REDIRIGER ==========
        return redirect()->back()
            ->with('success', 'Permission révoquée du rôle avec succès!');
    }

    /**
     * AFFICHER LES PARAMÈTRES SYSTÈME
     * Page de configuration générale du système
     * 
     * @return \Illuminate\View\View
     */
    public function settings()
    {
        // ========== RETOURNER LA VUE DE CONFIGURATION ==========
        return view('dashboards.superadmin.settings');
    }
}
