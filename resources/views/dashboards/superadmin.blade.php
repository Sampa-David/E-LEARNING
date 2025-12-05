@extends('layouts.base')

@section('title', 'Admin Dashboard - E-Learning')

@section('content')
<!-- ========== MAIN DASHBOARD SECTION ========== -->
<section class="page-section" style="padding: 2rem 0; background: #f8f9fa; min-height: 100vh;">
    <div class="container-fluid">
        <div class="row" style="gap: 0;">
            <!-- ========== SIDEBAR ========== -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; position: sticky; top: 100px;">
                    <!-- Sidebar Header -->
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 2rem 1.5rem;">
                        <div class="text-center text-white">
                            <img src="{{ asset('assets/img/person/person-f-12.webp') }}" alt="Avatar" class="rounded-circle" style="width: 60px; height: 60px; border: 3px solid white; object-fit: cover; margin-bottom: 1rem;">
                            <h5 class="mb-1" style="font-weight: 700;">Admin {{ Auth::user()->name }}</h5>
                            <small style="opacity: 0.9;"><i class="bi bi-shield-check"></i> Administrator</small>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <div class="card-body p-0">
                        <nav style="display: flex; flex-direction: column;">
                            <!-- Dashboard -->
                            <a href="{{ route('superadmin.dashboard') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-speedometer2" style="font-size: 1.1rem;"></i>
                                <span>Dashboard</span>
                            </a>

                            <!-- Users Management -->
                            <a href="{{ route('superadmin.users') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-people" style="font-size: 1.1rem;"></i>
                                <span>Manage Users</span>
                            </a>

                            <!-- Roles Management -->
                            <a href="{{ route('superadmin.roles') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-tags" style="font-size: 1.1rem;"></i>
                                <span>Roles</span>
                            </a>

                            <!-- Permissions Management -->
                            <a href="{{ route('superadmin.permissions') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-key" style="font-size: 1.1rem;"></i>
                                <span>Permissions</span>
                            </a>

                            <!-- Create User -->
                            <a href="{{ route('superadmin.create-user') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-person-plus" style="font-size: 1.1rem;"></i>
                                <span>Create User</span>
                            </a>

                            <!-- Divider -->
                            <div style="margin: 0.5rem 0; border-bottom: 1px solid #eee;"></div>

                            <!-- Settings -->
                            <a href="{{ route('superadmin.settings') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-gear" style="font-size: 1.1rem;"></i>
                                <span>Settings</span>
                            </a>

                            <!-- Home -->
                            <a href="{{ route('home') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-house" style="font-size: 1.1rem;"></i>
                                <span>Home</span>
                            </a>

                            <!-- Logout -->
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

            <!-- ========== MAIN CONTENT ========== -->
            <div class="col-lg-9">
                <!-- Welcome Section -->
                <div class="mb-5" data-aos="fade-up">
                    <h1 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 0.5rem;">Admin Dashboard 🔐</h1>
                    <p class="text-muted">Complete system management for E-Learning platform</p>
                </div>

                <!-- ========== USER STATISTICS ========== -->
                <div class="mb-5" data-aos="fade-up">
                    <h5 class="mb-3" style="font-weight: 600; color: #2c3e50;">User Statistics</h5>
                    <div class="row">
                        <!-- Card 1: Total Users -->
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #667eea;">
                                <div class="card-body p-4">
                                    <h5 class="text-muted mb-3" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Total Users</h5>
                                    <h3 class="fw-700" style="color: #667eea; margin-bottom: 0.5rem;">{{ $totalUsers }}</h3>
                                    <small class="text-muted">All users</small>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Students -->
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #17a2b8;">
                                <div class="card-body p-4">
                                    <h5 class="text-muted mb-3" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Students</h5>
                                    <h3 class="fw-700" style="color: #17a2b8; margin-bottom: 0.5rem;">{{ $totalStudents }}</h3>
                                    <small class="text-muted">Active learners</small>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Teachers -->
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #28a745;">
                                <div class="card-body p-4">
                                    <h5 class="text-muted mb-3" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Teachers</h5>
                                    <h3 class="fw-700" style="color: #28a745; margin-bottom: 0.5rem;">{{ $totalTeachers }}</h3>
                                    <small class="text-muted">Instructors</small>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4: Admins -->
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #ffc107;">
                                <div class="card-body p-4">
                                    <h5 class="text-muted mb-3" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Admins</h5>
                                    <h3 class="fw-700" style="color: #ffc107; margin-bottom: 0.5rem;">{{ $totalAdmins }}</h3>
                                    <small class="text-muted">Super admins</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========== SYSTEM STATISTICS ========== -->
                <div class="mb-5" data-aos="fade-up">
                    <h5 class="mb-3" style="font-weight: 600; color: #2c3e50;">System Statistics</h5>
                    <div class="row">
                        <!-- Card 1: Roles -->
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #764ba2;">
                                <div class="card-body p-4">
                                    <h5 class="text-muted mb-3" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Available Roles</h5>
                                    <h3 class="fw-700" style="color: #764ba2; margin-bottom: 0.5rem;">{{ $totalRoles }}</h3>
                                    <small class="text-muted">Roles configured in system</small>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Permissions -->
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #dc3545;">
                                <div class="card-body p-4">
                                    <h5 class="text-muted mb-3" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Permissions</h5>
                                    <h3 class="fw-700" style="color: #dc3545; margin-bottom: 0.5rem;">{{ $totalPermissions }}</h3>
                                    <small class="text-muted">System permissions</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========== RECENT USERS ========== -->
                <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;" data-aos="fade-up">
                    <!-- Header -->
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 1.5rem 2rem;">
                        <h5 class="text-white mb-0"><i class="bi bi-people"></i> Recent Users</h5>
                    </div>

                    <!-- Body -->
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead style="background: #f8f9fa;">
                                    <tr>
                                        <th style="border: none; color: #2c3e50; font-weight: 600;">Name</th>
                                        <th style="border: none; color: #2c3e50; font-weight: 600;">Email</th>
                                        <th style="border: none; color: #2c3e50; font-weight: 600;">Role</th>
                                        <th style="border: none; color: #2c3e50; font-weight: 600;">Joined</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentUsers as $user)
                                        <tr>
                                            <td style="font-weight: 600; color: #2c3e50;">{{ $user->name }}</td>
                                            <td style="color: #666;">{{ $user->email }}</td>
                                            <td>
                                                <span class="badge" style="background: @switch($user->role)
                                                    @case('student') #667eea @break
                                                    @case('teacher') #17a2b8 @break
                                                    @case('superadmin') #dc3545 @break
                                                    @default #6c757d
                                                @endswitch;">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td style="color: #999;">{{ $user->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                <i class="bi bi-inbox" style="font-size: 2rem; margin-right: 0.5rem;"></i><br>
                                                No users data available.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
