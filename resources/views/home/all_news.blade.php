<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $event_short_name }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('images/systems/'.$event_sm_logo) }}" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700,800|Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('style/TheEvent/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('style/TheEvent/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('style/TheEvent/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('style/TheEvent/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('style/TheEvent/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  
  <!-- Card Carousel -->
  <link href='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css' rel='stylesheet'>
  <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
  <style></style>
  <script type='text/javascript' src=''></script>
  <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
  <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
  <!-- Template Main CSS File -->
  <link href="{{ asset('style/TheEvent/assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: TheEvent - v4.7.0
  * Template URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center ">
    <div class="container-fluid container-xxl d-flex align-items-center">

      <div id="logo" class="me-auto">
        <!-- Uncomment below if you prefer to use a text logo -->
        {{-- <h1><a href="index.html">The<span>Event</span></a></h1> --}}
        <a href="{{ route('home') }}" class="scrollto"><img src="{{ asset('images/systems/'.$event_sm_logo) }}" alt="" title=""></a>
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link" href="{{ route('home') }}">Home</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      @auth
        <form action="/logout" method="post">@csrf<button type="submit" class="btn buy-tickets">Logout</button></form>
      @else
        <a href="/login"><button type="button" class="btn buy-tickets">Login</button></a>
      @endauth
    </div>
  </header>
  <!-- End Header -->

  <main id="main">
    <!-- ======= News Section ======= -->
    <section id="news" class="section-with-bg">
      <div class="container" data-aos="fade-down">
        <div class="row mt-5 mx-auto justify-content-center">
            <div class="section-header">
                <h2>News</h2>
                <p>Here are some of our stories</p>
              </div>
              @if ($news->count())
                  @foreach ($news as $new)
                  <div class="col-lg-3 col-md-12 mt-3">
                    <div class="card mx-auto h-100" style="width: 17rem">
                      <img src="{{ asset('images/news/'. $new->image) }}" class="card-img-top" alt="{{ $new->image }}">
                      <div class="card-body">
                        <h5 class="card-title">{{ $new->title }}</h5>
                        <p class="card-text">{{ $new->excerpt }}</p>
                      </div>
                      <a href="{{ route('post', $new->slug) }}" class="card-link text-left-end px-3 py-3">READ MORE</a>
                    </div>
                  </div>
                  @endforeach
              @endif
        </div>
      </div>
    <script type='text/javascript'></script>
    </section>
    <!-- End Speakers Section -->
  </main>
  <!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-6 footer-info">
            <h1>{{ $event_name }}</h1>
            <p style="text-align: justify">{!! $contact_desc !!}</p>
          </div>
          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              <b>{{ $contact_name }}</b> <br>
              {{ $contact_address }} <br>
              <strong>Phone:</strong> {{ $contact_phone }}<br>
              <strong>Email:</strong> {{ $contact_email }}<br>
            </p>
            <div class="social-links">
              <a href="{{ $contact_fb }}" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="{{ $contact_ig }}" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="{{ $contact_tw }}" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="{{ $contact_wa }}" class="whatsapp"><i class="bi bi-whatsapp"></i></a>
              <a href="{{ $contact_yt }}" class="youtube"><i class="bi bi-youtube"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        Presented by <strong>{{ $contact_name }}</strong> &copy; 2022
      </div>
      <div class="credits">
        <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=TheEvent
      -->
        Theme <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('style/TheEvent/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('style/TheEvent/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('style/TheEvent/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('style/TheEvent/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('style/TheEvent/assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('style/TheEvent/assets/js/main.js') }}"></script>

</body>
</html>