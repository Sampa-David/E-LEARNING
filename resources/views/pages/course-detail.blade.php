@extends('layouts.base')
@section('title', 'Course Details - E-Learning')
@section('content')
<!-- ========== PAGE SECTION: COURSE DETAILS ========== -->
<section class="page-section" style="padding: 3rem 0;">
  <div class="container" data-aos="fade-up">
    <div class="row">
      <!-- Main Content -->
      <div class="col-lg-8 mb-4">
        <!-- Course Image -->
        <div style="overflow: hidden; border-radius: 12px; margin-bottom: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
          <img src="{{ asset('assets/img/education/education-4.webp') }}" alt="Course" class="img-fluid w-100" style="height: 400px; object-fit: cover;">
        </div>

        <!-- Course Header -->
        <div class="mb-4">
          <h1 class="page-title" style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 0.5rem;">Web Development Fundamentals</h1>
          <p class="text-muted" style="font-size: 1rem;"><i class="bi bi-person-circle"></i> By <strong>John Smith</strong></p>
        </div>

        <!-- Course Stats -->
        <div class="row mb-4">
          <div class="col-md-4">
            <div class="text-center p-3" style="background: #f8f9fa; border-radius: 10px;">
              <h5 style="color: #ffc107; margin-bottom: 0.5rem;">
                <i class="bi bi-star-fill"></i> 4.8
              </h5>
              <small class="text-muted">2.5K Reviews</small>
            </div>
          </div>
          <div class="col-md-4">
            <div class="text-center p-3" style="background: #f8f9fa; border-radius: 10px;">
              <h5 style="color: #667eea; margin-bottom: 0.5rem;">
                <i class="bi bi-people"></i> 2.5K
              </h5>
              <small class="text-muted">Students Enrolled</small>
            </div>
          </div>
          <div class="col-md-4">
            <div class="text-center p-3" style="background: #f8f9fa; border-radius: 10px;">
              <h5 style="color: #764ba2; margin-bottom: 0.5rem;">
                <i class="bi bi-clock"></i> 24h
              </h5>
              <small class="text-muted">Total Duration</small>
            </div>
          </div>
        </div>

        <!-- Course Description -->
        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; margin-bottom: 2rem;">
          <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 1.5rem 2rem;">
            <h5 class="text-white mb-0"><i class="bi bi-book"></i> What you'll learn</h5>
          </div>
          <div class="card-body p-4">
            <ul style="list-style: none; padding: 0; margin: 0;">
              <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                <i class="bi bi-check-circle" style="color: #667eea; margin-right: 0.75rem;"></i>
                <span style="color: #555;">HTML5 fundamentals and semantic markup</span>
              </li>
              <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                <i class="bi bi-check-circle" style="color: #667eea; margin-right: 0.75rem;"></i>
                <span style="color: #555;">CSS3 for styling and responsive design</span>
              </li>
              <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                <i class="bi bi-check-circle" style="color: #667eea; margin-right: 0.75rem;"></i>
                <span style="color: #555;">JavaScript basics and DOM manipulation</span>
              </li>
              <li style="padding: 0.75rem 0;">
                <i class="bi bi-check-circle" style="color: #667eea; margin-right: 0.75rem;"></i>
                <span style="color: #555;">Build real-world projects and portfolio pieces</span>
              </li>
            </ul>
          </div>
        </div>

        <!-- Course Requirements -->
        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
          <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 1.5rem 2rem;">
            <h5 class="text-white mb-0"><i class="bi bi-list-check"></i> Requirements</h5>
          </div>
          <div class="card-body p-4">
            <ul style="list-style: none; padding: 0; margin: 0;">
              <li style="padding: 0.75rem 0; color: #555;"><i class="bi bi-arrow-right" style="color: #667eea; margin-right: 0.75rem;"></i>No prior coding experience needed</li>
              <li style="padding: 0.75rem 0; color: #555;"><i class="bi bi-arrow-right" style="color: #667eea; margin-right: 0.75rem;"></i>A computer with internet access</li>
              <li style="padding: 0.75rem 0; color: #555;"><i class="bi bi-arrow-right" style="color: #667eea; margin-right: 0.75rem;"></i>Text editor (VS Code recommended)</li>
              <li style="padding: 0.75rem 0; color: #555;"><i class="bi bi-arrow-right" style="color: #667eea; margin-right: 0.75rem;"></i>Dedication to complete projects</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <!-- Enrollment Card -->
        <div class="card border-0 shadow-lg mb-4" style="border-radius: 12px; overflow: hidden; position: sticky; top: 100px;">
          <div class="card-body p-4 text-center">
            <div class="mb-4">
              <h3 class="fw-700" style="color: #667eea; font-size: 2.5rem; margin: 0;">$49.99</h3>
              <small class="text-muted">Limited time offer</small>
            </div>

            <a href="#" class="btn w-100 mb-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; padding: 12px; font-weight: 600; font-size: 1rem;">
              <i class="bi bi-bag-check"></i> Enroll Now
            </a>

            <button class="btn btn-outline-secondary w-100" style="border-radius: 8px; padding: 10px; border: 2px solid #ddd;">
              <i class="bi bi-heart"></i> Add to Wishlist
            </button>

            <hr style="margin: 1.5rem 0;">

            <div class="text-start">
              <h6 class="fw-700 mb-3" style="color: #2c3e50;">This course includes:</h6>
              <div style="line-height: 2;">
                <p style="margin: 0; color: #555;">
                  <i class="bi bi-film" style="color: #667eea; margin-right: 0.75rem;"></i> 24 hours of video
                </p>
                <p style="margin: 0; color: #555;">
                  <i class="bi bi-file-earmark" style="color: #667eea; margin-right: 0.75rem;"></i> Downloadable resources
                </p>
                <p style="margin: 0; color: #555;">
                  <i class="bi bi-award" style="color: #667eea; margin-right: 0.75rem;"></i> Completion certificate
                </p>
                <p style="margin: 0; color: #555;">
                  <i class="bi bi-chat-left-quote" style="color: #667eea; margin-right: 0.75rem;"></i> Q&A Support
                </p>
                <p style="margin: 0; color: #555;">
                  <i class="bi bi-infinity" style="color: #667eea; margin-right: 0.75rem;"></i> Lifetime access
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Instructor Card -->
        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
          <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 1.5rem 2rem;">
            <h5 class="text-white mb-0"><i class="bi bi-person-badge"></i> Instructor</h5>
          </div>
          <div class="card-body p-4 text-center">
            <img src="{{ asset('assets/img/person/person-f-12.webp') }}" alt="Instructor" class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #667eea;">
            <h6 class="fw-700" style="color: #2c3e50;">John Smith</h6>
            <p class="text-muted mb-3" style="font-size: 0.9rem;">Web Development Expert</p>
            <p style="color: #555; font-size: 0.9rem; line-height: 1.6;">Experienced web developer with 10+ years in the industry. Passionate about teaching and helping others succeed.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
