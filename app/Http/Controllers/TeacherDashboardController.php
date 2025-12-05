<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * TeacherDashboardController
 * Gère le tableau de bord pour les professeurs/instructeurs
 * 
 * Fonctionnalités:
 * - Afficher les cours créés
 * - Gérer les cours (créer, modifier, supprimer)
 * - Voir les étudiants inscrits
 * - Voir les évaluations des cours
 */
class TeacherDashboardController extends Controller
{
    /**
     * AFFICHER LE TABLEAU DE BORD DU PROFESSEUR
     * Affiche les statistiques globales du professeur
     * 
     * @return \Illuminate\View\View - Vue du dashboard professeur
     */
    public function index()
    {
        // ========== ÉTAPE 1: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        // Auth::user() retourne l'utilisateur authentifié
        $user = Auth::user();

        // ========== ÉTAPE 2: VÉRIFIER QUE L'UTILISATEUR EST UN PROFESSEUR ==========
        // Sécurité supplémentaire: vérifier que l'utilisateur a le rôle "teacher"
        if ($user->role !== 'teacher') {
            // Si ce n'est pas un professeur, retourner une erreur
            return redirect()->route('home')
                ->with('error', 'Accès non autorisé. Vous n\'êtes pas un professeur.');
        }

        // ========== ÉTAPE 3: RÉCUPÉRER LES STATISTIQUES DU PROFESSEUR ==========
        
        // Nombre de cours créés
        $coursesCount = Course::where('teacher_id', $user->id)->count();

        // Nombre d'étudiants totaux inscrits à ses cours
        $studentsCount = Enrollment::whereHas('course', function ($query) use ($user) {
            $query->where('teacher_id', $user->id);
        })->distinct('student_id')->count();

        // Nombre de cours actifs (publiés)
        $activeCoursesCount = Course::where('teacher_id', $user->id)
            ->where('status', 'published')
            ->count();

        // Évaluation moyenne des cours (note moyenne de tous les avis)
        $averageRating = Review::whereHas('course', function ($query) use ($user) {
            $query->where('teacher_id', $user->id);
        })->avg('rating') ?? 0;

        // ========== ÉTAPE 4: PRÉPARER LES DONNÉES POUR LA VUE ==========
        $data = [
            'user' => $user,
            'coursesCount' => $coursesCount,
            'studentsCount' => $studentsCount,
            'activeCoursesCount' => $activeCoursesCount,
            'averageRating' => round($averageRating, 1),
        ];

        // ========== ÉTAPE 5: RETOURNER LA VUE ==========
        return view('dashboards.teacher', $data);
    }

    /**
     * AFFICHER LA LISTE DES COURS DU PROFESSEUR
     * Liste tous les cours créés par ce professeur
     * 
     * @return \Illuminate\View\View
     */
    public function myCourses()
    {
        // ========== ÉTAPE 1: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        $user = Auth::user();

        // ========== ÉTAPE 2: RÉCUPÉRER LES COURS DU PROFESSEUR ==========
        // Récupère tous les cours créés par ce professeur avec les relations
        $courses = Course::where('teacher_id', $user->id)
            ->withCount('enrollments')
            ->withAvg('reviews', 'rating')
            ->paginate(10);

        // ========== ÉTAPE 3: RETOURNER LA VUE ==========
        return view('dashboards.teacher.my-courses', ['courses' => $courses]);
    }

    /**
     * AFFICHER LE FORMULAIRE DE CRÉATION DE COURS
     * Affiche la page pour créer un nouveau cours
     * 
     * @return \Illuminate\View\View
     */
    public function createCourseForm()
    {
        // ========== RETOURNER LA VUE DU FORMULAIRE ==========
        return view('dashboards.teacher.create-course');
    }

