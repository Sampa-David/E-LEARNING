<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\SuperAdminDashboardController;

// ========== ROUTES PUBLIQUES (Pas d'authentification requise) ==========

// Page d'accueil
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Liste des cours
Route::get('/courses', function () {
    return view('pages.courses');
})->name('courses');

// Détail d'un cours
Route::get('/course/{id}', function () {
    return view('pages.course-detail');
})->name('course-detail');

// Page de contact
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::post('/contact/submit', function () {
    return redirect()->route('contact')->with('success', 'Message sent successfully!');
})->name('contact.submit');

// Politique de confidentialité
Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

// Conditions d'utilisation
Route::get('/terms-of-service', function () {
    return view('pages.terms-of-service');
})->name('terms-of-service');

// ========== ROUTES D'AUTHENTIFICATION ==========
// Ces routes gèrent la connexion et l'inscription

// Afficher le formulaire de connexion
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest'); // Middleware 'guest': Interdit si déjà connecté

// Traiter la connexion
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post')
    ->middleware('guest');

// Afficher le formulaire d'inscription
Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->name('register')
    ->middleware('guest');

// Traiter l'inscription
Route::post('/register', [AuthController::class, 'register'])
    ->name('register.post')
    ->middleware('guest');

// Déconnexion
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth'); // Middleware 'auth': Requis d'être connecté

// ========== ROUTES UTILISATEUR AUTHENTIFIÉ ==========
// Toutes ces routes requièrent l'authentification (middleware 'auth')

Route::middleware('auth')->group(function () {
    // Profil utilisateur
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    
    // Changer le mot de passe
    Route::post('/password/change', [AuthController::class, 'changePassword'])->name('password.change');

    // ========== DASHBOARD ÉTUDIANT ==========
    // Accessible uniquement par les étudiants (middleware 'check.role:student')
    Route::middleware('check.role:student')->prefix('student')->name('student.')->group(function () {
        // Tableau de bord étudiant
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        
        // Mes cours
        Route::get('/my-courses', [StudentDashboardController::class, 'myCourses'])->name('my-courses');
        
        // Profil (redondant avec /profile mais peut avoir des spécificités)
        Route::get('/profile', [StudentDashboardController::class, 'profile'])->name('profile');
        
        // Paramètres
        Route::get('/settings', [StudentDashboardController::class, 'settings'])->name('settings');
        Route::post('/settings/update', [StudentDashboardController::class, 'updateSettings'])->name('settings.update');
    });

    // ========== DASHBOARD PROFESSEUR ==========
    // Accessible uniquement par les professeurs (middleware 'check.role:teacher')
    Route::middleware('check.role:teacher')->prefix('teacher')->name('teacher.')->group(function () {
        // Tableau de bord professeur
        Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');
        
        // Mes cours
        Route::get('/my-courses', [TeacherDashboardController::class, 'myCourses'])->name('my-courses');
        Route::get('/create-course', [TeacherDashboardController::class, 'createCourseForm'])->name('create-course');
        Route::post('/store-course', [TeacherDashboardController::class, 'storeCourse'])->name('store-course');
        
        // Mes étudiants
        Route::get('/students', [TeacherDashboardController::class, 'students'])->name('students');
        
        // Avis et évaluations
        Route::get('/reviews', [TeacherDashboardController::class, 'reviews'])->name('reviews');
        
        // Paramètres
        Route::get('/settings', [TeacherDashboardController::class, 'settings'])->name('settings');
        Route::post('/settings/update', [TeacherDashboardController::class, 'updateSettings'])->name('settings.update');
    });

    // ========== DASHBOARD SUPERADMIN ==========
    // Accessible uniquement par les superadministrateurs (middleware 'check.role:superadmin')
    Route::middleware('check.role:superadmin')->prefix('superadmin')->name('superadmin.')->group(function () {
        // Tableau de bord superadmin
        Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboard');
        
        // Gestion des utilisateurs
        Route::get('/users', [SuperAdminDashboardController::class, 'users'])->name('users');
        Route::get('/users/create', [SuperAdminDashboardController::class, 'createUserForm'])->name('create-user');
        Route::post('/users/store', [SuperAdminDashboardController::class, 'storeUser'])->name('store-user');
        Route::get('/users/{user}/edit', [SuperAdminDashboardController::class, 'editUserForm'])->name('edit-user');
        Route::put('/users/{user}/update', [SuperAdminDashboardController::class, 'updateUser'])->name('update-user');
        Route::delete('/users/{user}/delete', [SuperAdminDashboardController::class, 'deleteUser'])->name('delete-user');
        
        // Gestion des rôles
        Route::get('/roles', [SuperAdminDashboardController::class, 'roles'])->name('roles');
        Route::post('/roles/{role}/assign-permission', [SuperAdminDashboardController::class, 'assignPermissionToRole'])->name('assign-permission');
        Route::delete('/roles/{role}/revoke-permission/{permission}', [SuperAdminDashboardController::class, 'revokePermissionFromRole'])->name('revoke-permission');
        
        // Gestion des permissions
        Route::get('/permissions', [SuperAdminDashboardController::class, 'permissions'])->name('permissions');
        
        // Paramètres système
        Route::get('/settings', [SuperAdminDashboardController::class, 'settings'])->name('settings');
    });
});
