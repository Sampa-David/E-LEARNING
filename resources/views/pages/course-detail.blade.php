@extends('layouts.base')
@section('title', 'Course Details - E-Learning')
@section('content')
    <section class="page-section">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-8">
            <div class="course-detail">
              <img src="{{ asset('assets/img/education/education-4.webp') }}" alt="Course" class="img-fluid rounded mb-4">
              
              <h1>Web Development Fundamentals</h1>
              <p class="instructor-info"><i class="bi bi-person"></i> By John Smith</p>
              
              <div class="course-stats mb-4">
                <span><i class="bi bi-star-fill"></i> 4.8 (2.5K reviews)</span>
                <span><i class="bi bi-people"></i> 2.5K Students</span>
                <span><i class="bi bi-clock"></i> 24 hours</span>
              </div>
              
              <div class="course-description">
                <h3>What you'll learn</h3>
                <ul>
                  <li>HTML5 fundamentals and semantic markup</li>
                  <li>CSS3 for styling and responsive design</li>
                  <li>JavaScript basics and DOM manipulation</li>
                  <li>Build real-world projects</li>
                </ul>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="course-sidebar">
              <div class="enrollment-card">
                <h4>.99</h4>
                <a href="#" class="btn btn-primary w-100 mb-3">Enroll Now</a>
                <button class="btn btn-outline-primary w-100"><i class="bi bi-heart"></i> Add to Wishlist</button>
              </div>
              
              <div class="course-info">
                <h5>Course Includes</h5>
                <p><i class="bi bi-file-video"></i> 24 hours of video lectures</p>
                <p><i class="bi bi-file-earmark"></i> Downloadable resources</p>
                <p><i class="bi bi-award"></i> Completion certificate</p>
                <p><i class="bi bi-question-circle"></i> Q&A support</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
