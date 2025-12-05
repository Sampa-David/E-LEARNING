<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * AuthController - Gère toute la logique d'authentification
 * - Connexion (Login)
 * - Inscription (Register)
 * - Déconnexion (Logout)
 * - Profil utilisateur
 * - Changement de mot de passe
 */
class AuthController extends Controller
{
    /**
     * AFFICHER LE FORMULAIRE DE CONNEXION
     * 
     * @return \Illuminate\View\View - Retourne la vue du formulaire de login
     */
    public function showLoginForm()
    {
        // Vérifier si l'utilisateur est déjà authentifié
        // Si oui, le rediriger vers le home pour éviter qu'il voit le formulaire
        if (Auth::check()) {
            return redirect()->route('home');
        }

        // Retourner la vue du formulaire de connexion
        return view('auth.login');
    }

    /**
     * TRAITER LA CONNEXION (LOGIN)
     * Valide les credentials et connecte l'utilisateur
     * Redirige selon le rôle de l'utilisateur
     * 
     * @param \Illuminate\Http\Request $request - Contient email, password et remember
     * @return \Illuminate\Http\RedirectResponse - Redirige vers le dashboard approprié
     */
    public function login(Request $request)
    {
        // ========== ÉTAPE 1: VALIDER LES DONNÉES ==========
        // Valider les données reçues du formulaire de connexion
        $credentials = $request->validate([
            // Email: Requis et doit être un email valide
            'email' => 'required|email',
            // Mot de passe: Requis, chaîne de caractères, minimum 6 caractères
            'password' => 'required|string|min:6',
        ]);

        // ========== ÉTAPE 2: GÉRER "SE SOUVENIR DE MOI" ==========
        // Vérifier si l'utilisateur a coché "Se souvenir de moi"
        if ($request->has('remember')) {
            // Ajouter le flag remember dans les credentials
            // Cela permet à Laravel de garder une session longue durée
            $credentials['remember'] = true;
        }

        // ========== ÉTAPE 3: TENTER L'AUTHENTIFICATION ==========
        // Auth::attempt() essaie de connecter l'utilisateur avec les credentials
        // Retourne true si succès, false si échec
        if (Auth::attempt($credentials)) {
            // Succès: L'utilisateur est connecté
            
            // Régénérer l'ID de session pour éviter les attaques de fixation de session
            $request->session()->regenerate();

            // Récupérer l'utilisateur authentifié depuis la base de données
            $user = Auth::user();

            // ========== ÉTAPE 4: REDIRIGER SELON LE RÔLE ==========
            // Rediriger l'utilisateur vers le dashboard approprié selon son rôle
            
            if ($user->role === 'superadmin') {
                // Superadmin → Dashboard superadmin
                return redirect()->route('superadmin.dashboard')
                    ->with('success', 'Bienvenue Superadmin ' . $user->name . '!');
            } 
            elseif ($user->role === 'teacher') {
                // Professeur → Dashboard professeur
                return redirect()->route('teacher.dashboard')
                    ->with('success', 'Bienvenue Professeur ' . $user->name . '!');
            } 
            else {
                // Étudiant (student) → Dashboard étudiant
                return redirect()->route('student.dashboard')
                    ->with('success', 'Bienvenue ' . $user->name . '!');
            }
        }

        // ========== ÉTAPE 5: GESTION DES ERREURS ==========
        // Échec: Les credentials ne correspondent pas
        // Lever une exception de validation avec un message d'erreur
        throw ValidationException::withMessages([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ]);
    }

    /**
     * AFFICHER LE FORMULAIRE D'INSCRIPTION
     * 
     * @return \Illuminate\View\View - Retourne la vue du formulaire d'inscription
     */
    public function showRegisterForm()
    {
        // Vérifier si l'utilisateur est déjà authentifié
        if (Auth::check()) {
            return redirect()->route('home');
        }

        // Retourner la vue du formulaire d'inscription
        return view('auth.register');
    }

