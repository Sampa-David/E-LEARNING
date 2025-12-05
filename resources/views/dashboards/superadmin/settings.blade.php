@extends('layouts.base')

@section('title', 'Settings - Admin Dashboard')

@section('content')
<section class="page-section" style="padding: 2rem 0; background: #f8f9fa; min-height: 100vh;">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; position: sticky; top: 100px;">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 2rem 1.5rem;">
                        <div class="text-center text-white">
                            <img src="{{ asset('assets/img/person/person-f-12.webp') }}" alt="Avatar" class="rounded-circle" style="width: 60px; height: 60px; border: 3px solid white; object-fit: cover; margin-bottom: 1rem;">
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

                            <a href="{{ route('superadmin.create-user') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-person-plus" style="font-size: 1.1rem;"></i>
                                <span>Create User</span>
                            </a>

                            <div style="margin: 0.5rem 0; border-bottom: 1px solid #eee;"></div>

                            <a href="{{ route('superadmin.settings') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #667eea; background: #f0f2f5; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
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
                    <h1 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 0.5rem;">System Settings ⚙️</h1>
                    <p class="text-muted">Configure system-wide settings and preferences</p>
                </div>

                <!-- Settings Cards -->
                <div class="row">
                    <!-- Site Information -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-lg" style="border-radius: 12px; border-left: 4px solid #667eea;">
                            <div class="card-body p-4">
                                <h5 style="font-weight: 700; color: #2c3e50; margin-bottom: 1.5rem;">
                                    <i class="bi bi-info-circle"></i> Site Information
                                </h5>
                                <div class="mb-3">
                                    <label class="text-muted small">Site Name</label>
                                    <p style="font-weight: 600; color: #2c3e50;">E-Learning Platform</p>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small">Version</label>
                                    <p style="font-weight: 600; color: #2c3e50;">1.0.0</p>
                                </div>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Email Configuration -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-lg" style="border-radius: 12px; border-left: 4px solid #17a2b8;">
                            <div class="card-body p-4">
                                <h5 style="font-weight: 700; color: #2c3e50; margin-bottom: 1.5rem;">
                                    <i class="bi bi-envelope"></i> Email Configuration
                                </h5>
                                <div class="mb-3">
                                    <label class="text-muted small">SMTP Server</label>
                                    <p style="font-weight: 600; color: #2c3e50;">smtp.gmail.com</p>
                                </div>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Database -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-lg" style="border-radius: 12px; border-left: 4px solid #28a745;">
                            <div class="card-body p-4">
                                <h5 style="font-weight: 700; color: #2c3e50; margin-bottom: 1.5rem;">
                                    <i class="bi bi-database"></i> Database
                                </h5>
                                <div class="mb-3">
                                    <label class="text-muted small">Type</label>
                                    <p style="font-weight: 600; color: #2c3e50;">PostgreSQL</p>
                                </div>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Security -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-lg" style="border-radius: 12px; border-left: 4px solid #ffc107;">
                            <div class="card-body p-4">
                                <h5 style="font-weight: 700; color: #2c3e50; margin-bottom: 1.5rem;">
                                    <i class="bi bi-shield-lock"></i> Security
                                </h5>
                                <div class="mb-3">
                                    <label class="text-muted small">SSL Enabled</label>
                                    <p style="font-weight: 600; color: #2c3e50;">
                                        <span class="badge bg-success">Yes</span>
                                    </p>
                                </div>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                            </div>
                        </div>
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
