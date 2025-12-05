@extends('layouts.base')
@section('title', 'Student Life - E-Learning')
@section('content')
<!-- ========== PAGE SECTION: STUDENT LIFE ========== -->
<section class="page-section" style="padding: 3rem 0;">
  <div class="container" data-aos="fade-up">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8 text-center">
        <h1 class="page-title mb-3" style="font-size: 2.5rem; font-weight: 700; color: #2c3e50;">Student Life</h1>
        <p class="lead text-muted" style="font-size: 1.1rem;">Discover the vibrant and enriching student experience at our platform</p>
      </div>
    </div>

    <!-- Benefits Grid -->
    <div class="row mb-5">
      <!-- Benefit 1 -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card border-0 shadow-lg h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease;">
          <div class="card-body text-center p-4">
            <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
              <i class="bi bi-book" style="color: white; font-size: 1.8rem;"></i>
            </div>
            <h5 class="fw-700" style="color: #2c3e50; margin-bottom: 1rem;">Expert Learning</h5>
            <p class="text-muted" style="margin: 0; line-height: 1.6;">Learn from industry experts with years of experience in their fields.</p>
          </div>
        </div>
      </div>

      <!-- Benefit 2 -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card border-0 shadow-lg h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease;">
          <div class="card-body text-center p-4">
            <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
              <i class="bi bi-people" style="color: white; font-size: 1.8rem;"></i>
            </div>
            <h5 class="fw-700" style="color: #2c3e50; margin-bottom: 1rem;">Community Support</h5>
            <p class="text-muted" style="margin: 0; line-height: 1.6;">Connect with thousands of students on the same learning journey as you.</p>
          </div>
        </div>
      </div>

      <!-- Benefit 3 -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card border-0 shadow-lg h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease;">
          <div class="card-body text-center p-4">
            <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
              <i class="bi bi-award" style="color: white; font-size: 1.8rem;"></i>
            </div>
            <h5 class="fw-700" style="color: #2c3e50; margin-bottom: 1rem;">Recognized Certifications</h5>
            <p class="text-muted" style="margin: 0; line-height: 1.6;">Earn certificates recognized by industry leaders worldwide.</p>
          </div>
        </div>
      </div>

      <!-- Benefit 4 -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card border-0 shadow-lg h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease;">
          <div class="card-body text-center p-4">
            <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
              <i class="bi bi-calendar-event" style="color: white; font-size: 1.8rem;"></i>
            </div>
            <h5 class="fw-700" style="color: #2c3e50; margin-bottom: 1rem;">Live Events</h5>
            <p class="text-muted" style="margin: 0; line-height: 1.6;">Participate in webinars and live events with industry professionals.</p>
          </div>
        </div>
      </div>

      <!-- Benefit 5 -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card border-0 shadow-lg h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease;">
          <div class="card-body text-center p-4">
            <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
              <i class="bi bi-laptop" style="color: white; font-size: 1.8rem;"></i>
            </div>
            <h5 class="fw-700" style="color: #2c3e50; margin-bottom: 1rem;">Flexible Learning</h5>
            <p class="text-muted" style="margin: 0; line-height: 1.6;">Learn at your own pace, anytime and anywhere with lifetime access.</p>
          </div>
        </div>
      </div>

      <!-- Benefit 6 -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card border-0 shadow-lg h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease;">
          <div class="card-body text-center p-4">
            <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
              <i class="bi bi-chat-left-text" style="color: white; font-size: 1.8rem;"></i>
            </div>
            <h5 class="fw-700" style="color: #2c3e50; margin-bottom: 1rem;">24/7 Support</h5>
            <p class="text-muted" style="margin: 0; line-height: 1.6;">Get help whenever you need it from our dedicated support team.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- CTA Section -->
    <div class="row justify-content-center mt-5">
      <div class="col-lg-8">
        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
          <div class="card-body text-center text-white p-5">
            <h3 class="fw-700 mb-3">Ready to Transform Your Future?</h3>
            <p class="mb-4" style="font-size: 1.05rem;">Join thousands of students already learning and advancing their careers</p>
            <a href="{{ route('courses') }}" class="btn btn-light fw-600" style="padding: 10px 30px; border-radius: 8px;">
              <i class="bi bi-arrow-right"></i> Explore Our Courses
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
