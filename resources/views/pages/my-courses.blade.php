@extends('layouts.base')
@section('title', 'My Courses - E-Learning')
@section('content')
    <section class="page-section">
      <div class="container" data-aos="fade-up">
        <h1 class="page-title mb-4">My Learning</h1>
        <p class="lead">Continue learning from where you left off</p>
        
        <div class="row mt-5 gy-4">
          <div class="col-lg-6">
            <div class="enrolled-course">
              <div class="row align-items-center">
                <div class="col-md-3">
                  <img src="{{ asset('assets/img/education/education-4.webp') }}" alt="Course" class="img-fluid">
                </div>
                <div class="col-md-9">
                  <h5>Web Development Fundamentals</h5>
                  <p class="text-muted">By John Smith</p>
                  <div class="progress">
                    <div class="progress-bar" style="width: 65%"></div>
                  </div>
                  <small>65% Complete • 3 hours to go</small>
                  <a href="{{ route('course-detail', ['id' => 1]) }}" class="btn btn-sm btn-primary mt-3">Continue Learning</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
