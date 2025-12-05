<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * MIDDLEWARE: CheckRole
 * Vérifie si l'utilisateur connecté a le rôle requis
 * 
 * Utilisation:
 * Route::middleware('check.role:student,teacher')->group(function () {
 *     Route::get('/dashboard', [DashboardController::class, 'index']);
 * });
 * 
 * Le middleware peut être appliqué avec un ou plusieurs rôles
 */
class CheckRole
{
    /**
     * TRAITER LA REQUÊTE
     * Vérifier que l'utilisateur a l'un des rôles autorisés
     * 
     * @param \Illuminate\Http\Request $request - L'objet Request
     * @param \Closure $next - Fonction pour continuer le pipeline
     * @param string ...$roles - Rôles autorisés (variable number of arguments)
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // ========== ÉTAPE 1: VÉRIFIER SI L'UTILISATEUR EST AUTHENTIFIÉ ==========
        // Si pas authentifié, rediriger vers la page de login
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        // ========== ÉTAPE 2: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        $user = Auth::user();

        // ========== ÉTAPE 3: VÉRIFIER LE RÔLE ==========
        // Vérifier si le rôle de l'utilisateur est dans la liste des rôles autorisés
        // in_array() cherche la valeur du rôle dans le tableau des rôles autorisés
        if (in_array($user->role, $roles)) {
            // ========== SUCCÈS: RÔLE AUTORISÉ ==========
            // Continuer vers la route suivante
            return $next($request);
        }

        // ========== ERREUR: RÔLE NON AUTORISÉ ==========
        // L'utilisateur n'a pas le rôle requis
        // Rediriger vers une page d'erreur ou d'accueil
        return redirect()->route('home')
            ->with('error', 'Vous n\'avez pas la permission d\'accéder à cette ressource.');
    }
}
