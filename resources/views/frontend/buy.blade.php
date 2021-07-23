@extends('layouts.frontend')

@section('title')
    {{ config('app.name') }} | Buy now
@endsection

@section('content')
<section class="product">
    <div class="container" style="position: relative">
      <div class="offer-view">
        <div class="game-image">
            <div class="game-platform" style="background-color: {{ $data->getGame->getPlatform->color }}">
              {{ $data->getGame->getPlatform->name }}
            </div>
            <div class="download"><i class="fas fa-download"></i></div>
            <img src="{{ asset('games') }}/{{ $data->getGame->cover }}" alt="" />
            <a
              class="score"
              href="{{ $data->getGame->url }}"
              target="_blank"
              >{{ floor( $data->getGame->total_rating) }}</a
            >
          </div>
        <h3 class="text-white text-nowrap">€ {{ $data->price }}</h3>
      </div>
      <div class="payment-status">
        <h5>Awaiting payment</h5>
        <div class="steps">
          <div>
            <span><i class="fas fa-check"></i></span>
            <i class="fas fa-arrow-right"></i>
          </div>
          <div>
            <span><i class="fas fa-shopping-basket"></i></span>
            <i class="fas fa-arrow-right"></i>
          </div>
          <div>
            <span class="disabled"><i class="fas fa-thumbs-up"></i></span>
          </div>
        </div>
      </div>
      <div class="secure-payment">
        <h5><i class="fas fa-shield-alt"></i> Secure Payment</h5>
        <div>
          <div>
            <h5>
              € 2,00 <br /><small
                ><i class="fas fa-truck"></i> Free Shipping</small
              >
            </h5>
          </div>
          <div class="payment-method">
            {{-- <span><i class="fas fa-money"></i> Balance</span>
            <span><i class="fab fa-paypal"></i> Paypal</span> --}}
            {{-- <span><i class="fab fa-stripe"></i> Stripe</span> --}}
            <form action="{{ route('frontend.checkout') }}" method="POST">
              @csrf
              <input type="hidden" value="{{ $data->id }}" name="id">
              <a href="{{ route('frontend.checkout') }}"  onclick="event.preventDefault();this.closest('form').submit();"> <i class="fab fa-stripe"></i> Stripe</button>
            </form>
            {{-- <span><i class="fab fa-cc-mastercard"></i> Mastercard</span>
            <span><i class="fab fa-cc-visa"></i> Visa</span> --}}
          </div>
          <div>



            <h5>
              <small>Status</small><br />
              Unpaid <i class="fas fa-times-circle text-danger"></i>
            </h5>
          </div>
        </div>
      </div>
      <div class="message-wrapper">
        <div class="row user">
          <div class="col-sm-6">
            <a href="{{ route('frontend.userprofile', array('id' => $data->user_id, 'name' => $data->getUser->name)) }}" class="receiver">
              <img src="{{ asset('uploads/users') }}/{{ $data->getUser->profile_photo_path }}" alt="" />
              <div>
                <h6>{{ $data->getUser->name }}</h6>
                {{-- <img src="./assets/images/flags/PK.svg" width="14" alt="" />
                <strong class="ms-2">US, Newnan</strong> --}}
              </div>
            </a>
          </div>
          <div class="col-sm-6">
            <a href="{{ route('frontend.userprofile', array('id' => Auth::id(), 'name' => Auth::user()->name)) }}" class="sender">
              <img src="{{ asset('uploads/users') }}/{{ Auth::user()->profile_photo_path }}" alt="" />
              <div>
                <h6>{{ Auth::user()->name }}</h6>
                {{-- <img src="./assets/images/flags/PK.svg" width="14" alt="" />
                <strong class="ms-2">US, New York</strong> --}}
              </div>
            </a>
          </div>
        </div>
        <div class="message-body">
          <div class="sender">
            <img src="./assets/images/games/game-2.jpg" alt="" />
            <p>
              You know on The purchase screen for manually delivery games. It
              must say or show " sellers sends The key Within 24 hours. :)
              <span class="seen"><i class="fas fa-check-double"></i></span>
            </p>
          </div>
          <div class="receiver">
            <img src="./assets/images/admin.jpg" alt="" />
            <p>Hi</p>
          </div>
          <div class="sender">
            <img src="./assets/images/games/game-2.jpg" alt="" />
            <p>
              Hi, I am new developer to fix this website. I need to know some
              info from you to continue work. please let me know when you are
              available...
              <span class="seen"><i class="fas fa-check-double"></i></span>
            </p>
          </div>
          <div class="receiver">
            <img src="./assets/images/admin.jpg" alt="" />
            <p>Hi</p>
          </div>
          <div class="receiver">
            <img src="./assets/images/admin.jpg" alt="" />
            <p>I'm available</p>
          </div>
        </div>
        <div class="message-input">
          <textarea
            class="form-control"
            placeholder="Enter your message..."
          ></textarea>
          <span class="send"><i class="fas fa-paper-plane"></i></span>
        </div>
      </div>
    </div>
  </section>

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
                      <form action="{{ route('frontend.buy', $data->id) }}" method="GET">
                    <input id="agree" class="form-check-input" type="checkbox" value="" required>
                    <label class="form-check-label" for="agree">I agree</label>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                @auth
                @if($data->user_id == Auth::id())
                <button type="button" class="btn btn-animation btn-info">
                  <span class="icon"><i class="fas fa-shopping-basket"></i></span>
                  <span class="text">Your listing</span>
                </button>
                  @else
                  <button type="submit" class="btn btn-animation btn-info">
                    <span class="icon"><i class="fas fa-shopping-basket"></i></span>
                  <span class="text">Buy</span>
                </button>
                  @endif
                  @endauth
                  @guest
                  <button type="submit" class="btn btn-animation btn-info">
                    <span class="icon"><i class="fas fa-shopping-basket"></i></span>
                  <span class="text">Buy</span>
                </button>
                  @endguest
             
                </form>
              </div>
            </div>
          </div>
        </div>
@endsection

@section('js')

@endsection