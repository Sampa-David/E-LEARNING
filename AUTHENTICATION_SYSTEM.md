# Système d'Authentification et Autorisation - E-Learning Platform

## 📋 Vue d'ensemble

Ce système complet d'authentification et d'autorisation pour Laravel 12 fournit:

- **Authentification**: Connexion, inscription, déconnexion
- **Système de Rôles Personnalisé**: Student, Teacher, SuperAdmin
- **Système de Permissions**: Permissions granulaires assignées aux rôles
- **Trois Dashboards**: Un pour chaque type d'utilisateur
- **Middleware de Sécurité**: CheckRole et CheckPermission

## 🔐 Architecture

### Modèles
- **User** - L'utilisateur avec rôle
- **Role** - Les rôles (student, teacher, superadmin)
- **Permission** - Les permissions (view_courses, create_course, etc.)

### Tables Pivot
- **role_permissions** - Relation many-to-many entre rôles et permissions

### Contrôleurs
- **AuthController** - Gère l'authentification
- **StudentDashboardController** - Dashboard étudiant
- **TeacherDashboardController** - Dashboard professeur
- **SuperAdminDashboardController** - Dashboard administrateur

### Middleware
- **CheckRole** - Vérifie le rôle de l'utilisateur
- **CheckPermission** - Vérifie les permissions de l'utilisateur

## 🚀 Installation et Configuration

### 1. Lancer les Migrations

Exécutez les migrations pour créer les tables:

```bash
php artisan migrate
```

Cela créera les tables suivantes:
- `users` - Utilisateurs
- `roles` - Rôles
- `permissions` - Permissions
- `role_permissions` - Pivot table

### 2. Lancer les Seeders

Semblez la base de données avec les données initiales:

```bash
php artisan db:seed
```

Cela créera:
- **Rôles**: student, teacher, superadmin
- **Permissions**: 20+ permissions différentes
- **Assignations**: Les permissions sont assignées à chaque rôle
- **Utilisateurs de test**:
  - Admin: admin@elearning.com / password
  - Student: student@elearning.com / password
  - Teacher: teacher@elearning.com / password

### 3. Configuration des Middleware

Les middlewares sont déjà configurés dans `bootstrap/app.php`:

```php
$middleware->alias([
    'check.role' => \App\Http\Middleware\CheckRole::class,
    'check.permission' => \App\Http\Middleware\CheckPermission::class,
]);
```

## 📝 Utilisation

### Routes d'Authentification

```php
// Connexion
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Inscription
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Déconnexion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profil
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
Route::post('/password/change', [AuthController::class, 'changePassword'])->name('password.change');
```

### Routes Protégées par Rôle

```php
// Seuls les étudiants peuvent accéder
Route::middleware('check.role:student')->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index']);
});

// Seuls les professeurs peuvent accéder
Route::middleware('check.role:teacher')->group(function () {
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index']);
});

// Seuls les superadmins peuvent accéder
Route::middleware('check.role:superadmin')->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminDashboardController::class, 'index']);
});
```

### Routes Protégées par Permission

```php
// Seuls les utilisateurs avec la permission 'create_course' peuvent accéder
Route::middleware('check.permission:create_course')->group(function () {
    Route::post('/courses', [CourseController::class, 'store']);
});

// Avec plusieurs permissions (l'utilisateur doit avoir au moins une des permissions)
Route::middleware('check.permission:edit_course,delete_course')->group(function () {
    Route::put('/courses/{id}', [CourseController::class, 'update']);
});
```

## 🔑 Permissions Disponibles

### Permissions Cours
- `view_courses` - Voir les cours
- `create_course` - Créer un cours
- `edit_course` - Modifier un cours
- `delete_course` - Supprimer un cours

### Permissions Leçons
- `view_lessons` - Voir les leçons
- `create_lesson` - Créer une leçon
- `edit_lesson` - Modifier une leçon
- `delete_lesson` - Supprimer une leçon

### Permissions Inscription
- `enroll_course` - S'inscrire aux cours
- `unenroll_course` - Se désinscrire des cours

### Permissions Utilisateurs
- `view_users` - Voir les utilisateurs
- `create_user` - Créer un utilisateur
- `edit_user` - Modifier un utilisateur
- `delete_user` - Supprimer un utilisateur

### Permissions Administration
- `access_admin_dashboard` - Accès au dashboard admin
- `manage_roles` - Gérer les rôles
- `manage_permissions` - Gérer les permissions

### Permissions Avis
- `view_reviews` - Voir les avis
- `create_review` - Créer un avis
- `edit_review` - Modifier un avis
- `delete_review` - Supprimer un avis

## 👥 Rôles et Leurs Permissions

### Student (Étudiant)
- view_courses
- view_lessons
- enroll_course
- unenroll_course
- view_reviews
- create_review
- edit_review

### Teacher (Professeur)
- view_courses
- create_course
- edit_course
- delete_course
- view_lessons
- create_lesson
- edit_lesson
- delete_lesson
- view_reviews
- view_users

