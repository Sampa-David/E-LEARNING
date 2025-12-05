@extends('layouts.base')
@section('title', 'Settings - E-Learning')
@section('content')
    <section class="page-section">
      <div class="container" data-aos="fade-up">
        <h1 class="page-title mb-4">Settings</h1>
        
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <div class="settings-form">
              <h5>Account Settings</h5>
              <form>
                <div class="mb-3">
                  <label for="name" class="form-label">Full Name</label>
                  <input type="text" class="form-control" id="name" value="John Doe">
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" value="john@example.com">
                </div>
                <div class="mb-3">
                  <label for="bio" class="form-label">Bio</label>
                  <textarea class="form-control" id="bio" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
