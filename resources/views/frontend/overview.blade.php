@php
     $game =  \MarcReichel\IGDBLaravel\Models\Game::find($data->igdb_game_id); 
@endphp
@extends('layouts.frontend')

@section('title')
    {{ config('app.name') }} - Game Overview 
@endsection

@section('content')
<section class="product">
    <div class="blur-bg"></div>
    <div class="bg-color"></div>
    <div class="container" style="position: relative">
      <div class="product-overview">
        <div class="left" style="position: static">
          <div class="game-image">
            <div class="game-platform" style="background-color: {{ $data->getPlatform->color }}">
              {{ $data->getPlatform->name }}
            </div>
            <div class="download"><i class="fas fa-download"></i></div>
            <img src="{{ asset('games') }}/{{ $data->cover }}" alt="" />
            <a
              class="score"
              href="{{ $game->url }}"
              target="_blink"
              >{{ floor($game->total_rating) }}</a
            >
          </div>
          <p class="description">
           {{ $data->description }}
          </p>
        </div>
        <div class="right">
          <div class="game-detail">
            <h3 class="title"><strong>{{ $data->name }}</strong> {{ \Carbon\Carbon::parse($data->release_date)->format('Y') }}</h3>
            <div class="game-btns">
              <span
                title="Add to wishlist"
                data-bs-toggle="modal"
                data-bs-target="#wishlist"
                ><i class="fas fa-heart"></i
                ><span class="d-none d-md-inline ms-2"
                  >Add to wishlist</span
                ></span
              >
            </div>
            <p class="description">
               {{ $data->description }}
            </p>
          </div>
        </div>
        <div class="right w-md-100">
          <div class="game-content">
            <div class="content-tab">
              <div>
                <span data-target="#listing" class="active tab-btn"
                  ><i class="fas fa-tags me-2"></i>Listing</span
                >
                <span data-target="#media" class="tab-btn"
                  ><i class="fas fa-images me-2"></i>Media</span
                >
              </div>
              <div class="social">
                <span style="background-color: #3b5998">
                  <i class="fab fa-facebook-f"></i>
                </span>
                <span style="background-color: #55acee">
                  <i class="fab fa-twitter"></i>
                </span>
              </div>
            </div>
            <div class="content">
              <div id="listing">
                <ul class="custom-table">
                  @foreach (\App\Models\Listing::where('game_id', $data->id)->get() as $item)
                  <li>
                    <div class="table-content">
                      <div class="left">
                        <div class="type secure">
                          <span><i class="fas fa-shield-alt"></i></span>
                          <span class="primary">€ {{ $item->price }}</span>
                        </div>
                      </div>
                      <div class="center">
                        <span class="value">
                           <small>Digital download</small>
                          <h5>{{ ($item->digital) ? \App\Models\Digital::find($item->digital)->name : '' }}</h5>
                        </span>
                        <span class="value">
                          <small>Delivery</small>
                          <h5>
                             @if($item->deliver_type == 1)
                             Auto delivery 
                             @else 
                             Manual delivery
                             @endif
                            <i
                              class="fas fa-check-circle text-success ms-2"
                            ></i>
                          </h5>
                        </span>
                      </div>
                      <div class="right">
                        <a href="{{ route('frontend.listingDetails', $item->id) }}">
                          <i class="fa fa-arrow-right me-2"></i>
                          <span class="d-none d-sm-inline">Details</span>
                        </a>
                      </div>
                    </div>
                    <div class="table-info">
                      <span>
                        <img
                          class="rounded-circle"
                          src="{{ $item->getUser->profile_photo_url }}"
                          width="14"
                          alt=""
                        />
                        {{ $item->created_at->diffForHumans() }}
                      </span>
                      {{-- <span>
                        New York City
                        <img
                          class="rounded-circle"
                          src="./assets/images/flags/PK.svg"
                          width="14"
                          alt=""
                        />
                      </span> --}}
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div>
              <div id="media" class="d-none">
                @if($game->screenshots)
                @foreach ($game->screenshots as $item)
                <div class="media-item" data-image="{{ str_replace('t_thumb', 't_cover_big', \MarcReichel\IGDBLaravel\Models\Screenshot::find($item)->url) }}">
                    <img src="{{ str_replace('t_thumb', 't_cover_big', \MarcReichel\IGDBLaravel\Models\Screenshot::find($item)->url) }}" alt="">
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
              {{-- <div class="my-3">
                <button class="btn btn-sm btn-secondary">
                  <i class="fas fa-edit"></i> Edit
                </button>
                <button class="btn btn-sm btn-secondary">
                  <i class="fas fa-sync"></i> Refresh Metacritic
                </button>
                <button class="btn btn-sm btn-secondary">
                  <i class="fas fa-level-up-alt"></i> Change Giantbomb ID
                  826000
                </button>
              </div> --}}
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
            <i class="fas fa-shopping-basket me-2"></i>Buy DOOM
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
            <img src="./assets/images/games/game-7.jpg" alt="" />
            <div>
              <h5>DOOM <small>2016</small></h5>
              <small>Xbox One</small>
            </div>
          </div>
          <div class="buy-section">
            <h4>
              Auto Delivery
              <i class="fas fa-check-circle text-success ms-2"></i>
            </h4>
            <button class="btn text-white">
              Secure <i class="fas fa-shield-alt"></i>
            </button>
            <div class="payment-gateways">
              <span><i class="fab fa-stripe"></i></span>
              <span><i class="fab fa-bitcoin"></i></span>
              <span><i class="fab fa-cc-mastercard"></i></span>
              <span><i class="fab fa-cc-visa"></i></span>
              <span><i class="fab fa-paypal"></i></span>
            </div>
            <p class="text-success mb-0">
              <small
                ><i class="fas fa-check"></i> This game key can be activated
                in any country !</small
              >
            </p>
            <p class="text-danger">
              <small
                ><i class="fas fa-ban"></i> This is not refundable because its
                a digital item.</small
              >
            </p>
            <div class="form-check">
              <input
                id="agree"
                class="form-check-input"
                type="checkbox"
                value=""
              />
              <label class="form-check-label" for="agree">I agree</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button
            class="btn btn-secondary"
            data-bs-dismiss="modal"
            aria-label="Close"
          >
            Close
          </button>
          <button type="button" class="btn btn-animation btn-info">
            <span class="icon"><i class="fas fa-shopping-basket"></i></span>
            <span class="text">Buy</span>
          </button>
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
            <img src="{{ asset('games') }}/{{ $data->cover }}" alt="" />
            <div>
              <h5>{{ $data->name }}<small>{{ \Carbon\Carbon::parse($data->release_date)->format('Y') }}</small></h5>
              <small>{{ $data->getPlatform->name }}</small>
            </div>
          </div>
          <div class="p-3" style="background-color: #1b1b1b">
            <div class="form-check">
              <input
                id="price-input"
                class="form-check-input"
                type="checkbox"
                value=""
              />
              <label class="form-check-label" for="price-input">
                <i class="fas fa-bell me-2"></i> Send notifications
              </label>
            </div>
            <div id="price">
              <div class="form-group">
                <label for="maximum">Maximum Price</label>
                <div class="input-group mb-2">
                  <span class="input-group-text" id="basic-addon1">€</span>
                  <input type="text" class="form-control" placeholder="" />
                </div>
                <small
                  ><i class="fas fa-info-circle me-1"></i>Leave blank if you
                  want to get a notification for each DOOM listing.</small
                >
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button
            class="btn btn-secondary"
            data-bs-dismiss="modal"
            aria-label="Close"
          >
            Close
          </button>
          <button type="button" class="btn btn-animation btn-danger mb-2">
            <span class="icon"><i class="fas fa-heart"></i></span>
            <span class="text">Add Wishlist</span>
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('js')
<script>
    const tabBtns = document.querySelectorAll('.tab-btn')
    const contentSections = document.querySelectorAll('.content > div')
    tabBtns.forEach((btn) => {
      btn.addEventListener('click', () => {
        contentSections.forEach((content) => content.classList.add('d-none'))
        document
          .querySelector(btn.getAttribute('data-target'))
          .classList.remove('d-none')
      })
    })
  </script>
@endsection