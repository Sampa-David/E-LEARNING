@extends('layouts.base')

@section('title', 'Mon Profil - ' . $user->name)

@section('content')
<!-- ========== SECTION: PROFIL UTILISATEUR ========== -->
<div class="container mt-5">
    <div class="row">
        <!-- COLONNE 1: Informations du Profil -->
        <div class="col-md-8">
            <!-- Carte: Informations Personnelles -->
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user-circle"></i> Profil Personnel</h5>
                </div>
                <div class="card-body">
                    <!-- Afficher les messages de succès -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Informations de base -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Prénom:</strong> {{ $user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Nom:</strong> {{ $user->surname }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Nom d'utilisateur:</strong> {{ $user->username }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Rôle:</strong> 
                                <span class="badge bg-info">{{ ucfirst($user->role) }}</span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Genre:</strong> {{ ucfirst($user->sexe) }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Date de naissance:</strong> {{ $user->Birth_day }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Téléphone:</strong> {{ $user->phone }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Ville:</strong> {{ $user->town }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Pays:</strong> {{ $user->country }}</p>
                        </div>
                    </div>

                    <!-- Bouton: Modifier le profil -->
                    <a href="#editProfile" class="btn btn-primary" data-bs-toggle="collapse">
                        <i class="fas fa-edit"></i> Modifier le Profil
                    </a>

                    <!-- Formulaire: Modifier le profil (caché par défaut) -->
                    <div class="collapse mt-4" id="editProfile">
                        <div class="card card-body border-primary">
                            <h6 class="mb-3">Modifier vos Informations</h6>
                            
                            <!-- Formulaire de modification -->
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="surname" class="form-label">Nom</label>
                                        <input type="text" class="form-control" name="surname" value="{{ $user->surname }}" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="town" class="form-label">Ville</label>
                                        <input type="text" class="form-control" name="town" value="{{ $user->town }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="country" class="form-label">Pays</label>
                                        <input type="text" class="form-control" name="country" value="{{ $user->country }}" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control" name="phone" value="{{ $user->phone }}" required>
                                </div>

                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Enregistrer les modifications
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carte: Sécurité - Changer le mot de passe -->
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-lock"></i> Sécurité</h5>
                </div>
                <div class="card-body">
                    <!-- Bouton: Changer le mot de passe -->
                    <a href="#changePassword" class="btn btn-danger" data-bs-toggle="collapse">
                        <i class="fas fa-key"></i> Changer le Mot de Passe
                    </a>

                    <!-- Formulaire: Changer le mot de passe (caché par défaut) -->
                    <div class="collapse mt-4" id="changePassword">
                        <div class="card card-body border-danger">
                            <h6 class="mb-3">Changer votre Mot de Passe</h6>
                            
                            <!-- Afficher les erreurs de validation -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Formulaire de changement de mot de passe -->
                            <form action="{{ route('password.change') }}" method="POST">
                                @csrf

                                <!-- Ancien mot de passe -->
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Mot de passe actuel</label>
                                    <input 
                                        type="password" 
                                        class="form-control @error('current_password') is-invalid @enderror" 
                                        name="current_password" 
                                        required
                                    >
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Nouveau mot de passe -->
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">Nouveau mot de passe</label>
                                    <input 
                                        type="password" 
                                        class="form-control @error('new_password') is-invalid @enderror" 
                                        name="new_password" 
                                        required
                                    >
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirmation du nouveau mot de passe -->
                                <div class="mb-3">
                                    <label for="new_password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        name="new_password_confirmation" 
                                        required
                                    >
                                </div>

                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-check"></i> Mettre à jour le mot de passe
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- COLONNE 2: Raccourcis et Actions -->
        <div class="col-md-4">
            <!-- Carte: Actions -->
            <div class="card shadow mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-tasks"></i> Actions Rapides</h5>
                </div>
                <div class="card-body">
                    <!-- Liste de boutons d'actions -->
                    <div class="d-grid gap-2">
                        @if($user->role === 'student')
                            <!-- Actions pour les étudiants -->
                            <a href="{{ route('student.dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-chart-line"></i> Mon Tableau de Bord
                            </a>
                            <a href="{{ route('student.my-courses') }}" class="btn btn-primary">
                                <i class="fas fa-book"></i> Mes Cours
                            </a>
                            <a href="{{ route('courses') }}" class="btn btn-outline-primary">
                                <i class="fas fa-search"></i> Parcourir les Cours
                            </a>
                        @elseif($user->role === 'teacher')
                            <!-- Actions pour les professeurs -->
                            <a href="{{ route('teacher.dashboard') }}" class="btn btn-success">
                                <i class="fas fa-chart-line"></i> Mon Tableau de Bord
                            </a>
                            <a href="{{ route('teacher.my-courses') }}" class="btn btn-success">
                                <i class="fas fa-book"></i> Mes Cours
                            </a>
                            <a href="{{ route('teacher.create-course') }}" class="btn btn-outline-success">
                                <i class="fas fa-plus"></i> Créer un Cours
                            </a>
                        @elseif($user->role === 'superadmin')
                            <!-- Actions pour les superadmins -->
                            <a href="{{ route('superadmin.dashboard') }}" class="btn btn-danger">
                                <i class="fas fa-chart-line"></i> Tableau de Bord Admin
                            </a>
                            <a href="{{ route('superadmin.users') }}" class="btn btn-danger">
                                <i class="fas fa-users"></i> Gérer les Utilisateurs
                            </a>
                            <a href="{{ route('superadmin.roles') }}" class="btn btn-outline-danger">
                                <i class="fas fa-tasks"></i> Gérer les Rôles
                            </a>
                        @endif

                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-home"></i> Accueil
                        </a>
                    </div>
                </div>
            </div>

            <!-- Carte: Informations du Compte -->
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informations</h5>
                </div>
                <div class="card-body small">
                    <!-- Date d'inscription -->
                    <p><strong>Inscrit depuis:</strong></p>
                    <p class="text-muted">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                    
                    <!-- Dernière modification -->
                    <p><strong>Dernière modification:</strong></p>
                    <p class="text-muted">{{ $user->updated_at->format('d/m/Y H:i') }}</p>

                    <!-- ID de l'utilisateur -->
                    <p><strong>ID du Compte:</strong></p>
                    <p class="text-muted">#{{ $user->id }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
