@extends('layouts.base')
@section('title', 'Contact Us - E-Learning')
@section('content')
<!-- ========== PAGE SECTION: CONTACT ========== -->
<section class="page-section" style="padding: 3rem 0;">
  <div class="container" data-aos="fade-up">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8 text-center">
        <h1 class="page-title mb-3" style="font-size: 2.5rem; font-weight: 700; color: #2c3e50;">Contact Us</h1>
        <p class="text-muted" style="font-size: 1.1rem;">We'd love to hear from you. Send us a message!</p>
      </div>
    </div>

    <!-- Contact Info Cards -->
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8">
        <div class="row">
          <!-- Address -->
          <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-lg h-100" style="border-radius: 12px; overflow: hidden;">
              <div class="card-body text-center p-4">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                  <i class="bi bi-geo-alt" style="color: white; font-size: 1.5rem;"></i>
                </div>
                <h5 class="fw-700" style="color: #2c3e50;">Address</h5>
                <p class="text-muted mb-0">A108 Adam Street<br>New York, NY 535022</p>
              </div>
            </div>
          </div>

          <!-- Phone -->
          <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-lg h-100" style="border-radius: 12px; overflow: hidden;">
              <div class="card-body text-center p-4">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                  <i class="bi bi-telephone" style="color: white; font-size: 1.5rem;"></i>
                </div>
                <h5 class="fw-700" style="color: #2c3e50;">Phone</h5>
                <p class="text-muted mb-0">+1 5589 55488 55</p>
              </div>
            </div>
          </div>

          <!-- Email -->
          <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-lg h-100" style="border-radius: 12px; overflow: hidden;">
              <div class="card-body text-center p-4">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                  <i class="bi bi-envelope" style="color: white; font-size: 1.5rem;"></i>
                </div>
                <h5 class="fw-700" style="color: #2c3e50;">Email</h5>
                <p class="text-muted mb-0">info@example.com</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact Form -->
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
          <!-- Header -->
          <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 1.5rem 2rem;">
            <h5 class="text-white mb-0"><i class="bi bi-chat-dots"></i> Send us a Message</h5>
          </div>

          <!-- Body -->
          <div class="card-body p-4">
            <form>
              <!-- Name -->
              <div class="mb-4">
                <label for="name" class="form-label fw-600" style="color: #2c3e50;">
                  <i class="bi bi-person"></i> Full Name
                </label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="name"
                  placeholder="Your Name"
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
                  placeholder="your@email.com"
                  style="padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px;"
                >
              </div>

              <!-- Subject -->
              <div class="mb-4">
                <label for="subject" class="form-label fw-600" style="color: #2c3e50;">
                  <i class="bi bi-chat-left-text"></i> Subject
                </label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="subject"
                  placeholder="Message Subject"
                  style="padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px;"
                >
              </div>

              <!-- Message -->
              <div class="mb-4">
                <label for="message" class="form-label fw-600" style="color: #2c3e50;">
                  <i class="bi bi-pencil-square"></i> Message
                </label>
                <textarea 
                  class="form-control" 
                  id="message"
                  rows="5"
                  placeholder="Your message here..."
                  style="padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px;"
                ></textarea>
              </div>

              <!-- Send Button -->
              <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; padding: 12px; font-weight: 600; font-size: 1rem;">
                <i class="bi bi-send"></i> Send Message
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
