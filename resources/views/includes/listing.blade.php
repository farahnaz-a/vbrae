@forelse ($listings as $listing)
@if(Route::is('frontend.game'))
<div class="col-lg-3 col-xl-2 col-md-3 col-sm-4 col-6">
  <div class="list-item">
    <a href="{{ route('frontend.overview', $listing->id) }}">
      {{-- <div class="payment-enabled">
        <span><i class="fas fa-shield-alt"></i></span>
        <span><img src="{{ asset('frontend_assets/assets/images/globe.png') }}" alt="" /></span>
        <span>A</span>
        <span><i class="fas fa-key"></i></span>
      </div> --}}
      <div>
        <span class="label" style="background-color: {{ $listing->getPlatform->color }}"
          >{{ $listing->getPlatform->name }}</span
        > 
        <div class="game-image">
          <img src="{{ asset('games') }}/{{ $listing->cover }}" alt="" />
          <div class="game-title">{{ $listing->name }}</div>
        </div>
      </div>
      {{-- <span class="price">€ {{ $listing->price }}</span> --}}
    </a>
    {{-- <a href="./user.html" class="published-by">
      <img src="{{ $listing->getUser->profile_photo_url }}" alt="" />
      <strong>{{ $listing->getUser->name }}</strong>
    </a> --}}
  </div>
</div>
@else 
<div class="col-lg-3 col-xl-2 col-md-3 col-sm-4 col-6">
  <div class="list-item">
    <a href="{{ route('frontend.listingDetails', $listing->id) }}">
      <div class="payment-enabled">
        <span><i class="fas fa-shield-alt"></i></span>
        <span><img src="{{ asset('frontend_assets/assets/images/globe.png') }}" alt="" /></span>
        <span>A</span>
        <span><i class="fas fa-key"></i></span>
      </div>
      <div>
        <span class="label" style="background-color: {{ $listing->getGame->getPlatform->color }}"
          >{{ $listing->getGame->getPlatform->name }}</span
        >
        <div class="game-image">
          <img src="{{ asset('games') }}/{{ $listing->getGame->cover }}" alt="" />
          <div class="game-title">{{ $listing->getGame->name }}</div>
        </div>
      </div>
      <span class="price">€ {{ $listing->price }}</span>
    </a>
    <a href="./user.html" class="published-by">
      <img src="{{ asset('uploads/users') }}/{{ $listing->getUser->profile_photo_path }}" alt="" />
      <strong>{{ $listing->getUser->name }}</strong>
    </a>
  </div>
</div>
@endif
@empty
  <div class="col-12 py-5">
    <h6>No Listings Found...</h6>
  </div>
@endforelse 