@extends('layouts.base')

@section('title', 'Login - E-Learning')

@section('content')
<!-- ========== PAGE SECTION: LOGIN ========== -->
<section class="page-section" style="min-height: calc(100vh - 200px); display: flex; align-items: center;">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
                <!-- Carte du formulaire de connexion -->
                <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                    <!-- En-tête -->
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 2.5rem 2rem;">
                        <h2 class="text-white mb-1 text-center">Sign In</h2>
                        <p class="text-white-50 text-center mb-0" style="font-size: 0.95rem;">Welcome back to our platform</p>
                    </div>

                    <!-- Corps de la carte -->
                    <div class="card-body p-4">
                        <!-- Messages d'erreur -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px; border: 1px solid #f5c6cb;">
                                <i class="bi bi-exclamation-circle-fill"></i> <strong>Login Failed</strong>
                                @foreach ($errors->all() as $error)
                                    <div style="font-size: 0.9rem; margin-top: 5px;">{{ $error }}</div>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Messages de succès -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px; border: 1px solid #d4edda;">
                                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Formulaire -->
                        <form action="{{ route('login') }}" method="POST" class="needs-validation">
                            @csrf

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-600" style="color: #2c3e50;">
                                    <i class="bi bi-envelope"></i> Email Address
                                </label>
                                <input 
                                    type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    placeholder="your@email.com"
                                    style="padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem;"
                                >
                                @error('email')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-600" style="color: #2c3e50;">
                                    <i class="bi bi-lock"></i> Password
                                </label>
                                <input 
                                    type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    id="password" 
                                    name="password" 
                                    required 
                                    placeholder="••••••••"
                                    style="padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem;"
                                >
                                @error('password')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-4 form-check">
                                <input 
                                    type="checkbox" 
                                    class="form-check-input" 
                                    id="remember" 
                                    name="remember"
                                    style="border-radius: 4px; cursor: pointer; width: 18px; height: 18px;"
                                >
                                <label class="form-check-label" for="remember" style="color: #555; cursor: pointer;">
                                    Remember me
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn w-100 py-2 fw-600" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                                <i class="bi bi-box-arrow-in-right"></i> Sign In
                            </button>
                        </form>

                        <!-- Divider -->
                        <div style="display: flex; align-items: center; gap: 10px; margin: 1.5rem 0;">
                            <div style="flex: 1; height: 1px; background: #ddd;"></div>
                            <span style="color: #999; font-size: 0.85rem;">NEW USER?</span>
                            <div style="flex: 1; height: 1px; background: #ddd;"></div>
                        </div>

                        <!-- Register Link -->
                        <p class="text-center mb-0">
                            <a href="{{ route('register') }}" class="btn btn-outline-primary w-100" style="border-radius: 8px; padding: 10px;">
                                <i class="bi bi-person-plus"></i> Create an Account
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
