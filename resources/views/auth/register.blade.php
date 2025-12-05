@extends('layouts.base')

@section('title', 'Register - E-Learning')

@section('content')
<!-- ========== SECTION: FORMULAIRE D'INSCRIPTION ========== -->
<section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: auto;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <!-- Carte du formulaire d'inscription -->
                <div class="card shadow-lg border-0" style="border-radius: 15px; overflow: hidden;">
                    <!-- En-tête coloré -->
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 2rem;">
                        <h3 class="text-white mb-0 text-center">
                            <i class="bi bi-person-plus"></i> Create Account
                        </h3>
                        <p class="text-white-50 text-center mb-0 mt-2" style="font-size: 0.9rem;">Join our learning community today</p>
                    </div>

                    <!-- Corps de la carte -->
                    <div class="card-body p-4">
                        <!-- Messages d'erreur -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px; border: 1px solid #f5c6cb;">
                                <i class="bi bi-exclamation-circle-fill"></i> <strong>Registration Error</strong>
                                @foreach ($errors->all() as $error)
                                    <div style="font-size: 0.9rem; margin-top: 5px;">{{ $error }}</div>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Formulaire d'inscription -->
                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <!-- LIGNE 1: Prénom et Nom -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label fw-600" style="color: #2c3e50;">First Name</label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('name') is-invalid @enderror" 
                                        id="name" 
                                        name="name" 
                                        value="{{ old('name') }}" 
                                        required 
                                        placeholder="John"
                                        style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px;"
                                    >
                                    @error('name')
                                        <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="surname" class="form-label fw-600" style="color: #2c3e50;">Last Name</label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('surname') is-invalid @enderror" 
                                        id="surname" 
                                        name="surname" 
                                        value="{{ old('surname') }}" 
                                        required 
                                        placeholder="Doe"
                                        style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px;"
                                    >
                                    @error('surname')
                                        <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nom d'utilisateur -->
                            <div class="mb-3">
                                <label for="username" class="form-label fw-600" style="color: #2c3e50;">Username</label>
                                <input 
                                    type="text" 
                                    class="form-control @error('username') is-invalid @enderror" 
                                    id="username" 
                                    name="username" 
                                    value="{{ old('username') }}" 
                                    required 
                                    placeholder="johndoe123"
                                    style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px;"
                                >
                                @error('username')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-600" style="color: #2c3e50;">Email Address</label>
                                <input 
                                    type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    placeholder="john@example.com"
                                    style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px;"
                                >
                                @error('email')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mot de passe et Confirmation -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-600" style="color: #2c3e50;">Password</label>
                                    <input 
                                        type="password" 
                                        class="form-control @error('password') is-invalid @enderror" 
                                        id="password" 
                                        name="password" 
                                        required 
                                        placeholder="••••••••"
                                        style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px;"
                                    >
                                    @error('password')
                                        <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label fw-600" style="color: #2c3e50;">Confirm Password</label>
                                    <input 
                                        type="password" 
                                        class="form-control @error('password_confirmation') is-invalid @enderror" 
                                        id="password_confirmation" 
                                        name="password_confirmation" 
                                        required 
                                        placeholder="••••••••"
                                        style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px;"
                                    >
                                    @error('password_confirmation')
                                        <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Genre et Date de naissance -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="sexe" class="form-label fw-600" style="color: #2c3e50;">Gender</label>
                                    <select 
                                        class="form-select @error('sexe') is-invalid @enderror" 
                                        id="sexe" 
                                        name="sexe" 
                                        required
                                        style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px;"
                                    >
                                        <option value="">-- Select --</option>
                                        <option value="masculin" {{ old('sexe') === 'masculin' ? 'selected' : '' }}>Male</option>
                                        <option value="feminin" {{ old('sexe') === 'feminin' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    @error('sexe')
                                        <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="Birth_day" class="form-label fw-600" style="color: #2c3e50;">Date of Birth</label>
                                    <input 
                                        type="date" 
                                        class="form-control @error('Birth_day') is-invalid @enderror" 
                                        id="Birth_day" 
                                        name="Birth_day" 
                                        value="{{ old('Birth_day') }}" 
                                        required
                                        style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px;"
                                    >
                                    @error('Birth_day')
                                        <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Ville et Pays -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="town" class="form-label fw-600" style="color: #2c3e50;">City</label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('town') is-invalid @enderror" 
                                        id="town" 
                                        name="town" 
                                        value="{{ old('town') }}" 
                                        required 
                                        placeholder="Paris"
                                        style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px;"
                                    >
                                    @error('town')
                                        <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="country" class="form-label fw-600" style="color: #2c3e50;">Country</label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('country') is-invalid @enderror" 
                                        id="country" 
                                        name="country" 
                                        value="{{ old('country') }}" 
                                        required 
                                        placeholder="France"
                                        style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px;"
                                    >
                                    @error('country')
                                        <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Téléphone -->
                            <div class="mb-4">
                                <label for="phone" class="form-label fw-600" style="color: #2c3e50;">Phone Number</label>
                                <input 
                                    type="tel" 
                                    class="form-control @error('phone') is-invalid @enderror" 
                                    id="phone" 
                                    name="phone" 
                                    value="{{ old('phone') }}" 
                                    required 
                                    placeholder="+33 6 12 34 56 78"
                                    style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px;"
                                >
                                @error('phone')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Bouton de soumission -->
                            <button type="submit" class="btn w-100 py-3 fw-600" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; font-size: 1rem; transition: all 0.3s;">
                                <i class="bi bi-person-plus"></i> Create Account
                            </button>
                        </form>

                        <!-- Divider -->
                        <div style="display: flex; align-items: center; gap: 10px; margin: 1.5rem 0;">
                            <div style="flex: 1; height: 1px; background: #ddd;"></div>
                            <span style="color: #999; font-size: 0.85rem;">EXISTING USER?</span>
                            <div style="flex: 1; height: 1px; background: #ddd;"></div>
                        </div>

                        <!-- Login Link -->
                        <p class="text-center mb-0">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary w-100" style="border-radius: 8px; padding: 10px;">
                                <i class="bi bi-box-arrow-in-right"></i> Sign In
                            </a>
                        </p>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer bg-light border-top-0" style="padding: 1rem; text-align: center;">
                        <a href="{{ route('home') }}" class="text-muted small" style="text-decoration: none;">
                            <i class="bi bi-arrow-left"></i> Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
