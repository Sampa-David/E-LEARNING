@extends('layouts.base')
@section('title', 'Browse Courses - E-Learning')
@section('content')
    <section class="page-section">
      <div class="container" data-aos="fade-up">
        <h1 class="page-title mb-4">All Courses</h1>
        <p class="lead">Explore our comprehensive collection of courses</p>
        
        <div class="row mt-5">
          <div class="col-lg-3">
            <div class="filter-sidebar">
              <h5>Filter by Level</h5>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="beginner">
                <label class="form-check-label" for="beginner">Beginner</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="intermediate">
                <label class="form-check-label" for="intermediate">Intermediate</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="advanced">
                <label class="form-check-label" for="advanced">Advanced</label>
              </div>
            </div>
          </div>
          
          <div class="col-lg-9">
            <div class="row gy-4">
              <div class="col-md-6 col-lg-4">
                <div class="course-card">
                  <div class="course-image">
                    <img src="{{ asset('assets/img/education/education-4.webp') }}" alt="Course" class="img-fluid">
                    <div class="course-badge">Beginner</div>
                  </div>
                  <div class="course-body">
                    <h5><a href="{{ route('course-detail', ['id' => 1]) }}">Web Development Fundamentals</a></h5>
                    <p class="instructor">By John Smith</p>
                    <p class="price">$49.99</p>
                    <div class="course-meta">
                      <span><i class="bi bi-star-fill"></i> 4.8</span>
                      <span><i class="bi bi-people"></i> 2.5K</span>
                    </div>
                    <a href="{{ route('course-detail', ['id' => 1]) }}" class="btn btn-sm btn-primary w-100 mt-3">Enroll Now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