### SuperAdmin (Administrateur)
- **TOUTES LES PERMISSIONS**

## 💻 Vérifier les Permissions dans le Code

### Dans un Contrôleur

```php
$user = Auth::user();

// Vérifier le rôle
if ($user->isStudent()) {
    // L'utilisateur est étudiant
}

if ($user->isTeacher()) {
    // L'utilisateur est professeur
}

if ($user->isSuperAdmin()) {
    // L'utilisateur est superadmin
}

// Vérifier une permission
if ($user->hasPermission('create_course')) {
    // L'utilisateur peut créer un cours
}
```

### Dans une Vue Blade

```blade
@if ($user->isStudent())
    <p>Contenu pour les étudiants</p>
@endif

@if ($user->hasPermission('create_course'))
    <a href="{{ route('courses.create') }}">Créer un cours</a>
@endif

@if ($user->isSuperAdmin())
    <a href="{{ route('superadmin.dashboard') }}">Admin</a>
@endif
```

## 📊 Dashboards

### Dashboard Étudiant
- Vue des cours inscrits
- Progression des cours
- Statistiques d'apprentissage
- Accès aux paramètres

**Route**: `/student/dashboard`

### Dashboard Professeur
- Gestion des cours créés
- Vue des étudiants inscrits
- Avis et évaluations
- Statistiques des cours

**Route**: `/teacher/dashboard`

### Dashboard SuperAdmin
- Gestion de tous les utilisateurs
- Gestion des rôles
- Gestion des permissions
- Paramètres système
- Statistiques globales

**Route**: `/superadmin/dashboard`

## 🔒 Sécurité

### Password Hashing
Les mots de passe sont automatiquement hashés avec `Hash::make()` et stockés en sécurité.

### CSRF Protection
Tous les formulaires incluent un token CSRF via `@csrf` pour prévenir les attaques CSRF.

### Session Management
- Les sessions sont invalidées à la déconnexion
- Les IDs de session sont régénérés après connexion
- Support du "Se souvenir de moi"

### Role-Based Access Control (RBAC)
Les routes sont protégées par middleware pour garantir que seuls les utilisateurs avec les bons rôles y accèdent.

## 📚 Fichiers Créés

### Contrôleurs
- `app/Http/Controllers/AuthController.php`
- `app/Http/Controllers/StudentDashboardController.php`
- `app/Http/Controllers/TeacherDashboardController.php`
- `app/Http/Controllers/SuperAdminDashboardController.php`

### Modèles
- `app/Models/User.php` (modifié)
- `app/Models/Role.php`
- `app/Models/Permission.php`

### Middleware
- `app/Http/Middleware/CheckRole.php`
- `app/Http/Middleware/CheckPermission.php`

### Migrations
- `database/migrations/2024_01_01_000003_create_roles_table.php`
- `database/migrations/2024_01_01_000004_create_permissions_table.php`
- `database/migrations/2024_01_01_000005_create_role_permissions_table.php`

### Seeders
- `database/seeders/RoleSeeder.php`
- `database/seeders/PermissionSeeder.php`
- `database/seeders/AssignPermissionsSeeder.php`
- `database/seeders/DatabaseSeeder.php` (modifié)

### Vues
- `resources/views/auth/login.blade.php`
- `resources/views/auth/register.blade.php`
- `resources/views/auth/profile.blade.php`
- `resources/views/dashboards/student.blade.php`
- `resources/views/dashboards/teacher.blade.php`
- `resources/views/dashboards/superadmin.blade.php`

### Routes
- `routes/web.php` (modifié)

### Configuration
- `bootstrap/app.php` (modifié)

## 🧪 Tester le Système

### Connexion avec le Compte Admin
1. Allez à `http://127.0.0.1:8000/login`
2. Email: `admin@elearning.com`
3. Password: `password`
4. Vous serez redirigé vers `/superadmin/dashboard`

### Connexion avec le Compte Étudiant
1. Email: `student@elearning.com`
2. Password: `password`
3. Vous serez redirigé vers `/student/dashboard`

### Connexion avec le Compte Professeur
1. Email: `teacher@elearning.com`
2. Password: `password`
3. Vous serez redirigé vers `/teacher/dashboard`

## ✅ Checklist de Mise en Place

- [ ] Lancer `php artisan migrate`
- [ ] Lancer `php artisan db:seed`
- [ ] Tester la connexion avec les comptes de test
- [ ] Vérifier les trois dashboards
- [ ] Tester les routes protégées
- [ ] Tester les changements de profil
- [ ] Tester le changement de mot de passe
- [ ] Tester la gestion des utilisateurs (SuperAdmin)
- [ ] Vérifier les permissions

## 🤝 Support et Contribution

Ce système d'authentification est prêt pour la production mais peut être étendu avec:

- **OAuth/Social Login** (Google, Facebook, GitHub)
- **Two-Factor Authentication (2FA)**
- **Email Verification**
- **Password Reset**
- **Activity Logging**
- **Audit Trail**

---

**Créé pour la plateforme E-Learning Laravel 12**
