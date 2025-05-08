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

        <audio autoplay controls>
          <source src="{{ asset('song.mp3') }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#news">News</a></li>
          <li><a class="nav-link scrollto" href="#schedule">Schedule</a></li>
          <li><a class="nav-link scrollto" href="#venue">Venue</a></li>
          {{-- <li><a class="nav-link scrollto" href="#hotels">Hotels</a></li> --}}
          <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
          <li><a class="nav-link scrollto" href="#supporters">Sponsors</a></li>
          <!-- <li><a class="nav-link scrollto" href="#faq">FAQ</a></li> -->
          <li><a class="nav-link scrollto" href="#footer">Contact</a></li>
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

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <div class="col-lg-8">
        <img src="{{ asset('images/systems/'.$event_big_logo) }}" alt="{{ $event_short_name }}" class="img-fluid">
      </div>
      <p class="mb-4 pb-0">{{ $home_desc }}</p>
      <a href="{{ $home_yt_teaser }}" class="glightbox play-btn mb-4"></a>
      @auth
        @if (auth()->user()->role == 'Admin')
        <a href="{{ route('dashboard') }}" class="about-btn scrollto">Go to Dashboard</a>
        @else
        <a href="{{ route('my-dashboard') }}" class="about-btn scrollto"><i class="bi bi-card-checklist mr-2"></i> Go to Your Board</a>
        @endif
      @else
        <a href="{{ route('register') }}" class="about-btn scrollto"><i class="bi bi-box-arrow-in-right mr-2"></i> Register Your Team</a>
      @endauth
      <a href="{{ $proposal_link }}" class="about-btn scrollto"><i class="bi bi-file-earmark-arrow-down mr-2"></i> Download Championship Proposal</a>
    </div>
  </section>
  <!-- End Hero Section -->

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-6">
            <h2>About {{ $event_short_name }}</h2>
            <p style="text-align: justify">{!! $about_desc !!}</p>
          </div>
          <div class="col-lg-3">
            <h3>Location</h3>
            <p>{{ $venue_name }}<br><small>{{ $venue_address }}</small></p>
          </div>
          <div class="col-lg-3">
            <h3>Date</h3>
            <p>{{ $date_day }}<br>{{ $date_date }}<br>{{ $date_year }}</p>
          </div>
        </div>
      </div>
    </section>
    <!-- End About Section -->

    <!-- ======= News Section ======= -->
    <section id="news" class="section-with-bg">
      <div class="container mb-3" data-aos="fade-up">
        <div class="section-header">
          <h2>News</h2>
          <p>Here are some of our stories</p>
        </div>
        <div class="row mx-auto justify-content-center">
          @if ($news->count())
            <?php $limit = 3; ?>
              @foreach ($news as $new)
              <?php if($limit == 0) break; ?>
              <div class="col-lg-3 col-md-12 mt-3">
                <div class="card mx-auto h-100" style="width: 17rem">
                  <img src="{{ asset('images/news/'. $new->image) }}" class="card-img-top" alt="{{ $new->image }}">
                  <div class="card-body">
                    <h5 class="card-title">{{ $new->title }}</h5>
                    <p class="card-text" style="text-align: justify">{{ $new->excerpt }}</p>
                  </div>
                  <a href="{{ route('post', $new->slug) }}" class="card-link text-left-end px-3 py-3">READ MORE</a>
                </div>
              </div>
              <?php $limit--; ?>
              @endforeach
          @else
          @endif
          @if ($news->count()>3)
          <div class="col-lg-3 col-md-12 mt-3">
            <div class="card mx-auto" style="width: 17rem">
              <div class="card-body text-center">
                <a href="{{ route('all.news') }}" class="card-link">SEE MORE NEWS >></a>
              </div>
            </div>
          </div> 
          @endif
        </div>
      </div>
    <script type='text/javascript'></script>
    </section>
    <!-- End Speakers Section -->

    <!-- ======= Schedule Section ======= -->
    <section id="schedule">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Schedule</h2>
          <p>Here is our event schedule</p>
        </div>
        <div class="tab-content row justify-content-center" data-aos="fade-up" data-aos-delay="200">
          <!-- Schdule Day 1 -->
          <div role="tabpanel" class="col-lg-9 tab-pane fade show active" id="day-1">
            @foreach ($schedules as $schedule)
              <div class="row schedule-item">
                <div class="col-md-2"><time>{{ date('d M Y', strtotime($schedule->start)) }} - {{ date('d M Y', strtotime($schedule->finish)) }}</time></div>
                <div class="col-md-10">
                  <h4>{{ $schedule->title }}</h4>
                  <p>{{ $schedule->detail }}</p>
                </div>
              </div>
            @endforeach
          </div>
          <!-- End Schdule Day 1 -->
        </div>
      </div>
    </section>
    <!-- End Schedule Section -->

    <!-- ======= Venue Section ======= -->
    <section id="venue" class="section-with-bg">
      <div class="container-fluid" data-aos="fade-up">
        <div class="section-header">
          <h2>Event Venue</h2>
          <p>Event venue location info and gallery</p>
        </div>
        <div class="row justify-content-md-center">
          <div class="col-lg-4 venue-map">
            <div class="row my-2">
              <iframe src="{{ $venue_embed }}" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row my-2">
              <div class="col-lg-6 col-md-4">
                <div class="venue-gallery">
                  <a href="{{ asset('images/systems/'. $venue_img1) }}" class="glightbox" data-gall="venue-gallery">
                    <img src="{{ asset('images/systems/'. $venue_img1) }}" alt="" class="img-fluid">
                  </a>
                </div>
              </div>
              <div class="col-lg-6 col-md-4">
                <div class="venue-gallery">
                  <a href="{{ asset('images/systems/'. $venue_img2) }}" class="glightbox" data-gall="venue-gallery">
                    <img src="{{ asset('images/systems/'. $venue_img2) }}" alt="" class="img-fluid">
                  </a>
                </div>
              </div>
            </div>
            <div class="row my-2">
              <div class="col-lg-6 col-md-4">
                <div class="venue-gallery">
                  <a href="{{ asset('images/systems/'. $venue_img3) }}" class="glightbox" data-gall="venue-gallery">
                    <img src="{{ asset('images/systems/'. $venue_img3) }}" alt="" class="img-fluid">
                  </a>
                </div>
              </div>
              <div class="col-lg-6 col-md-4">
                <div class="venue-gallery">
                  <a href="{{ asset('images/systems/'. $venue_img4) }}" class="glightbox" data-gall="venue-gallery">
                    <img src="{{ asset('images/systems/'. $venue_img4) }}" alt="" class="img-fluid">
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Venue Section -->

    {{-- <!-- ======= Hotels Section ======= -->
    <section id="hotels" class="section-with-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Hotels</h2>
          <p>Here are some nearby hotels</p>
        </div>
        <div class="row">
          <div class="col-6"></div>
          <div class="col-6 text-right">
              <a class="btn carousel-btn mb-3 mr-1" href="#carouselExampleIndicators3" role="button" data-slide="prev">
                  <i class="fa fa-arrow-left"></i>
              </a>
              <a class="btn carousel-btn mb-3 " href="#carouselExampleIndicators3" role="button" data-slide="next">
                  <i class="fa fa-arrow-right"></i>
              </a>
          </div>
          <div class="col-12">
              <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                      <div class="carousel-item active">
                          <div class="row">
                              <div class="col-lg-3 col-md-12">
                                <div class="card mx-auto" style="width: 17rem">
                                  <img src="{{ asset('style/TheEvent/assets/img/venue-gallery/1.jpg') }}" class="card-img-top" alt="...">
                                  <div class="card-body">
                                    <h5 class="card-title">Hotel Fave</h5>
                                    <p class="card-text">Jl. Adi Sucipto 56, Manahan</p>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                  </div>
                                </div>
                              </div>  
                              <div class="col-lg-3 col-md-12">
                                <div class="card mx-auto" style="width: 17rem">
                                  <img src="{{ asset('style/TheEvent/assets/img/venue-gallery/1.jpg') }}" class="card-img-top" alt="...">
                                  <div class="card-body">
                                    <h5 class="card-title">Swis-belhotel</h5>
                                    <p class="card-text">Jl. Adi Sucipto 56, Manahan</p>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                  </div>
                                </div>
                              </div>  
                              <div class="col-lg-3 col-md-12">
                                <div class="card mx-auto" style="width: 17rem">
                                  <img src="{{ asset('style/TheEvent/assets/img/venue-gallery/1.jpg') }}" class="card-img-top" alt="...">
                                  <div class="card-body">
                                    <h5 class="card-title">Harris Hotel</h5>
                                    <p class="card-text">Jl. Adi Sucipto 56, Manahan</p>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-12">
                                <div class="card mx-auto" style="width: 17rem">
                                  <img src="{{ asset('style/TheEvent/assets/img/venue-gallery/1.jpg') }}" class="card-img-top" alt="...">
                                  <div class="card-body">
                                    <h5 class="card-title">Pop! Hotel</h5>
                                    <p class="card-text">Jl. Adi Sucipto 56, Manahan</p>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                  </div>
                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="carousel-item">
                          <div class="row">
                            <div class="col-lg-3 col-md-12">
                              <div class="card mx-auto" style="width: 17rem">
                                <img src="{{ asset('style/TheEvent/assets/img/venue-gallery/1.jpg') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">Paragon Solo Hotel</h5>
                                  <p class="card-text">Jl. Adi Sucipto 56, Manahan</p>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star"></span>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      </div>
    </section><!-- End Hotels Section --> --}}

    <!-- ======= Gallery Section ======= -->
    <section id="gallery">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Gallery</h2>
          <p>Check our gallery from the recent events</p>
        </div>
      </div>
      <div class="gallery-slider swiper">
        <div class="swiper-wrapper align-items-center">
          <div class="swiper-slide"><a href="{{ asset('images/systems/'. $galleries_img1) }}" class="gallery-lightbox"><img src="{{ asset('images/systems/'. $galleries_img1) }}" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="{{ asset('images/systems/'. $galleries_img2) }}" class="gallery-lightbox"><img src="{{ asset('images/systems/'. $galleries_img2) }}" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="{{ asset('images/systems/'. $galleries_img3) }}" class="gallery-lightbox"><img src="{{ asset('images/systems/'. $galleries_img3) }}" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="{{ asset('images/systems/'. $galleries_img4) }}" class="gallery-lightbox"><img src="{{ asset('images/systems/'. $galleries_img4) }}" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="{{ asset('images/systems/'. $galleries_img5) }}" class="gallery-lightbox"><img src="{{ asset('images/systems/'. $galleries_img5) }}" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="{{ asset('images/systems/'. $galleries_img6) }}" class="gallery-lightbox"><img src="{{ asset('images/systems/'. $galleries_img6) }}" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="{{ asset('images/systems/'. $galleries_img7) }}" class="gallery-lightbox"><img src="{{ asset('images/systems/'. $galleries_img7) }}" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="{{ asset('images/systems/'. $galleries_img8) }}" class="gallery-lightbox"><img src="{{ asset('images/systems/'. $galleries_img8) }}" class="img-fluid" alt=""></a></div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </section>
    <!-- End Gallery Section -->

    <!-- ======= Supporters Section ======= -->
    <section id="supporters">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Sponsors</h2>
          <p>Those Who Have Helped Us</p>
        </div>
        <div class="row no-gutters supporters-wrap clearfix" data-aos="zoom-in" data-aos-delay="100">
          @foreach ($sponsors as $sponsor)
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="supporter-logo">
              <a href="{{ $sponsor->web }}">
                <img src="{{ asset('images/sponsors/'. $sponsor->image) }}" class="img-fluid" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $sponsor->name }}" style="width: 150px" alt="{{ $sponsor->name }}">
              </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- End Sponsors Section -->

    <!-- =======  F.A.Q Section ======= -->
    <!-- dihapus ada di wa -->
    <!-- End  F.A.Q Section -->
  </main>
  <!-- End #main -->
  
  <!-- Modal Order Form -->
  <div id="register-modal" class="modal fade">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registration</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="#">
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="team" placeholder="Team Name">
            </div>
            <div class="form-group mt-3">
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group mt-3">
              <input type="password" class="form-control" name="re-password" placeholder="Input Password Again">
            </div>
            <div class="text-center mt-3">
              <button type="submit" class="btn">Register</button>
            </div>
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

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
            <p >
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