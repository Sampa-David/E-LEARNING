@extends('layouts.base')

@section('title', 'E-Learning Platform - Home')
@section('body-class', 'index-page')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="hero-wrapper">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 hero-content" data-aos="fade-right" data-aos-delay="100">
              <h1>Learn Without Limits</h1>
              <p>Access thousands of courses taught by industry experts. Learn at your own pace, anytime, anywhere.</p>
              <div class="stats-row">
                <div class="stat-item">
                  <span class="stat-number">50K+</span>
                  <span class="stat-label">Active Learners</span>
                </div>
                <div class="stat-item">
                  <span class="stat-number">500+</span>
                  <span class="stat-label">Courses</span>
                </div>
                <div class="stat-item">
                  <span class="stat-number">100+</span>
                  <span class="stat-label">Expert Teachers</span>
                </div>
              </div>
              <div class="action-buttons">
                <a href="{{ route('courses') }}" class="btn-primary">Explore Courses</a>
                <a href="{{ route('contact') }}" class="btn-secondary">Get Started</a>
              </div>
            </div>
            <div class="col-lg-6 hero-media" data-aos="zoom-in" data-aos-delay="200">
              <img src="{{ asset('assets/img/education/showcase-6.webp') }}" alt="E-Learning" class="img-fluid main-image">
              <div class="image-overlay">
                <div class="badge-accredited">
                  <i class="bi bi-patch-check-fill"></i>
                  <span>Trusted by Millions</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="feature-cards-wrapper" data-aos="fade-up" data-aos-delay="300">
        <div class="container">
          <div class="row gy-4">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
              <div class="feature-card">
                <div class="feature-icon">
                  <i class="bi bi-play-circle"></i>
                </div>
                <div class="feature-content">
                  <h3>Learn on Your Schedule</h3>
                  <p>Watch video lectures whenever you want. Study at your own pace and take courses at a rhythm that works for you.</p>
                </div>
              </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
              <div class="feature-card active">
                <div class="feature-icon">
                  <i class="bi bi-award-fill"></i>
                </div>
                <div class="feature-content">
                  <h3>Earn Certificates</h3>
                  <p>Get recognized credentials from our expert instructors. Add your achievements to your professional profile.</p>
                </div>
              </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
              <div class="feature-card">
                <div class="feature-icon">
                  <i class="bi bi-people-fill"></i>
                </div>
                <div class="feature-content">
                  <h3>Learn with Community</h3>
                  <p>Join a global community of learners. Share knowledge, ask questions, and collaborate with peers.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->

    <!-- Featured Courses Section -->
    <section class="featured-programs section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Featured Courses</h2>
        <p>Check out our most popular courses taught by industry experts</p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="course-card">
              <div class="course-image">
                <img src="{{ asset('assets/img/education/education-4.webp') }}" alt="Course" class="img-fluid">
                <div class="course-badge">Beginner</div>
              </div>
              <div class="course-body">
                <h5><a href="{{ route('course-detail', ['id' => 1]) }}">Web Development Fundamentals</a></h5>
                <p class="instructor">By John Smith</p>
                <p>Learn HTML, CSS, and JavaScript from scratch. Build real projects and master web development basics.</p>
                <div class="course-meta">
                  <span><i class="bi bi-star-fill"></i> 4.8</span>
                  <span><i class="bi bi-people"></i> 2.5K</span>
                </div>
                <a href="{{ route('course-detail', ['id' => 1]) }}" class="btn btn-sm btn-primary mt-3">View Course</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="course-card">
              <div class="course-image">
                <img src="{{ asset('assets/img/education/education-6.webp') }}" alt="Course" class="img-fluid">
                <div class="course-badge">Intermediate</div>
              </div>
              <div class="course-body">
                <h5><a href="{{ route('course-detail', ['id' => 2]) }}">Digital Marketing Mastery</a></h5>
                <p class="instructor">By Sarah Johnson</p>
                <p>Master SEO, social media marketing, and analytics. Grow your digital marketing skills with hands-on projects.</p>
                <div class="course-meta">
                  <span><i class="bi bi-star-fill"></i> 4.9</span>
                  <span><i class="bi bi-people"></i> 3.1K</span>
                </div>
                <a href="{{ route('course-detail', ['id' => 2]) }}" class="btn btn-sm btn-primary mt-3">View Course</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="course-card">
              <div class="course-image">
                <img src="{{ asset('assets/img/education/education-8.webp') }}" alt="Course" class="img-fluid">
                <div class="course-badge">Advanced</div>
              </div>
              <div class="course-body">
                <h5><a href="{{ route('course-detail', ['id' => 3]) }}">Machine Learning & AI</a></h5>
                <p class="instructor">By Alex Chen</p>
                <p>Dive deep into ML algorithms and AI concepts. Build intelligent applications with Python and TensorFlow.</p>
                <div class="course-meta">
                  <span><i class="bi bi-star-fill"></i> 4.7</span>
                  <span><i class="bi bi-people"></i> 1.8K</span>
                </div>
                <a href="{{ route('course-detail', ['id' => 3]) }}" class="btn btn-sm btn-primary mt-3">View Course</a>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-5">
          <a href="{{ route('courses') }}" class="btn btn-lg btn-primary">Browse All Courses</a>
        </div>
      </div>
    </section>
@endsection
