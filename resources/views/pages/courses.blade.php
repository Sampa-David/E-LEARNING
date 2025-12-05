@extends('layouts.base')
@section('title', 'Browse Courses - E-Learning')
@section('content')
<!-- ========== PAGE SECTION: COURSES ========== -->
<section class="page-section" style="padding: 3rem 0;">
  <div class="container" data-aos="fade-up">
    <div class="mb-5">
      <h1 class="page-title mb-2" style="font-size: 2.5rem; font-weight: 700; color: #2c3e50;">All Courses</h1>
      <p class="lead text-muted" style="font-size: 1.1rem;">Explore our comprehensive collection of courses</p>
    </div>
    
    <div class="row mt-4">
      <!-- Sidebar Filter -->
      <div class="col-lg-3 mb-4">
        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; position: sticky; top: 100px;">
          <!-- Header -->
          <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 1rem 1.5rem;">
            <h5 class="text-white mb-0"><i class="bi bi-funnel"></i> Filters</h5>
          </div>

          <!-- Body -->
          <div class="card-body p-3">
            <h6 class="fw-700 mb-3" style="color: #2c3e50;">Level</h6>
            
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" id="beginner" style="width: 18px; height: 18px;">
              <label class="form-check-label" for="beginner" style="color: #555;">
                Beginner
              </label>
            </div>

            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" id="intermediate" style="width: 18px; height: 18px;">
              <label class="form-check-label" for="intermediate" style="color: #555;">
                Intermediate
              </label>
            </div>

            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="advanced" style="width: 18px; height: 18px;">
              <label class="form-check-label" for="advanced" style="color: #555;">
                Advanced
              </label>
            </div>

            <hr>

            <h6 class="fw-700 mb-3" style="color: #2c3e50;">Price Range</h6>
            <div class="form-check mb-2">
              <input class="form-check-input" type="radio" name="price" id="free" style="width: 18px; height: 18px;">
              <label class="form-check-label" for="free" style="color: #555;">
                Free
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="radio" name="price" id="paid" style="width: 18px; height: 18px;">
              <label class="form-check-label" for="paid" style="color: #555;">
                Paid
              </label>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Courses Grid -->
      <div class="col-lg-9">
        <div class="row gy-4">
          <!-- Course Card 1 -->
          <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-lg h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease;">
              <!-- Image -->
              <div style="position: relative; overflow: hidden; height: 200px;">
                <img src="{{ asset('assets/img/education/education-4.webp') }}" alt="Course" class="img-fluid w-100 h-100" style="object-fit: cover;">
                <span class="badge" style="position: absolute; top: 10px; right: 10px; background: #667eea; color: white; padding: 0.5rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Beginner</span>
              </div>

              <!-- Body -->
              <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-700" style="color: #2c3e50; min-height: 50px;">
                  <a href="{{ route('course-detail', ['id' => 1]) }}" style="text-decoration: none; color: inherit;">Web Development Fundamentals</a>
                </h5>
                <p class="text-muted" style="font-size: 0.9rem; margin-bottom: 0.5rem;"><i class="bi bi-person"></i> By John Smith</p>
                
                <!-- Rating -->
                <div class="mb-3">
                  <span style="color: #ffc107;">
                    <i class="bi bi-star-fill"></i> 4.8
                  </span>
                  <span class="text-muted" style="font-size: 0.9rem;">(2.5K)</span>
                </div>

                <!-- Price -->
                <div class="mb-3">
                  <h5 class="fw-700" style="color: #667eea; margin: 0;">$49.99</h5>
                </div>

                <!-- Button -->
                <a href="{{ route('course-detail', ['id' => 1]) }}" class="btn w-100 mt-auto" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; padding: 10px; font-weight: 600; font-size: 0.9rem;">
                  Enroll Now
                </a>
              </div>
            </div>
          </div>

          <!-- Course Card 2 -->
          <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-lg h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease;">
              <!-- Image -->
              <div style="position: relative; overflow: hidden; height: 200px;">
                <img src="{{ asset('assets/img/education/education-3.webp') }}" alt="Course" class="img-fluid w-100 h-100" style="object-fit: cover;">
                <span class="badge" style="position: absolute; top: 10px; right: 10px; background: #764ba2; color: white; padding: 0.5rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Intermediate</span>
              </div>

              <!-- Body -->
              <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-700" style="color: #2c3e50; min-height: 50px;">
                  <a href="{{ route('course-detail', ['id' => 2]) }}" style="text-decoration: none; color: inherit;">Mobile App Development</a>
                </h5>
                <p class="text-muted" style="font-size: 0.9rem; margin-bottom: 0.5rem;"><i class="bi bi-person"></i> By Sarah Johnson</p>
                
                <!-- Rating -->
                <div class="mb-3">
                  <span style="color: #ffc107;">
                    <i class="bi bi-star-fill"></i> 4.6
                  </span>
                  <span class="text-muted" style="font-size: 0.9rem;">(1.8K)</span>
                </div>

                <!-- Price -->
                <div class="mb-3">
                  <h5 class="fw-700" style="color: #667eea; margin: 0;">$59.99</h5>
                </div>

                <!-- Button -->
                <a href="{{ route('course-detail', ['id' => 2]) }}" class="btn w-100 mt-auto" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; padding: 10px; font-weight: 600; font-size: 0.9rem;">
                  Enroll Now
                </a>
              </div>
            </div>
          </div>

          <!-- Course Card 3 -->
          <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-lg h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease;">
              <!-- Image -->
              <div style="position: relative; overflow: hidden; height: 200px;">
                <img src="{{ asset('assets/img/education/education-2.webp') }}" alt="Course" class="img-fluid w-100 h-100" style="object-fit: cover;">
                <span class="badge" style="position: absolute; top: 10px; right: 10px; background: #dc3545; color: white; padding: 0.5rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Advanced</span>
              </div>

              <!-- Body -->
              <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-700" style="color: #2c3e50; min-height: 50px;">
                  <a href="{{ route('course-detail', ['id' => 3]) }}" style="text-decoration: none; color: inherit;">Python for Data Science</a>
                </h5>
                <p class="text-muted" style="font-size: 0.9rem; margin-bottom: 0.5rem;"><i class="bi bi-person"></i> By Mike Davis</p>
                
                <!-- Rating -->
                <div class="mb-3">
                  <span style="color: #ffc107;">
                    <i class="bi bi-star-fill"></i> 4.9
                  </span>
                  <span class="text-muted" style="font-size: 0.9rem;">(3.2K)</span>
                </div>

                <!-- Price -->
                <div class="mb-3">
                  <h5 class="fw-700" style="color: #667eea; margin: 0;">$79.99</h5>
                </div>

                <!-- Button -->
                <a href="{{ route('course-detail', ['id' => 3]) }}" class="btn w-100 mt-auto" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; padding: 10px; font-weight: 600; font-size: 0.9rem;">
                  Enroll Now
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
