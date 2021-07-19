@php
   $game =  \MarcReichel\IGDBLaravel\Models\Game::find($data->getGame->igdb_game_id); 

   \App\Models\Listing::where('id', $data->id)->increment('clicks');
@endphp
@extends('layouts.frontend')

@section('title')
    {{ config('app.name') }} - Listing Details
@endsection

@section('content')
<section class="product">
    <div class="blur-bg"></div>
    <div class="bg-color"></div>
    <div class="container" style="position: relative;">
      <div class="product-overview">
        <div class="left">
          <div class="game-image">
            <div class="game-platform" style="background-color: {{ $data->getGame->getPlatform->color }}">
              {{ $data->getGame->getPlatform->name }}
            </div>
            <div class="download"><i class="fas fa-download"></i></div>
            <img src="{{ asset('games') }}/{{ $data->getGame->cover }}" alt="" />
            <a
              class="score"
              href="{{ $game->url }}"
              target="_blank"
              >{{ floor( $game->total_rating) }}</a
            >
          </div>
          <div class="buy-btn" data-bs-toggle="modal" data-bs-target="#buy">
            <span class="icon"><i class="fas fa-shopping-basket"></i></span>
            <span class="price">€ {{ $data->price }}</span>
          </div>
        </div>
        <div class="right">
          <div class="game-detail">
            <h3 class="title"><strong>{{ $data->getGame->name }}</strong> {{ \Carbon\Carbon::parse($data->getGame->release_date)->format('Y') }}</h3>
            <div class="game-btns">
               @auth
             
                @if(\App\Models\WishList::where('game_id', $data->getGame->id)->where('listing_id', $data->id)->where('user_id', Auth::id())->doesntExist())
                <span title="Add to wishlist" data-bs-toggle="modal" data-bs-target="#wishlist"><i class="fas fa-heart"></i><span class="d-none d-md-inline ms-2"
                  >Add to wishlist</span>
                </span>
                @else 
                <span title="On your wishlist" ><i class="fas fa-heart"></i><span class="d-none d-md-inline ms-2"
                  >On your wishlist</span>
                </span>
                @endif

               @endauth
             
              <a href="{{ route('frontend.overview', $data->game_id) }}" title="Go to Gameoverview"
                ><i class="fas fa-gamepad"></i
                ><span class="d-none d-md-inline ms-2">
                  Go to Gameoverview</span></a
                ></span
              >
            </div> 
            <div class="buy-btn">
              <span class="icon"><i class="fas fa-shopping-basket"></i></span>
              <span class="price">€ {{ $data->price }}</span>
            </div>
          </div>
        </div>
        <div class="right w-md-100">
          <div class="game-content">
            <div class="content-tab">
              <div>
              <span data-target="#details" class="active tab-btn"><i class="fas fa-tags me-2"></i>Details</span>
              <span data-target="#media" class="tab-btn"><i class="fas fa-images me-2"></i>Media</span>
            </div>
            <div class="social">
              <span style="background-color: #3b5998;">
              <i class="fab fa-facebook-f"></i>
            </span>
              <span style="background-color: #55acee;">
              <i class="fab fa-twitter"></i>
            </span>
            </div>
            </div>
            <div class="content">
              <div id="details">
                <div class="details-btn">
                  <span><i class="fas fa-download"></i></span>
                  <span>{{ ($data->deliver_type == 0) ? 'Manual delivery ' : 'Auto delivery '  }}<i class="fas fa-check-circle text-success"></i></span>
                  <span>Secure Payment <span class="icon d-none d-sm-inline"><i class="fas fa-shield-alt"></i></span></span>
                </div>
                <div class="page-content">
                  <div class="content-header">
                    <small class="text-success"><i class="fas fa-check me-2"></i>{{ ($data->region == 'Global') ? ' This game key can be activated in any country !' : ' This game key can be activated in '. $data->region . '!' }}</small>
                  </div>
                  <div class="content-body">
                    <p>{{ $data->getGame->description }} </p>
                  </div>
                  <div class="content-footer">
                <span><i class="far fa-calendar-plus"></i> Created {{ $data->created_at->diffForHumans() }}</span>
                <span><i class="far fa-chart-bar"></i> {{ $data->clicks }} Views</span>
                  </div>
                </div>
                <div class="page-content">
                    <div class="content-header user">
                      <div>
                        <img src="{{ asset('uploads/users') }}/{{ $data->getUser->profile_photo_path }}" alt="">
                        <a href="{{ route('frontend.userprofile', ['id' => $data->getUser->id, 'name' => $data->getUser->name]) }}">
                          <h6>{{ $data->getUser->name }}</h6>
                          {{-- <img src="./assets/images/flags/PK.svg" width="14" alt=""> --}}
                          {{-- <small>US, New York City <span class="text-muted">10001</span></small> --}}
                        </a>
                      </div>
                      {{-- <div class="rate">
                        <h4><i class="fas fa-thumbs-up text-success me-2"></i>100%</h4>
                        <small>
                          <span class="text-danger"><i class="fas fa-thumbs-down"></i> 0</span>
                          <span class="mx-2">- 0</span>
                          <span class="text-success"><i class="fas fa-thumbs-up"></i> 24</span>
                        </small>
                      </div> --}}
                    </div>
                </div>
              </div>
              <div id="media" class="d-none">
                @if($game->screenshots)
                @foreach ($game->screenshots as $item)
                <div class="media-item" data-image="{{ str_replace('t_thumb', 't_screenshot_med_2x', \MarcReichel\IGDBLaravel\Models\Screenshot::find($item)->url) }}">
                    <img src="{{ str_replace('t_thumb', 't_screenshot_med_2x', \MarcReichel\IGDBLaravel\Models\Screenshot::find($item)->url) }}" alt="">
                    <i class="fas fa-image"></i>
                  </div>
                @endforeach
                @endif
                @if($game->videos)
                @foreach ($game->videos as $item)
                <div class="media-item" data-video='<iframe width="560" height="315" src="https://www.youtube.com/embed/{{ \MarcReichel\IGDBLaravel\Models\GameVideo::find($item)->video_id }}?start=60" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'>
                  <img src="https://img.youtube.com/vi/{{ \MarcReichel\IGDBLaravel\Models\GameVideo::find($item)->video_id }}/mqdefault.jpg" alt="">
                  <i class="fas fa-play-circle"></i>
                </div>
                @endforeach
                @endif
              </div>
              @auth
                  @if(Auth::id() == $data->user_id)
                  <div class="my-3">
                    <a href="{{ route('listings.delete', $data->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</a>
                    <a href="{{ route('frontend.listingEditForm', $data->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i> Edit</a>
                  </div>
                  @endif
              @endauth
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- image and video modal -->
  <div class="media-modal d-none"></div>
  <div class="media-overlay d-none"></div>
  
      <!-- buy modal  -->
      <div class="modal fade" id="buy" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content buy">
            <div class="modal-bg"></div>
            <div class="modal-header">
              <h5 class="modal-title">
                <i class="fas fa-shopping-basket me-2"></i>Buy {{ $data->getGame->name }}
              </h5>
              <div class="d-flex flex-row-reverse align-items-center">
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
            </div>
            <div class="modal-body p-0">
              <div class="game">
                <img src="{{ asset('games') }}/{{ $data->getGame->cover }}" alt="">
                <div>
                  <h5>{{ $data->getGame->name }} <small>{{ \Carbon\Carbon::parse($data->getGame->release_date)->format('Y') }}</small></h5>
                  <small>{{ $data->getGame->getPlatform->name }}</small>
                </div>
              </div>
              <div class="buy-section">
                <h4>{{ ($data->deliver_type == 0) ? 'Manual delivery ' : 'Auto delivery '  }} <i class="fas fa-check-circle text-success ms-2"></i></h4>
                <button class="btn text-white">Secure <i class="fas fa-shield-alt"></i></button>
                <div class="payment-gateways">
                  <span><i class="fab fa-stripe"></i></span>
                  {{-- <span><i class="fab fa-bitcoin"></i></span> --}}
                  <span><i class="fab fa-cc-mastercard"></i></span>
                  <span><i class="fab fa-cc-visa"></i></span>
                  {{-- <span><i class="fab fa-paypal"></i></span> --}}
                </div>
                <p class="text-success mb-0"><small><i class="fas fa-check"></i>{{ ($data->region == 'Global') ? ' This game key can be activated in any country !' : ' This game key can be activated in '. $data->region . '!' }}</small></p>
                <p class="text-danger"><small><i class="fas fa-ban"></i> This is not refundable because its a digital item.</small></p>
                <div class="form-check">
                    <form action="">
                  <input id="agree" class="form-check-input" type="checkbox" value="" required>
                  <label class="form-check-label" for="agree">I agree</label>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
              <button type="submit" class="btn btn-animation btn-info">
                <span class="icon"><i class="fas fa-shopping-basket"></i></span>
                @auth
                @if($data->user_id == Auth::id())
                <span class="text">Your listing</span>
                @else
                <span class="text">Buy</span>
                @endif
                @endauth
                @guest
                <span class="text">Buy</span>
                @endguest
              </button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- wishlist modal  -->
      <div class="modal fade" id="wishlist" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content wishlist">
            <div class="modal-bg"></div>
            <div class="modal-header">
              <h5 class="modal-title">
                <i class="fas fa-heart me-2"></i> Add to Wishlist
              </h5>
              <div class="d-flex flex-row-reverse align-items-center">
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
            </div>
            <div class="modal-body p-0">
              <div class="game">
                <img src="{{ asset('games') }}/{{ $data->getGame->cover }}" alt="">
                <div>
                  <h5>{{ $data->getGame->name }} <small>{{ \Carbon\Carbon::parse($data->getGame->release_date)->format('Y') }}</small></h5>
                  <small>{{ $data->getGame->getPlatform->name }}</small>
                </div>
              </div>
              <form method="post" action="{{ route('wishlist.store') }}">
                @csrf 
              <div class="p-3" style="background-color: #1b1b1b;">
                <div class="form-check">
                  <input id="price-input" name="notification" class="form-check-input" type="checkbox" value="yes">
                  <label class="form-check-label" for="price-input">
                    <i class="fas fa-bell me-2"></i> Send notifications
                  </label>
                </div>
                <div id="price">
                  <div class="form-group">
                    <label for="maximum">Maximum Price</label>
                    <div class="input-group mb-2">
                      <span class="input-group-text" id="basic-addon1">€</span>
                      <input type="text" name="price" class="form-control" placeholder="">
                    </div>
                    <small><i class="fas fa-info-circle me-1"></i>Leave blank if you want to get a notification for each {{ $data->getGame->name }} listing.</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
             
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="game_id" value="{{ $data->getGame->id }}">
                <input type="hidden" name="listing_id" value="{{ $data->id }}">
              <button type="submit" class="btn btn-animation btn-danger mb-2">
                <span class="icon"><i class="fas fa-heart"></i></span>
                <span class="text">Add Wishlist</span>
              </button>
            </form>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('js')
<script>
    const tabBtns = document.querySelectorAll('.tab-btn')
    const contentSections = document.querySelectorAll('.content > div')
    tabBtns.forEach(btn=>{
      btn.addEventListener('click',()=>{
        contentSections.forEach(content=>content.classList.add('d-none'))
        document.querySelector(btn.getAttribute('data-target')).classList.remove('d-none')
      })
    })
  </script>
@endsection