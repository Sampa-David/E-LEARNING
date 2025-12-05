@extends('layouts.base')

@section('title', 'Teacher Dashboard - E-Learning')

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
                            <h5 class="mb-1" style="font-weight: 700;">Prof. {{ Auth::user()->name }}</h5>
                            <small style="opacity: 0.9;"><i class="bi bi-person-badge"></i> Teacher</small>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <div class="card-body p-0">
                        <nav style="display: flex; flex-direction: column;">
                            <!-- Dashboard -->
                            <a href="{{ route('teacher.dashboard') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-speedometer2" style="font-size: 1.1rem;"></i>
                                <span>Dashboard</span>
                            </a>

                            <!-- My Courses -->
                            <a href="{{ route('teacher.my-courses') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-book" style="font-size: 1.1rem;"></i>
                                <span>My Courses</span>
                            </a>

                            <!-- Create Course -->
                            <a href="{{ route('teacher.create-course') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-plus-circle" style="font-size: 1.1rem;"></i>
                                <span>Create Course</span>
                            </a>

                            <!-- Students -->
                            <a href="{{ route('teacher.students') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-people" style="font-size: 1.1rem;"></i>
                                <span>My Students</span>
                            </a>

                            <!-- Reviews -->
                            <a href="{{ route('teacher.reviews') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-star" style="font-size: 1.1rem;"></i>
                                <span>Reviews</span>
                            </a>

                            <!-- Divider -->
                            <div style="margin: 0.5rem 0; border-bottom: 1px solid #eee;"></div>

                            <!-- Profile -->
                            <a href="{{ route('profile') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
                                <i class="bi bi-person-circle" style="font-size: 1.1rem;"></i>
                                <span>Profile</span>
                            </a>

                            <!-- Settings -->
                            <a href="{{ route('teacher.settings') }}" class="sidebar-link" style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; text-decoration: none; color: #555; transition: all 0.3s; display: flex; align-items: center; gap: 0.75rem;">
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
                    <h1 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 0.5rem;">Welcome, Prof. {{ Auth::user()->name }}! 👨‍🏫</h1>
                    <p class="text-muted">Manage your courses and track your students</p>
                </div>

                <!-- ========== STATISTICS CARDS ========== -->
                <div class="row mb-5" data-aos="fade-up">
                    <!-- Card 1: Courses Created -->
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #667eea;">
                            <div class="card-body p-4">
                                <h5 class="text-muted mb-3" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Courses Created</h5>
                                <h3 class="fw-700" style="color: #667eea; margin-bottom: 0.5rem;">5</h3>
                                <small class="text-muted">Total courses</small>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Active Courses -->
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #ffc107;">
                            <div class="card-body p-4">
                                <h5 class="text-muted mb-3" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Active Courses</h5>
                                <h3 class="fw-700" style="color: #ffc107; margin-bottom: 0.5rem;">3</h3>
                                <small class="text-muted">Currently running</small>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Total Students -->
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #28a745;">
                            <div class="card-body p-4">
                                <h5 class="text-muted mb-3" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Students</h5>
                                <h3 class="fw-700" style="color: #28a745; margin-bottom: 0.5rem;">145</h3>
                                <small class="text-muted">Enrolled</small>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Average Rating -->
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #764ba2;">
                            <div class="card-body p-4">
                                <h5 class="text-muted mb-3" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Rating</h5>
                                <h3 class="fw-700" style="color: #764ba2; margin-bottom: 0.5rem;">4.8/5 ⭐</h3>
                                <small class="text-muted">Average rating</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========== MY COURSES ========== -->
                <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;" data-aos="fade-up">
                    <!-- Header -->
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 1.5rem 2rem;">
                        <h5 class="text-white mb-0"><i class="bi bi-book"></i> My Courses</h5>
                    </div>

                    <!-- Body -->
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead style="background: #f8f9fa;">
                                    <tr>
                                        <th style="border: none; color: #2c3e50; font-weight: 600;">Course Title</th>
                                        <th style="border: none; color: #2c3e50; font-weight: 600;">Level</th>
                                        <th style="border: none; color: #2c3e50; font-weight: 600;">Students</th>
                                        <th style="border: none; color: #2c3e50; font-weight: 600;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox" style="font-size: 2rem; margin-right: 0.5rem;"></i><br>
                                            No courses created yet. <a href="{{ route('teacher.create-course') }}" style="color: #667eea; text-decoration: none; font-weight: 600;">Create your first course</a>
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
    </div>
</div>
@endsection
