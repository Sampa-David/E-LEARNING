@extends('layouts.base')
@section('title', 'Settings - E-Learning')
@section('content')
<!-- ========== PAGE SECTION: SETTINGS ========== -->
<section class="page-section" style="padding: 3rem 0;">
  <div class="container" data-aos="fade-up">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h1 class="page-title mb-5" style="font-size: 2.5rem; font-weight: 700; color: #2c3e50;">Account Settings</h1>

        <!-- Settings Card -->
        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
          <!-- Header -->
          <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 1.5rem 2rem;">
            <h5 class="text-white mb-0"><i class="bi bi-gear"></i> Profile Settings</h5>
          </div>

          <!-- Body -->
          <div class="card-body p-4">
            <form>
              <!-- Full Name -->
              <div class="mb-4">
                <label for="name" class="form-label fw-600" style="color: #2c3e50;">
                  <i class="bi bi-person"></i> Full Name
                </label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="name" 
                  value="John Doe"
                  style="padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px;"
                >
              </div>

              <!-- Email -->
              <div class="mb-4">
                <label for="email" class="form-label fw-600" style="color: #2c3e50;">
                  <i class="bi bi-envelope"></i> Email Address
                </label>
                <input 
                  type="email" 
                  class="form-control" 
                  id="email" 
                  value="john@example.com"
                  style="padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px;"
                >
              </div>

              <!-- Bio -->
              <div class="mb-4">
                <label for="bio" class="form-label fw-600" style="color: #2c3e50;">
                  <i class="bi bi-card-text"></i> Bio
                </label>
                <textarea 
                  class="form-control" 
                  id="bio" 
                  rows="4"
                  style="padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px;"
                ></textarea>
              </div>

              <!-- Save Button -->
              <div class="d-flex gap-2">
                <button type="submit" class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; padding: 10px 25px; font-weight: 600;">
                  <i class="bi bi-check-lg"></i> Save Changes
                </button>
                <a href="{{ route('profile') }}" class="btn btn-outline-secondary" style="border-radius: 8px; padding: 10px 25px;">
                  <i class="bi bi-x-lg"></i> Cancel
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
