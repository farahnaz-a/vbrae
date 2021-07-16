
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('frontend_assets/assets/images/favicon-32x32.png') }}" />

    <!-- popper js -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
      integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <!-- bootstrap -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"
      integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.min.js"
      integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

    <!-- fontawesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- swiper js -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- custom script-->
    <script src="{{ asset('frontend_assets/assets/scripts/app.js') }}" defer></script>
    <!-- custom styling -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/assets/css/main.min.css') }}" />
  </head>
  <body>
    <header>
      <div class="header container">
        <div class="search-box">
          <form action="{{ route('game.search') }}" method="GET">
            <input type="text" placeholder="search..." name="name" />
            <i class="fas fa-times close-search-btn"></i>
          </form>
        </div>
        <div class="left-header">
          <div class="menu"><i class="fas fa-bars"></i></div>
          <a href="/" class="logo">
            <img src="{{ asset('frontend_assets/assets/images/logo.png') }}" alt="" />
          </a>
          <div class="ellipsis"><i class="fas fa-ellipsis-v"></i></div>
          <ul>
            <li class="close">
              <a href="javascript:void(0)">
                <i class="fas fa-times me-2"></i>
                <span>Close</span>
              </a>
            </li>
            <li class="list-nav">
              <a href="javascript:void(0)">
                <i class="fas fa-tags"></i>
                <span>Listings</span>
                <i class="fas fa-caret-down"></i>
              </a>
              <div>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="listing-item">
                      <p>Current Generation</p>
                      <ul style="overflow-y:scroll; height:300px; ">
                        <li><a href="{{ route('frontend.listing') }}">All Listings</a></li>
                        @foreach (platforms() as $platform)
                        <li><a href="{{ route('frontend.filterlisting', $platform->id) }}">{{ ucfirst($platform->name) }}</a></li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="listing-item">
                      <p>REGION</p>
                      <ul style="overflow-y:scroll; height:300px; ">
                        <li><a href="{{ url('/region/listing/Global') }}">Global</a></li>
                        @foreach (countries() as $country)
                        <li><a href="{{ url('/region/listing') }}/{{ $country->name }}">{{ strtoupper($country->name) }}</a></li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="listing-item">
                      <p>PRICE</p>
                      <ul style="overflow-y:scroll; height:300px; ">
                        <li><a href="{{ url('/price/listing/1') }}">1€</a></li>
                        <li><a href="{{ url('/price/listing/5') }}">5€</a></li>
                        <li><a href="{{ url('/price/listing/10') }}">10€</a></li>
                        <li><a href="{{ url('/price/listing/20') }}">20€</a></li>
                        <li><a href="{{ url('/price/listing/30') }}">30€</a></li>
                        <li><a href="{{ url('/price/listing/40') }}">40€</a></li>
                      </ul>
                    </div>
                  {{-- </div>
                  <div class="col-lg-3">
                    <div class="listing-item">
                      <p>GENRE</p>
                      <ul style="overflow-y:scroll; height:300px; ">
                        <li><a href="./listing.html">Football</a></li>
                        <li>
                          <a href="./listing.html">First-Person Shooter</a>
                        </li>
                        <li><a href="./listing.html">Action</a></li>
                        <li><a href="./listing.html">Role-Playing</a></li>
                        <li><a href="./listing.html">Sports</a></li>
                        <li><a href="./listing.html">Strategy</a></li>
                      </ul>
                    </div>
                  </div> --}}
                </div>
              </div>
            </li>
            <li class="@yield('game')">
              <a href="{{ route('frontend.game') }}">
                <i class="fas fa-gamepad"></i>
                <span>Games</span>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)" class="search-btn">
                <i class="fas fa-search"></i>
                <span>Search</span>
              </a>
            </li>
          </ul>
        </div>
        <div class="right-header">
          <div class="search-btn"><i class="fas fa-search"></i></div>
           @auth
           <div class="isLogin">
            <span class="message"> <i class="fas fa-envelope"></i></span>
            <span class="notification">
              <i class="fas fa-bell">
                @if(notification(Auth::id())->count() > 0)
                <div style="background: red;
                width: 7px;
                height: 7px;
                border-radius: 50%;
                position: absolute;
                /* z-index: 999999; */
                top: 9px;
                right: 9px;
            }"></div>
                @endif
              </i>
              <div class="notification-dropdown">
                <h3>Notifications</h3>
                <ul>
                  @forelse (notification(Auth::id()) as $item)
                        <li>
                    <a href="{{ route('notification.seen', $item->id) }}">
                      <span class="icon"
                        ><i class="fas fa-envelope-open"></i
                      ></span>
                      <p>
                        {{ $item->message }}
                      </p>
                    </a>
                  </li>
                  @empty
                    <li>
                      No new notification.
                    </li>
                  @endforelse

                  
                </ul>
                <a href="{{ route('notification.index') }}"
                  ><i class="fas fa-bell me-2"></i>View all notifications</a
                >
              </div>
            </span>
            <div class="dropdown">
              <span
                class="user dropdown-toggle"
                id="dropdown-user"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <img src="{{ asset('uploads/users') }}/{{ Auth::user()->profile_photo_path }}" alt="" />
                <i class="fas fa-caret-down"></i>
              </span>
              <ul
                class="dropdown-menu dropdown-menu-dark"
                aria-labelledby="dropdown-user"
              >
               @if(Auth::user()->role == 'admin')
               <li>
                <a class="dropdown-item" href="{{ route('dashboard') }}"
                  ><i class="fas fa-id-badge"></i>Admin</a
                >
              </li>
              <li><hr class="dropdown-divider" /></li>
               @endif
                <li>
                  <a class="dropdown-item" href="./balance.html"
                    ><i class="fas fa-money-bill"></i>€ 612,72</a
                  >
                </li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item" href="{{ route('user.dashboard', Str::slug(Auth::user()->name)) }}"
                    ><i class="fas fa-tachometer-alt"></i>Dashboard</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="./listing.html"
                    ><i class="fas fa-tags"></i>Listings</a
                  >
                </li>
                {{-- <li>
                  <a class="dropdown-item" href="./offers.html"
                    ><i class="fas fa-briefcase"></i>Offer</a
                  >
                </li> --}}
                <li>
                  <a class="dropdown-item" href="{{ route('wishlist.index') }}"
                    ><i class="fas fa-heart"></i>Wishlist</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="./report.html"
                    ><i class="fas fa-credit-card"></i>Report</a
                  >
                </li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item" href="{{ route('notification.index') }}"
                    ><i class="fas fa-bell"></i>Notifications</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('user.settings', Auth::id()) }}"
                    ><i class="fas fa-wrench"></i>Settings</a
                  >
                </li>
                {{-- <li>
                  <a class="dropdown-item" href="./profile.html"
                    ><i class="fas fa-user"></i>Profile</a
                  >
                </li> --}}
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <form action="{{ route('logout') }}" method="POST">
                   @csrf 
                   <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();"
                    ><i class="fas fa-power-off"></i>Logout</a
                  >
                  </form>
                </li>
              </ul>
            </div>
            <a href="{{ route('frontend.addListing') }}" class="btn btn-sm btn-warning px-2">
              <i class="fas fa-plus"></i
              ><span class="d-none d-lg-inline-block ms-2">Add listing</span>
            </a>
          </div>
           @endauth
           @guest
           <div class="isLogout">
            <div class="signin" data-bs-toggle="modal" data-bs-target="#signin">
              <i class="fas fa-sign-in-alt"></i> Sign in
            </div>
            <div class="signup" data-bs-toggle="modal" data-bs-target="#create">
              <i class="fa fa-user-plus"></i>
            </div>
          </div>
           @endguest
        </div>
        <!-- sign in modal  -->
        <div class="modal fade" id="signin" tabindex="-1">
          <div class="modal-dialog modal-login">
            <div class="modal-content">
              <div class="modal-bg"></div>
              <div class="modal-header">
                <h5 class="modal-title">
                  <i class="fas fa-sign-in-alt me-2"></i> Sign in
                </h5>
                <div class="d-flex flex-row-reverse align-items-center">
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                  <button
                    class="btn btn-sm btn-warning float-end me-3"
                    data-bs-toggle="modal"
                    data-bs-target="#create"
                    data-bs-dismiss="modal"
                  >
                    <i class="fas fa-user-plus mr-2"></i> Create account
                  </button>
                </div>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="p-3 mb-3">
                      <img
                        src="{{ asset('assets/images/logo.png') }}"
                        class="img-fluid"
                        alt=""
                      />
                      <div class="social-btn steam">
                        <span class="icon"><i class="fab fa-steam"></i></span>
                        <span>Sign in with stream</span>
                      </div>
                      <div class="social-btn twitter">
                        <span class="icon"><i class="fab fa-twitter"></i></span>
                        <span>Sign in with twitter</span>
                      </div>
                      <div class="social-btn facebook">
                        <span class="icon"
                          ><i class="fab fa-facebook-f"></i
                        ></span>
                        <span>Sign in with facebook</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <form action="{{ route('login') }}" method="POST" class="p-3 mb-3">
                      @csrf
                      <div class="input-group mb-2">
                        <span class="input-group-text" id="basic-addon1"
                          ><i class="fas fa-envelope"></i
                        ></span>
                        <input
                          type="email"
                          class="form-control"
                          name="email"
                          placeholder="Email Address"
                          required
                        />
                      </div>
                      <div class="input-group mb-2">
                        <span class="input-group-text" id="basic-addon1"
                          ><i class="fas fa-unlock"></i
                        ></span>
                        <input
                          type="password"
                          class="form-control"
                          placeholder="Password"
                          name="password"
                          required
                        />
                      </div>
                      <div class="form-check mb-2">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          value=""
                          id="remember"
                        />
                        <label class="form-check-label" for="remember">
                          Remember Me
                        </label>
                      </div>
                      <button
                        type="submit"
                        class="btn btn-animation btn-sm btn-green w-100 mb-2"
                      >
                        <span class="icon"
                          ><i class="fas fa-sign-in-alt"></i
                        ></span>
                        <span class="text">Sign in</span>
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary btn-sm w-100"
                      >
                        Forgot your password
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- create account modal -->
        <div class="modal fade" id="create" tabindex="-1">
          <div class="modal-dialog modal-create">
            <div class="modal-content">
              <div class="modal-bg"></div>
              <div class="modal-header">
                <h5 class="modal-title">
                  <i class="fas fa-sign-in-alt me-2"></i> Sign in
                </h5>
                <div class="d-flex flex-row-reverse align-items-center">
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                  <button
                    class="btn btn-sm btn-warning float-end me-3"
                    data-bs-toggle="modal"
                    data-bs-target="#signin"
                    data-bs-dismiss="modal"
                  >
                    <i class="fas fa-sign-in-alt mr-2"></i> Sign in
                  </button>
                </div>
              </div>
              <div class="modal-body">
                <div class="row align-items-center">
                  <div class="col-sm-6">
                    <form action="{{ route('register') }}" class="p-3 mb-3" method="POST">
                      @csrf
                      <div class="input-group mb-2">
                        <span class="input-group-text" id="basic-addon1"
                          ><i class="fas fa-user"></i
                        ></span>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Name"
                          name="name"
                          required
                        />
                      </div>
                      <div class="input-group mb-2">
                        <span class="input-group-text" id="basic-addon1"
                          ><i class="fas fa-envelope"></i
                        ></span>
                        <input
                          type="email"
                          class="form-control"
                          placeholder="Email Address"
                          name="email"
                          required
                        />
                      </div>
                      <div class="input-group mb-2">
                        <span class="input-group-text" id="basic-addon1"
                          ><i class="fas fa-unlock"></i
                        ></span>
                        <input
                          type="password"
                          class="form-control"
                          placeholder="Password"
                          name="password"
                          required
                        />
                      </div>
                      <div class="input-group mb-2">
                        <span class="input-group-text" id="basic-addon1"
                          ><i class="fas fa-exchange-alt"></i
                        ></span>
                        <input
                          type="password"
                          class="form-control"
                          placeholder="Confirm password"
                          name="password_confirmation"
                          required
                        />
                      </div>
                      <div class="form-check mb-2">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          value=""
                          id="remember"
                        />
                        <label class="form-check-label" for="remember">
                          Remember Me
                        </label>
                      </div>
                      <button
                        type="submit"
                        class="btn btn-animation btn-sm btn-green w-100 mb-2"
                      >
                        <span class="icon"
                          ><i class="fas fa-sign-in-alt"></i
                        ></span>
                        <span class="text">Sign in</span>
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary btn-sm w-100"
                      >
                        Forgot your password
                      </button>
                    </form>
                  </div>
                  <div class="col-sm-6">
                    <div class="p-3 mb-3">
                      <img
                        src="{{ asset('/assets/images/logo.png') }}"
                        class="img-fluid"
                        alt=""
                      />
                      <div class="social-btn steam">
                        <span class="icon"><i class="fab fa-steam"></i></span>
                        <span>Sign in with stream</span>
                      </div>
                      <div class="social-btn twitter">
                        <span class="icon"><i class="fab fa-twitter"></i></span>
                        <span>Sign in with twitter</span>
                      </div>
                      <div class="social-btn facebook">
                        <span class="icon"
                          ><i class="fab fa-facebook-f"></i
                        ></span>
                        <span>Sign in with facebook</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
      @if(session('success'))
      <div class="alert alert-success" style="z-index: 99999999;">
        {{ session('success') }}
      </div>
      @endif
       @yield('content')

       <footer class="one">
        <div class="container-fluid platforms">
          <div class="row">
            <a href="#" class="col-6 col-sm-4 col-md-4 col-lg-2 text-center">
              <img
              
                src="{{ asset('frontend_assets/assets/images/ps3_tiny.png') }}"
                class="img-fluid"
                alt="PlayStation 3"
              />
            </a>
            <a href="#" class="col-6 col-sm-4 col-md-4 col-lg-2 text-center">
              <img src="{{ asset('frontend_assets/assets/images/pc_tiny.png') }}" class="img-fluid" alt="PC" />
            </a>
            <a href="#" class="col-6 col-sm-4 col-md-4 col-lg-2 text-center">
              <img
                src="{{ asset('frontend_assets/assets/images/xboxone_tiny.png') }}"
                class="img-fluid"
                alt="Xbox One"
              />
            </a>
            <a href="#" class="col-6 col-sm-4 col-md-4 col-lg-2 text-center">
              <img
                src="{{ asset('frontend_assets/assets/images/ps4_tiny.png') }}"
                class="img-fluid"
                alt="PlayStation 4"
              />
            </a>
            <a href="#" class="col-6 col-sm-4 col-md-4 col-lg-2 text-center">
              <img
                src="{{ asset('frontend_assets/assets/images/xbox360_tiny.png') }}"
                class="img-fluid"
                alt="Xbox 360"
              />
            </a>
            <a href="#" class="col-6 col-sm-4 col-md-4 col-lg-2 text-center">
              <img
                src="{{ asset('frontend_assets/assets/images/wii-u_tiny.png') }}"
                class="img-fluid"
                alt="Wii U"
              />
            </a>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-lg-4">
              <div class="footer-item">
                <a href="/" class="logo mb-4 d-inline-block">
                  <img src="{{ asset('frontend_assets/assets/images/logo.png') }}" alt="" />
                </a>
                <p>Our Mobile Apps</p>
                <div class="d-flex">
                  <div class="me-2">
                    <img
                      class="img-fluid"
                      src="{{ asset('frontend_assets/assets/images/download-apple.png') }}"
                      alt=""
                    />
                  </div>
                  <div class="ms-2">
                    <img
                      class="img-fluid"
                      src="{{ asset('frontend_assets/assets/images/download-google.png') }}"
                      alt=""
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
              <div class="footer-item">
                <h5>Sell</h5>
                <ul>
                  <li><a href="#">Selling Questions</a></li>
                  <li><a href="#">How to Sell</a></li>
                  <li><a href="#">Sell In-Game Items</a></li>
                  <li><a href="#">Sell Video Games</a></li>
                  <li><a href="#">Sell Gift Cards</a></li>
                </ul>
              </div>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
              <div class="footer-item">
                <h5>Buy</h5>
                <ul>
                  <li><a href="#">Buying Questions</a></li>
                  <li><a href="#">How to Buy</a></li>
                  <li><a href="#">Buy In-Game Items</a></li>
                  <li><a href="#">Buy Video Games</a></li>
                  <li><a href="#">Buy Gift Cards</a></li>
                </ul>
              </div>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
              <div class="footer-item">
                <h5>Resources</h5>
                <ul>
                  <li><a href="#">How Does Gameflip Work</a></li>
                  <li><a href="#">Help Center</a></li>
                  <li><a href="#">Forum</a></li>
                  <li><a href="#">Return Policy</a></li>
                  <li><a href="#">Developer API</a></li>
                </ul>
              </div>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
              <div class="footer-item">
                <h5>Join our Community</h5>
                <ul class="social">
                  <li>
                    <a href="#"><i class="fab fa-discord"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                  </li>
                </ul>
                <ul class="social">
                  <li>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-bottom">
            <div class="row">
              <div class="col-md-6">
                <div class="links">
                  <a href="#">About us</a>
                  <a href="#">Terms of use</a>
                  <a href="#">Privacy policy</a>
                </div>
                <p>Copyright &copy; 2021 Vbrae, Inc. All rights reserved.</p>
              </div>
              <div class="col-md-6">
                <img
                  src="{{ asset('frontend_assets/assets/images/icon_payment_logos.png') }}"
                  alt=""
                  class="img-fluid"
                />
              </div>
            </div>
          </div>
        </div>
      </footer>
  @yield('js')
      <script>
        const swiper = new Swiper('.mySwiper', {
          slidesPerView: 5,
          spaceBetween: 30,
          loop: true,
          autoplay: true,
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          breakpoints: {
            0: {
              slidesPerView: 1,
              spaceBetween: 15,
            },
            576: {
              slidesPerView: 2,
              spaceBetween: 15,
            },
            768: {
              slidesPerView: 3,
              spaceBetween: 15,
            },
            992: {
              slidesPerView: 4,
              spaceBetween: 15,
            },
            1198: {
              slidesPerView: 5,
              spaceBetween: 15,
            },
          },
        })
  
        // set auto slide height
        // const gameSlidesImages = document.querySelectorAll('.game-slide img')
        // const gameSlide = document.querySelector('.swiper-slide')
        // const events = ['resize', 'DOMContentLoaded']
        // events.forEach((event) => {
        //   window.addEventListener(event, () => {
        //     const width = (300 / 500) * gameSlide.style.width.split('px')[0]
        //     gameSlidesImages.forEach((img) => (img.style.height = width + 'px'))
        //   })
        // })
  
        //flipping animation
        const words = ['buy', 'sell']
        let count = 0
        const flip = document.querySelector('.flip')
        setInterval(() => {
          flip.style.transform = 'rotateX(-90deg)'
        }, 500)
        setInterval(() => {
          flip.style.transform = 'rotateX(0deg)'
          flip.innerHTML = words[count]
          count++
          if (count === words.length) count = 0
        }, 1000)
      </script>
    </body>
  </html>