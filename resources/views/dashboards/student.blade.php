@extends('layouts.base')

@section('title', 'Student Dashboard - E-Learning')

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
                            <img src="{{ secure_asset('assets/img/person/person-f-12.webp') }}" alt="Avatar" class="rounded-circle" style="width: 60px; height: 60px; border: 3px solid white; object-fit: cover; margin-bottom: 1rem;">
                            <h5 class="mb-1" style="font-weight: 700;">{{ Auth::user()->name }}</h5>
                            <small style="opacity: 0.9;"><i class="bi bi-mortarboard"></i> Student</small>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <div class="card-body p-0">
                        <nav style="display: flex; flex-direction: column;">
                            <!-- Dashboard -->
                            <a href="{{ route('student.dashboard') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-speedometer2" style="font-size: 1.1rem;"></i>
                                <span>Dashboard</span>
                            </a>

                            <!-- My Courses -->
                            <a href="{{ route('student.my-courses') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-book" style="font-size: 1.1rem;"></i>
                                <span>My Courses</span>
                            </a>

                            <!-- Browse Courses -->
                            <a href="{{ route('courses') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-search" style="font-size: 1.1rem;"></i>
                                <span>Browse Courses</span>
                            </a>

                            <!-- Learning Progress -->
                            <a href="#" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-graph-up" style="font-size: 1.1rem;"></i>
                                <span>Progress</span>
                            </a>

                            <!-- Wishlist -->
                            <a href="#" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-heart" style="font-size: 1.1rem;"></i>
                                <span>Wishlist</span>
                            </a>

                            <!-- Divider -->
                            <div style="margin: 0.5rem 0; border-bottom: 1px solid #eee;"></div>

                            <!-- Profile -->
                            <a href="{{ route('profile') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-person-circle" style="font-size: 1.1rem;"></i>
                                <span>Profile</span>
                            </a>

                            <!-- Settings -->
                            <a href="{{ route('student.settings') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-gear" style="font-size: 1.1rem;"></i>
                                <span>Settings</span>
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
                    <h1 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 0.5rem;">Welcome, {{ Auth::user()->name }}! 👋</h1>
                    <p class="text-muted">Here's your personalized learning dashboard</p>
                </div>

                <!-- ========== STATISTICS CARDS ========== -->
                <div class="row mb-5" data-aos="fade-up">
                    <!-- Card 1: Enrolled Courses -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #667eea;">
                            <div class="card-body p-4">
                                <h5 class="text-muted mb-3" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Enrolled Courses</h5>
                                <h3 class="fw-700" style="color: #667eea; margin-bottom: 0.5rem;">5</h3>
                                <small class="text-muted">Continue learning</small>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Completed Courses -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #28a745;">
                            <div class="card-body p-4">
                                <h5 class="text-muted mb-3" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Completed</h5>
                                <h3 class="fw-700" style="color: #28a745; margin-bottom: 0.5rem;">2</h3>
                                <small class="text-muted">Keep going!</small>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Learning Hours -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #764ba2;">
                            <div class="card-body p-4">
                                <h5 class="text-muted mb-3" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Learning Time</h5>
                                <h3 class="fw-700" style="color: #764ba2; margin-bottom: 0.5rem;">48h</h3>
                                <small class="text-muted">Keep learning!</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========== RECENT COURSES ========== -->
                <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;" data-aos="fade-up">
                    <!-- Header -->
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 1.5rem 2rem;">
                        <h5 class="text-white mb-0"><i class="bi bi-book"></i> Recent Courses</h5>
                    </div>

                    <!-- Body -->
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead style="background: #f8f9fa;">
                                    <tr>
                                        <th style="border: none; color: #2c3e50; font-weight: 600;">Course Title</th>
                                        <th style="border: none; color: #2c3e50; font-weight: 600;">Instructor</th>
                                        <th style="border: none; color: #2c3e50; font-weight: 600;">Progress</th>
                                        <th style="border: none; color: #2c3e50; font-weight: 600;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox" style="font-size: 2rem; margin-right: 0.5rem;"></i><br>
                                            No courses yet. <a href="{{ route('courses') }}" style="color: #667eea; text-decoration: none; font-weight: 600;">Browse courses</a>
                                        </td>
                                    </tr>
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