    /**
     * CRÉER UN NOUVEAU COURS
     * Valide et sauvegarde un nouveau cours en base de données
     * 
     * @param \Illuminate\Http\Request $request - Contient les données du cours
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCourse(Request $request)
    {
        // ========== ÉTAPE 1: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        $user = Auth::user();

        // ========== ÉTAPE 2: VALIDER LES DONNÉES ==========
        $validated = $request->validate([
            'name' => 'required|string|max:255',           // Titre du cours
            'description' => 'required|string',             // Description détaillée
            'level' => 'required|in:beginner,intermediate,advanced', // Niveau
            'category' => 'required|string|max:100',        // Catégorie
            'cover_image' => 'nullable|image|max:2048',     // Image miniature
            'price' => 'required|numeric|min:0',            // Prix du cours (0 = gratuit)
            'duration_hours' => 'required|numeric|min:0.5', // Durée en heures
        ]);

        // ========== ÉTAPE 3: SAUVEGARDER LE COURS ==========
        $course = new Course();
        $course->teacher_id = $user->id;
        $course->name = $validated['name'];
        $course->description = $validated['description'];
        $course->level = $validated['level'];
        $course->category = $validated['category'];
        $course->price = $validated['price'];
        $course->duration_hours = $validated['duration_hours'];
        $course->status = 'draft'; // Par défaut, le cours est en brouillon
        
        // Traiter l'upload de l'image si présent
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('courses', 'public');
            $course->cover_image = $path;
        }
        
        $course->save();

        // ========== ÉTAPE 4: REDIRIGER ==========
        return redirect()->route('teacher.my-courses')
            ->with('success', 'Cours créé avec succès!');
    }

    /**
     * AFFICHER LES ÉTUDIANTS INSCRITS
     * Liste tous les étudiants inscrits aux cours du professeur
     * 
     * @return \Illuminate\View\View
     */
    public function students()
    {
        // ========== ÉTAPE 1: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        $user = Auth::user();

        // ========== ÉTAPE 2: RÉCUPÉRER LES ÉTUDIANTS INSCRITS ==========
        // Récupère tous les étudiants inscrits aux cours du professeur
        $enrollments = Enrollment::whereHas('course', function ($query) use ($user) {
            $query->where('teacher_id', $user->id);
        })
        ->with(['student', 'course'])
        ->get();

        // ========== ÉTAPE 3: RETOURNER LA VUE ==========
        return view('dashboards.teacher.students', ['enrollments' => $enrollments]);
    }

    /**
     * AFFICHER LES AVIS ET ÉVALUATIONS
     * Affiche les avis et notes données par les étudiants
     * 
     * @return \Illuminate\View\View
     */
    public function reviews()
    {
        // ========== ÉTAPE 1: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        $user = Auth::user();

        // ========== ÉTAPE 2: RÉCUPÉRER LES AVIS DES COURS ==========
        // Récupère tous les avis des cours créés par ce professeur
        $reviews = Review::whereHas('course', function ($query) use ($user) {
            $query->where('teacher_id', $user->id);
        })
        ->with(['student', 'course'])
        ->latest()
        ->paginate(15);

        // ========== ÉTAPE 3: RETOURNER LA VUE ==========
        return view('dashboards.teacher.reviews', ['reviews' => $reviews]);
    }

    /**
     * AFFICHER LES PARAMÈTRES DU PROFESSEUR
     * Permet au professeur de modifier ses paramètres
     * 
     * @return \Illuminate\View\View
     */
    public function settings()
    {
        // ========== ÉTAPE 1: RÉCUPÉRER L'UTILISATEUR CONNECTÉ ==========
        $user = Auth::user();

        // ========== ÉTAPE 2: RETOURNER LA VUE ==========
        return view('dashboards.teacher.settings', ['user' => $user]);
    }

    /**
     * METTRE À JOUR LES PARAMÈTRES
     * Sauvegarde les modifications des paramètres du professeur
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
            'bio' => 'nullable|string|max:500',               // Biographie du professeur
            'specialization' => 'required|string|max:100',    // Domaine de spécialisation
            'notifications_email' => 'boolean',               // Recevoir les notifications
            'language' => 'required|in:fr,en',                // Langue
        ]);

        // ========== ÉTAPE 3: METTRE À JOUR LES PARAMÈTRES ==========
        // $user->update($validated);

        // ========== ÉTAPE 4: REDIRIGER ==========
        return redirect()->route('teacher.settings')
            ->with('success', 'Paramètres mis à jour avec succès!');
    }
}

