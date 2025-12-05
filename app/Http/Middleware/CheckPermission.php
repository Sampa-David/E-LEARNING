<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * MIDDLEWARE: CheckPermission
 * Vérifie si l'utilisateur connecté a la permission requise
 * 
 * Utilisation:
 * Route::middleware('check.permission:create_course,delete_course')->group(function () {
 *     Route::post('/course', [CourseController::class, 'store']);
 * });
 * 
 * Vérifications appliquées:
 * 1. L'utilisateur est authentifié
 * 2. Le rôle de l'utilisateur a au moins l'une des permissions requises
 */
class CheckPermission
{
    /**
     * TRAITER LA REQUÊTE
     * Vérifier que l'utilisateur (via son rôle) a la permission requise
     * 
     * @param \Illuminate\Http\Request $request - L'objet Request
     * @param \Closure $next - Fonction pour continuer le pipeline
     * @param string ...$permissions - Permissions autorisées
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        // ========== ÉTAPE 1: VÉRIFIER SI L'UTILISATEUR EST AUTHENTIFIÉ ==========
        if (!Auth::check()) {
            // Pas authentifié: rediriger vers le login
            return redirect()->route('login')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        // ========== ÉTAPE 2: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        $user = Auth::user();

        // ========== ÉTAPE 3: VÉRIFIER SI LE RÔLE A LA PERMISSION ==========
        // Vérifier si au moins l'une des permissions est présente dans le rôle
        // En boucle, pour vérifier chaque permission demandée
        foreach ($permissions as $permission) {
            // ========== SOUS-ÉTAPE 1: RÉCUPÉRER LE RÔLE DE L'UTILISATEUR ==========
            // Note: Dans notre système, 'role' est un string (nom du rôle)
            // Mais on pourrait aussi avoir une relation hasOne avec la table roles
            // Pour cet exemple, on suppose que role est le nom du rôle
            
            // Récupérer l'objet Role depuis le nom du rôle
            // Role::where('name', $user->role)->first() retourne l'objet Role
            $role = \App\Models\Role::where('name', $user->role)->first();

            // ========== SOUS-ÉTAPE 2: VÉRIFIER LA PERMISSION ==========
            if ($role && $role->hasPermission($permission)) {
                // La permission existe pour ce rôle
                // Continuer vers la route suivante
                return $next($request);
            }
        }

        // ========== ERREUR: PERMISSION NON TROUVÉE ==========
        // L'utilisateur n'a aucune des permissions requises
        return redirect()->route('home')
            ->with('error', 'Vous n\'avez pas la permission d\'accéder à cette ressource.');
    }
}
