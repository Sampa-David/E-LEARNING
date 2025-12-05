<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title', 'College') - College Bootstrap Template</title>
  <meta name="description" content="@yield('description', '')">
  <meta name="keywords" content="@yield('keywords', '')">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  @yield('styles')
</head>

<body class="@yield('body-class', '')">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-end">

      <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
        <i class="bi bi-book-fill"></i>
        <h1 class="sitename ms-2">E-Learning</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('home') }}" class="@if(Route::currentRouteName() === 'home') active @endif">Home</a></li>
          <li><a href="{{ route('courses') }}">Courses</a></li>
          <li><a href="{{ route('contact') }}">Contact</a></li>
          <li><a href="{{ route('privacy') }}">Privacy</a></li>
          
          <!-- Séparateur -->
          <li style="border-left: 1px solid #ccc; margin: 0 10px;"></li>
          
          <!-- ========== BOUTONS D'AUTHENTIFICATION ========== -->
          @guest
            <!-- Si non connecté: Login et Register -->
            <li><a href="{{ route('login') }}" class="btn btn-sm btn-primary" style="padding: 8px 16px; border-radius: 4px; display: inline-block;">
              <i class="bi bi-box-arrow-in-right"></i> Login
            </a></li>
            <li><a href="{{ route('register') }}" class="btn btn-sm btn-outline-primary" style="padding: 8px 16px; border-radius: 4px; display: inline-block; border: 1px solid #0d6efd; color: #0d6efd;">
              <i class="bi bi-person-plus"></i> Register
            </a></li>
          @endauth
          
          @auth
            <!-- Si connecté: Afficher le nom et menu déroulant -->
            <li class="dropdown">
              <a href="#"><span><i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="{{ route('profile') }}">My Profile</a></li>
                @if(Auth::user()->isStudent())
                  <li><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                @elseif(Auth::user()->isTeacher())
                  <li><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                @elseif(Auth::user()->isSuperAdmin())
                  <li><a href="{{ route('superadmin.dashboard') }}">Admin Panel</a></li>
                @endif
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="dropdown-item" style="border: none; background: none; cursor: pointer; padding: 0.5rem 1rem; text-align: left; width: 100%;">
                      <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                  </form>
                </li>
              </ul>
            </li>
          @endauth
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">
    @yield('content')
  </main>

  <footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <i class="bi bi-book-fill"></i>
            <span class="sitename ms-2">E-Learning</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Learn anytime, anywhere with our comprehensive online courses.</p>
            <p class="mt-3"><strong>Email:</strong> <span>info@elearning.com</span></p>
            <p><strong>Phone:</strong> <span>+1 (555) 123-4567</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
            <a href=""><i class="bi bi-youtube"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Learning</h4>
          <ul>
            <li><a href="{{ route('courses') }}">Browse Courses</a></li>
            <!-- Lien "My Courses" adapté au rôle de l'utilisateur -->
            @auth
              @if(Auth::user()->isStudent())
                <li><a href="{{ route('student.my-courses') }}">My Courses</a></li>
              @elseif(Auth::user()->isTeacher())
                <li><a href="{{ route('teacher.my-courses') }}">My Courses</a></li>
              @else
                <li><a href="{{ route('courses') }}">My Courses</a></li>
              @endif
            @endauth
            @guest
              <li><a href="{{ route('register') }}">My Courses</a></li>
            @endguest
            <li><a href="">Popular Topics</a></li>
            <li><a href="">New Courses</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Company</h4>
          <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
            <li><a href="{{ route('terms-of-service') }}">Terms of Service</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6 footer-newsletter">
          <h4>Newsletter</h4>
          <p>Subscribe to get updates on new courses and learning materials.</p>
          <form action="#" method="post" class="php-email-form">
            <div class="newsletter-form">
              <input type="email" name="email" placeholder="Your Email">
              <input type="submit" value="Subscribe">
            </div>
          </form>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">E-Learning Platform</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Empowering learners worldwide
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  @yield('scripts')
</body>

</html>
