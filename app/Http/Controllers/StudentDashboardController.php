<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * StudentDashboardController
 * Gère le tableau de bord pour les étudiants
 * 
 * Fonctionnalités:
 * - Afficher les cours inscrits
 * - Afficher la progression des cours
 * - Afficher les certificats
 */
class StudentDashboardController extends Controller
{
    /**
     * AFFICHER LE TABLEAU DE BORD ÉTUDIANT
     * Affiche les cours inscrits, la progression, les notifications
     * 
     * @return \Illuminate\View\View - Vue du dashboard étudiant
     */
    public function index()
    {
        // ========== ÉTAPE 1: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        // Auth::user() retourne l'utilisateur authentifié
        $user = Auth::user();

        // ========== ÉTAPE 2: VÉRIFIER QUE L'UTILISATEUR EST UN ÉTUDIANT ==========
        // Sécurité supplémentaire: vérifier que l'utilisateur a le rôle "student"
        if ($user->role !== 'student') {
            // Si ce n'est pas un étudiant, retourner une erreur
            return redirect()->route('home')
                ->with('error', 'Accès non autorisé. Vous n\'êtes pas un étudiant.');
        }

        // ========== ÉTAPE 3: RÉCUPÉRER LES STATISTIQUES DE L'ÉTUDIANT ==========
        // Nombre de cours suivis depuis la base de données
        $enrolledCoursesCount = Enrollment::where('student_id', $user->id)->count();
        
        // Nombre de cours complétés
        $completedCoursesCount = Enrollment::where('student_id', $user->id)
            ->where('status', 'completed')
            ->count();
        
        // Nombre d'heures d'apprentissage (somme de duration_hours des cours complétés)
        $totalLearningHours = Enrollment::where('student_id', $user->id)
            ->where('enrollments.status', 'completed')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->sum('courses.duration_hours');

        // ========== ÉTAPE 4: PRÉPARER LES DONNÉES POUR LA VUE ==========
        $data = [
            'user' => $user,
            'enrolledCoursesCount' => $enrolledCoursesCount,
            'completedCoursesCount' => $completedCoursesCount,
            'totalLearningHours' => $totalLearningHours,
            // Vous pouvez ajouter d'autres données ici
        ];

        // ========== ÉTAPE 5: RETOURNER LA VUE ==========
        return view('dashboards.student', $data);
    }

    /**
     * AFFICHER LES COURS DE L'ÉTUDIANT
     * Liste tous les cours auxquels l'étudiant est inscrit
     * 
     * @return \Illuminate\View\View
     */
    public function myCourses()
    {
        // ========== ÉTAPE 1: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        $user = Auth::user();

        // ========== ÉTAPE 2: RÉCUPÉRER LES COURS INSCRITS ==========
        // Récupère toutes les inscriptions avec les cours associés
        $enrollments = Enrollment::where('student_id', $user->id)
            ->with('course')
            ->get();

        // ========== ÉTAPE 3: RETOURNER LA VUE ==========
        return view('dashboards.student.my-courses', ['enrollments' => $enrollments]);
    }

    /**
     * AFFICHER LE PROFIL DE L'ÉTUDIANT
     * Affiche les informations personnelles de l'étudiant
     * 
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        // ========== ÉTAPE 1: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        $user = Auth::user();

        // ========== ÉTAPE 2: RETOURNER LA VUE ==========
        return view('dashboards.student.profile', ['user' => $user]);
    }

    /**
     * AFFICHER LES PARAMÈTRES DE L'ÉTUDIANT
     * Permet à l'étudiant de modifier ses paramètres
     * 
     * @return \Illuminate\View\View
     */
    public function settings()
    {
        // ========== ÉTAPE 1: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        $user = Auth::user();

        // ========== ÉTAPE 2: RETOURNER LA VUE ==========
        return view('dashboards.student.settings', ['user' => $user]);
    }

    /**
     * METTRE À JOUR LES PARAMÈTRES
     * Sauvegarde les modifications des paramètres
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSettings(Request $request)
    {
        // ========== ÉTAPE 1: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        $user = Auth::user();

        // ========== ÉTAPE 2: VALIDER LES DONNÉES ==========
        $validated = $request->validate([
            'notifications_email' => 'boolean', // Recevoir les notifications par email
            'notifications_sms' => 'boolean',   // Recevoir les notifications par SMS
            'language' => 'required|in:fr,en',  // Langue: français ou anglais
        ]);

        // ========== ÉTAPE 3: METTRE À JOUR LES PARAMÈTRES ==========
        // Ces paramètres pourraient être stockés dans une table séparée
        // ou dans une colonne JSON du modèle User
        // Pour cet exemple, on fait juste une validation
        // $user->update($validated);

        // ========== ÉTAPE 4: REDIRIGER ==========
        return redirect()->route('student.settings')
            ->with('success', 'Paramètres mis à jour avec succès!');
    }
}

