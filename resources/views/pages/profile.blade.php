@extends('layouts.base')
@section('title', 'My Profile - E-Learning')
@section('content')
<!-- ========== PAGE SECTION: PROFILE ========== -->
<section class="page-section" style="padding: 3rem 0;">
  <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-title mb-4" style="font-size: 2.5rem; font-weight: 700; color: #2c3e50;">My Profile</h1>
      </div>
    </div>

    <div class="row">
      <!-- Profile Card -->
      <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
          <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 2rem; text-align: center;">
            <img src="{{ secure_asset('assets/img/person/person-f-12.webp') }}" alt="Profile" class="rounded-circle" style="width: 100px; height: 100px; border: 4px solid white; object-fit: cover;">
          </div>
          <div class="card-body text-center p-4">
            <h5 class="fw-700" style="color: #2c3e50; margin-bottom: 0.5rem;">John Doe</h5>
            <p class="text-muted" style="font-size: 0.9rem; margin-bottom: 1.5rem;">john@example.com</p>
            <a href="{{ route('settings') }}" class="btn w-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; padding: 10px;">
              <i class="bi bi-pencil-square"></i> Edit Profile
            </a>
          </div>
        </div>
      </div>
      
      <!-- Statistics Card -->
      <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
          <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 1.5rem 2rem;">
            <h5 class="text-white mb-0"><i class="bi bi-graph-up"></i> Learning Statistics</h5>
          </div>
          <div class="card-body p-4">
            <div class="row mt-3">
              <div class="col-md-4 mb-3">
                <div class="text-center p-3" style="background: #f8f9fa; border-radius: 10px; border-left: 4px solid #667eea;">
                  <h3 class="fw-700" style="color: #667eea; margin-bottom: 0.5rem;">5</h3>
                  <p class="text-muted mb-0" style="font-size: 0.9rem;">Courses Enrolled</p>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="text-center p-3" style="background: #f8f9fa; border-radius: 10px; border-left: 4px solid #764ba2;">
                  <h3 class="fw-700" style="color: #764ba2; margin-bottom: 0.5rem;">2</h3>
                  <p class="text-muted mb-0" style="font-size: 0.9rem;">Certificates Earned</p>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="text-center p-3" style="background: #f8f9fa; border-radius: 10px; border-left: 4px solid #667eea;">
                  <h3 class="fw-700" style="color: #667eea; margin-bottom: 0.5rem;">48h</h3>
                  <p class="text-muted mb-0" style="font-size: 0.9rem;">Total Learning Time</p>
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
