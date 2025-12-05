@extends('layouts.base')

@section('title', 'Create User - Admin Dashboard')

@section('content')
<section class="page-section" style="padding: 2rem 0; background: #f8f9fa; min-height: 100vh;">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; position: sticky; top: 100px;">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 2rem 1.5rem;">
                        <div class="text-center text-white">
                            <img src="{{ secure_asset('assets/img/person/person-f-12.webp') }}" alt="Avatar" class="rounded-circle" style="width: 60px; height: 60px; border: 3px solid white; object-fit: cover; margin-bottom: 1rem;">
                            <h5 class="mb-1" style="font-weight: 700;">Admin {{ Auth::user()->name }}</h5>
                            <small style="opacity: 0.9;"><i class="bi bi-shield-check"></i> Administrator</small>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <nav style="display: flex; flex-direction: column;">
                            <a href="{{ route('superadmin.dashboard') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-speedometer2" style="font-size: 1.1rem;"></i>
                                <span>Dashboard</span>
                            </a>

                            <a href="{{ route('superadmin.users') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-people" style="font-size: 1.1rem;"></i>
                                <span>Manage Users</span>
                            </a>

                            <a href="{{ route('superadmin.roles') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-tags" style="font-size: 1.1rem;"></i>
                                <span>Roles</span>
                            </a>

                            <a href="{{ route('superadmin.permissions') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-key" style="font-size: 1.1rem;"></i>
                                <span>Permissions</span>
                            </a>

                            <a href="{{ route('superadmin.create-user') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #667eea; background: #f0f2f5; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-person-plus" style="font-size: 1.1rem;"></i>
                                <span>Create User</span>
                            </a>

                            <div style="margin: 0.5rem 0; border-bottom: 1px solid #eee;"></div>

                            <a href="{{ route('superadmin.settings') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-gear" style="font-size: 1.1rem;"></i>
                                <span>Settings</span>
                            </a>

                            <a href="{{ route('home') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-house" style="font-size: 1.1rem;"></i>
                                <span>Home</span>
                            </a>

                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="sidebar-link w-100" style="padding: 1rem 1.5rem; border: none; text-decoration: none; color: #dc3545; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem; background: none; cursor: pointer; text-align: left;">
                                    <i class="bi bi-box-arrow-right" style="font-size: 1.1rem;"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="mb-5">
                    <h1 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 0.5rem;">Create User ➕</h1>
                    <p class="text-muted">Add a new user to the system</p>
                </div>

                <!-- Create User Form -->
                <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 1.5rem 2rem;">
                        <h5 class="text-white mb-0"><i class="bi bi-person-plus"></i> New User Form</h5>
                    </div>

                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('superadmin.store-user') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label" style="font-weight: 600; color: #2c3e50;">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="John Doe" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label" style="font-weight: 600; color: #2c3e50;">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="john@example.com" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label" style="font-weight: 600; color: #2c3e50;">Password</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div class="mb-3">
                                <label for="role" class="form-label" style="font-weight: 600; color: #2c3e50;">Role</label>
                                <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                                    <option value="">Select a role</option>
                                    <option value="student">Student</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="superadmin">Admin</option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                                    <i class="bi bi-check-circle"></i> Create User
                                </button>
                                <a href="{{ route('superadmin.users') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .sidebar-link:hover {
        background: #f0f2f5;
        color: #667eea !important;
        padding-left: 1.75rem;
    }

    .sidebar-link:hover i {
        color: #667eea;
    }
</style>
@endsection
