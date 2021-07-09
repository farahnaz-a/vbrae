@extends('layouts.frontend')

@section('title')
    {{ config('app.name') }} - Home Page
@endsection

@section('content')
    
<section class="hero" style="background-image: url({{ asset('frontend_assets/assets/images/game-banner.jpg') }});">
    <div class="container">
      <div class="gradient"></div>
      <div class="hero-wrapper">
        <h1>
          Start to <strong class="flip">Sell</strong> your favourite video
          games!
        </h1>
        <div class="search">
          <form action="{{ route('game.search') }}" method="GET">
          
            <i class="fas fa-search"></i>
            <input
              type="text"
              placeholder="Enter game title..."
              class="form-control form-control-lg"
              name="name"
            />
          </form>
        </div>
      </div>
    </div>
    <div class="slider">
      <div class="swiper-container mySwiper">
        <div class="swiper-wrapper">
          @foreach($games as $game)
            @if(\App\Models\Listing::where('game_id', $game->id)->exists())
            <div class="swiper-slide">
              <a href="{{ $game->url_slug }}" class="game-slide">
                <div>
                  {{-- @if(\Carbon\Carbon::parse($game->release_date)->diffInDays( \Carbon\Carbon::now() , false) < 0)
                  <span class="realise-date">
                    <i class="fa fa-clock" aria-hidden="true"></i> {{ 'Release in',  \Carbon\Carbon::parse($game->release_date)->diffInDays( \Carbon\Carbon::now()) , ['days' => \Carbon\Carbon::parse($game->release_date)->diffInDays( \Carbon\Carbon::now())] }}
                  </span>
                  @endif --}}
                
                  <img src="{{ asset('games') }}/{{ $game->cover }}" alt="" />
                  <div>
                    @if($game->getPlatform)
                   
                    @if($game->platform_id == 1)
                    <span
                      class="platform-label"
                      style="background-color: {{ $game->getPlatform->color }}"
                      >{{ $game->getPlatform->name }}</span
                    >
                    @else
                    <span
                    class="platform-label"
                    style="background-color: {{ $game->getPlatform->color }}"
                    >{{ $game->getPlatform->name }}</span
                  >
                    @endif
                    @else 
                    <span
                    class="platform-label"
                    style="background-color: #2222"
                    >Not found</span
                  >
                    @endif
                    <div class="game-title">{{ $game->name }}</div>
                    @if(\App\Models\Listing::where('game_id', $game->id)->get()->count() == 0)
                    <small>No listing available.</small>
                    @else 
                    <small>{{ \App\Models\Listing::where('game_id', $game->id)->get()->count() }} listing available.</small>
                    @endif
                  </div>
                </div>
              </a>
            </div>      
            @endif  

          @endforeach
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <div class="page-title">
        <h4>
          <a href="./listing.html"
            ><i class="fas fa-tags"></i> Newest Listings</a
          >
        </h4>
        <div class="arrow">
          <a href="./listing.html"><i class="fa fa-angle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="listings">
        <div class="row">
          @include('includes.listing')
        </div>
        <div class="more">
          <a href="#"><i class="fas fa-ellipsis-h"></i></a>
        </div>
      </div>
    </div>
  </section>
  <section style="position: relative">
    <div class="bg-image"></div>
    <div class="container">
      <div class="page-title pt-5">
        <h4>
          <a href="./listing.html"
            ><i class="fas fa-tags"></i> popular games
          </a>
        </h4>
        <div class="arrow">
          <a href="./listing.html"><i class="fa fa-angle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="container mb-5">
      <div class="listings">
        <div class="row">
          <div class="col-lg-3 col-xl-2 col-md-3 col-sm-4 col-6">
            <div class="list-item">
              <a href="#">
                <div>
                  <span class="label" style="background-color: #000000"
                    >PC</span
                  >
                  <div class="game-image">
                    <img src="{{ asset('frontend_assets/assets/images/games/game-1.jpg') }}" alt="" />
                    <div class="game-title">Until We Die</div>
                  </div>
                </div>
                <span class="price bg-dark"
                  ><i class="fa fa-heartbeat me-2"></i>1</span
                >
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-xl-2 col-md-3 col-sm-4 col-6">
            <div class="list-item">
              <a href="#">
                <div>
                  <span class="label" style="background-color: #000000"
                    >PC</span
                  >
                  <div class="game-image">
                    <img src="{{ asset('frontend_assets/assets/images/games/game-1.jpg') }}" alt="" />
                    <div class="game-title">Until We Die</div>
                  </div>
                </div>
                <span class="price bg-dark"
                  ><i class="fa fa-heartbeat me-2"></i>1</span
                >
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-xl-2 col-md-3 col-sm-4 col-6">
            <div class="list-item">
              <a href="#">
                <div>
                  <span class="label" style="background-color: #000000"
                    >PC</span
                  >
                  <div class="game-image">
                    <img src="{{ asset('frontend_assets/assets/images/games/game-1.jpg') }}" alt="" />
                    <div class="game-title">Until We Die</div>
                  </div>
                </div>
                <span class="price bg-dark"
                  ><i class="fa fa-heartbeat me-2"></i>1</span
                >
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-xl-2 col-md-3 col-sm-4 col-6">
            <div class="list-item">
              <a href="#">
                <div>
                  <span class="label" style="background-color: #000000"
                    >PC</span
                  >
                  <div class="game-image">
                    <img src="{{ asset('frontend_assets/assets/images/games/game-1.jpg') }}" alt="" />
                    <div class="game-title">Until We Die</div>
                  </div>
                </div>
                <span class="price bg-dark"
                  ><i class="fa fa-heartbeat me-2"></i>1</span
                >
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-xl-2 col-md-3 col-sm-4 col-6">
            <div class="list-item">
              <a href="#">
                <div>
                  <span class="label" style="background-color: #000000"
                    >PC</span
                  >
                  <div class="game-image">
                    <img src="{{ asset('frontend_assets/assets/images/games/game-1.jpg') }}" alt="" />
                    <div class="game-title">Until We Die</div>
                  </div>
                </div>
                <span class="price bg-dark"
                  ><i class="fa fa-heartbeat me-2"></i>1</span
                >
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-xl-2 col-md-3 col-sm-4 col-6">
            <div class="list-item">
              <a href="#">
                <div>
                  <span class="label" style="background-color: #000000"
                    >PC</span
                  >
                  <div class="game-image">
                    <img src="{{ asset('frontend_assets/assets/images/games/game-1.jpg') }}" alt="" />
                    <div class="game-title">Until We Die</div>
                  </div>
                </div>
                <span class="price bg-dark"
                  ><i class="fa fa-heartbeat me-2"></i>1</span
                >
              </a>
            </div>
          </div>
        </div>
        <div class="more">
          <a href="#"><i class="fas fa-ellipsis-h"></i></a>
        </div>
      </div>
    </div>
  </section>
@endsection