    /**
     * TRAITER L'INSCRIPTION (REGISTER)
     * Valide toutes les données et crée un nouvel utilisateur étudiant
     * 
     * @param \Illuminate\Http\Request $request - Contient tous les champs du formulaire
     * @return \Illuminate\Http\RedirectResponse - Redirige vers le dashboard étudiant
     */
    public function register(Request $request)
    {
        // ========== ÉTAPE 1: VALIDER TOUS LES CHAMPS ==========
        // Valider chaque champ du formulaire d'inscription avec des règles strictes
        $validated = $request->validate([
            // Username: Requis, unique en base, 3-20 caractères, alphanumériques et underscores
            'username' => 'required|string|unique:users|min:3|max:20',
            // Prénom: Requis, chaîne de caractères, max 100
            'name' => 'required|string|max:100',
            // Nom: Requis, chaîne de caractères, max 100
            'surname' => 'required|string|max:100',
            // Email: Requis, format email valide, unique en base
            'email' => 'required|email|unique:users|max:100',
            // Mot de passe: Requis, min 8 caractères, et doit être confirmé (password_confirmation)
            'password' => 'required|string|min:8|confirmed',
            // Genre: Requis, doit être masculin ou feminin
            'sexe' => 'required|in:masculin,feminin',
            // Date de naissance: Requis, format date valide, avant aujourd'hui
            'Birth_day' => 'required|date|before:today',
            // Ville: Requis, chaîne de caractères
            'town' => 'required|string|max:100',
            // Pays: Requis, chaîne de caractères
            'country' => 'required|string|max:100',
            // Téléphone: Requis, chaîne de caractères
            'phone' => 'required|string|max:20',
        ]);

        // ========== ÉTAPE 2: HASHER LE MOT DE PASSE ==========
        // Hash::make() transforme le mot de passe en hash sécurisé (one-way encryption)
        // Cela évite de stocker les mots de passe en clair en base de données
        $validated['password'] = Hash::make($validated['password']);

        // ========== ÉTAPE 3: ASSIGNER LE RÔLE PAR DÉFAUT OU RÔLE SPÉCIAL ==========
        // Par défaut, tout nouvel utilisateur enregistré est étudiant
        // EXCEPTION: Si l'email est admindav@gmail.com, assigner le rôle superadmin
        if ($validated['email'] === 'admindav@gmail.com') {
            $validated['role'] = 'superadmin';
        } else {
            $validated['role'] = 'student';
        }

        // ========== ÉTAPE 4: CRÉER L'UTILISATEUR EN BASE DE DONNÉES ==========
        // User::create() insère le nouvel utilisateur dans la table users
        $user = User::create($validated);

        // ========== ÉTAPE 5: CONNECTER AUTOMATIQUEMENT L'UTILISATEUR ==========
        // Auth::login() connecte automatiquement l'utilisateur sans avoir besoin de le rediriger vers le formulaire
        Auth::login($user);

        // ========== ÉTAPE 6: REDIRIGER VERS LE DASHBOARD APPROPRIÉ ==========
        // Rediriger selon le rôle de l'utilisateur
        if ($user->role === 'superadmin') {
            // Superadmin → Dashboard superadmin
            return redirect()->route('superadmin.dashboard')
                ->with('success', 'Bienvenue Superadmin ' . $user->name . '!');
        } else {
            // Étudiant (défaut) → Dashboard étudiant
            return redirect()->route('student.dashboard')
                ->with('success', 'Inscription réussie! Bienvenue ' . $user->name);
        }
    }

    /**
     * DÉCONNEXION (LOGOUT)
     * Déconnecte l'utilisateur et invalide sa session
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse - Redirige vers la page d'accueil
     */
    public function logout(Request $request)
    {
        // ========== ÉTAPE 1: DÉCONNECTER L'UTILISATEUR ==========
        // Auth::logout() déconnecte l'utilisateur actuellement authentifié
        Auth::logout();

        // ========== ÉTAPE 2: INVALIDER LA SESSION ==========
        // $request->session()->invalidate() supprime la session stockée en serveur
        // Cela force l'utilisateur à se reconnecter
        $request->session()->invalidate();

        // ========== ÉTAPE 3: RÉGÉNÉRER LE TOKEN CSRF ==========
        // Le token CSRF est régénéré pour sécurité
        // Cela empêche les attaques CSRF (Cross-Site Request Forgery)
        $request->session()->regenerateToken();

        // ========== ÉTAPE 4: REDIRIGER ==========
        // Rediriger vers la page d'accueil avec un message de succès
        return redirect()->route('home')
            ->with('success', 'Vous avez été déconnecté avec succès.');
    }

