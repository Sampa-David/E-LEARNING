@extends('layouts.base')
@section('title', 'My Courses - E-Learning')
@section('content')
<!-- ========== PAGE SECTION: MY COURSES ========== -->
<section class="page-section" style="padding: 3rem 0;">
  <div class="container" data-aos="fade-up">
    <div class="mb-5">
      <h1 class="page-title mb-2" style="font-size: 2.5rem; font-weight: 700; color: #2c3e50;">My Learning</h1>
      <p class="lead text-muted" style="font-size: 1.1rem;">Continue learning from where you left off</p>
    </div>
    
    <div class="row mt-4 gy-4">
      <!-- Course Card 1 -->
      <div class="col-lg-6">
        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
          <div class="row g-0">
            <div class="col-md-4" style="overflow: hidden;">
              <img src="{{ asset('assets/img/education/education-4.webp') }}" alt="Course" class="img-fluid h-100" style="object-fit: cover;">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title fw-700" style="color: #2c3e50;">Web Development Fundamentals</h5>
                <p class="text-muted mb-2" style="font-size: 0.9rem;"><i class="bi bi-person"></i> By John Smith</p>
                
                <!-- Progress Bar -->
                <div style="margin: 1rem 0;">
                  <div class="d-flex justify-content-between mb-2">
                    <small style="color: #999;">Progress</small>
                    <small style="color: #667eea; font-weight: 600;">65%</small>
                  </div>
                  <div class="progress" style="height: 6px; border-radius: 3px; background: #eee;">
                    <div class="progress-bar" style="width: 65%; background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);"></div>
                  </div>
                </div>

                <small style="color: #999;">3 hours to go</small>

                <div class="mt-3">
                  <a href="{{ route('course-detail', ['id' => 1]) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 6px; padding: 8px 16px; font-weight: 600; font-size: 0.85rem;">
                    <i class="bi bi-play-circle"></i> Continue Learning
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Course Card 2 -->
      <div class="col-lg-6">
        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
          <div class="row g-0">
            <div class="col-md-4" style="overflow: hidden;">
              <img src="{{ asset('assets/img/education/education-3.webp') }}" alt="Course" class="img-fluid h-100" style="object-fit: cover;">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title fw-700" style="color: #2c3e50;">Mobile App Development</h5>
                <p class="text-muted mb-2" style="font-size: 0.9rem;"><i class="bi bi-person"></i> By Sarah Johnson</p>
                
                <!-- Progress Bar -->
                <div style="margin: 1rem 0;">
                  <div class="d-flex justify-content-between mb-2">
                    <small style="color: #999;">Progress</small>
                    <small style="color: #667eea; font-weight: 600;">40%</small>
                  </div>
                  <div class="progress" style="height: 6px; border-radius: 3px; background: #eee;">
                    <div class="progress-bar" style="width: 40%; background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);"></div>
                  </div>
                </div>

                <small style="color: #999;">8 hours to go</small>

                <div class="mt-3">
                  <a href="{{ route('course-detail', ['id' => 2]) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 6px; padding: 8px 16px; font-weight: 600; font-size: 0.85rem;">
                    <i class="bi bi-play-circle"></i> Continue Learning
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
