@extends('layouts.base')
@section('title', 'My Profile - E-Learning')
@section('content')
    <section class="page-section">
      <div class="container" data-aos="fade-up">
        <h1 class="page-title mb-4">My Profile</h1>
        
        <div class="row">
          <div class="col-lg-4">
            <div class="profile-card">
              <div class="profile-header">
                <img src="{{ asset('assets/img/person/person-f-12.webp') }}" alt="Profile" class="img-fluid rounded-circle">
              </div>
              <h5 class="mt-3 text-center">John Doe</h5>
              <p class="text-center text-muted">john@example.com</p>
              <a href="{{ route('settings') }}" class="btn btn-primary w-100">Edit Profile</a>
            </div>
          </div>
          
          <div class="col-lg-8">
            <div class="profile-info">
              <h5>Learning Statistics</h5>
              <div class="row mt-3">
                <div class="col-md-4">
                  <div class="stat-box">
                    <h3>5</h3>
                    <p>Courses Enrolled</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="stat-box">
                    <h3>2</h3>
                    <p>Certificates Earned</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="stat-box">
                    <h3>48h</h3>
                    <p>Total Learning Time</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