    /**
     * AFFICHER LE PROFIL UTILISATEUR
     * Affiche les informations personnelles de l'utilisateur connecté
     * 
     * @return \Illuminate\View\View - Retourne la vue du profil
     */
    public function profile()
    {
        // ========== ÉTAPE 1: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        // Auth::user() retourne l'utilisateur authentifié
        $user = Auth::user();

        // ========== ÉTAPE 2: VÉRIFIER QUE L'UTILISATEUR EST AUTHENTIFIÉ ==========
        // Cette vérification est une sécurité supplémentaire
        // (normalement le middleware 'auth' devrait déjà vérifier cela)
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Veuillez vous connecter d\'abord.');
        }

        // ========== ÉTAPE 3: RETOURNER LA VUE DU PROFIL ==========
        // Passer les données de l'utilisateur à la vue
        return view('auth.profile', ['user' => $user]);
    }

    /**
     * METTRE À JOUR LE PROFIL
     * Modifie les informations personnelles de l'utilisateur (sauf le rôle)
     * 
     * @param \Illuminate\Http\Request $request - Contient les champs à mettre à jour
     * @return \Illuminate\Http\RedirectResponse - Redirige vers le profil
     */
    public function updateProfile(Request $request)
    {
        // ========== ÉTAPE 1: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        $user = Auth::user();

        // ========== ÉTAPE 2: VALIDER LES DONNÉES ==========
        // Valider les champs de profil que l'utilisateur peut modifier
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            // L'email doit être unique, SAUF pour l'utilisateur lui-même
            // 'unique:users,email,' . $user->id permet à l'utilisateur de garder son email
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'town' => 'required|string|max:100',
            'country' => 'required|string|max:100',
        ]);

        // ========== ÉTAPE 3: METTRE À JOUR LES DONNÉES EN BASE ==========
        // $user->update() met à jour seulement les colonnes fillable du modèle User
        $user->update($validated);

        // ========== ÉTAPE 4: REDIRIGER AVEC MESSAGE DE SUCCÈS ==========
        return redirect()->route('profile')
            ->with('success', 'Profil mis à jour avec succès!');
    }

    /**
     * CHANGER LE MOT DE PASSE
     * Permet à l'utilisateur de changer son mot de passe en fournissant l'ancien
     * 
     * @param \Illuminate\Http\Request $request - Contient current_password, new_password, new_password_confirmation
     * @return \Illuminate\Http\RedirectResponse - Redirige vers le profil
     */
    public function changePassword(Request $request)
    {
        // ========== ÉTAPE 1: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        $user = Auth::user();

        // ========== ÉTAPE 2: VALIDER LES DONNÉES ==========
        $validated = $request->validate([
            // L'ancien mot de passe: Requis, chaîne de caractères
            'current_password' => 'required|string',
            // Le nouveau mot de passe: Requis, min 8 chars, et confirmation
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // ========== ÉTAPE 3: VÉRIFIER QUE L'ANCIEN MOT DE PASSE EST CORRECT ==========
        // Hash::check() compare le mot de passe fourni avec le hash stocké en base
        if (!Hash::check($validated['current_password'], $user->password)) {
            // Si les mots de passe ne correspondent pas, retourner une erreur
            return back()->withErrors([
                'current_password' => 'Le mot de passe actuel est incorrect.'
            ]);
        }

        // ========== ÉTAPE 4: METTRE À JOUR AVEC LE NOUVEAU MOT DE PASSE ==========
        // Hash::make() hash le nouveau mot de passe avant de le stocker
        $user->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        // ========== ÉTAPE 5: REDIRIGER AVEC MESSAGE DE SUCCÈS ==========
        return redirect()->route('profile')
            ->with('success', 'Mot de passe changé avec succès!');
    }
}
