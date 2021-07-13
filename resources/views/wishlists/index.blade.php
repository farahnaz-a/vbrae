@extends('layouts.frontend')
@section('title')
    {{ config('app.name') }} - Wishlists
@endsection

@section('content')
<div class="page-header">
    <div class="container">
      <h3><i class="fas fa-heart me-2"></i>Wishlist</h3>
    </div>
  </div>
  <section class="dashboard">
    <div class="container">
      @foreach ($wishlists as $item)
      @php
          $game = \App\Models\Games::find($item->game_id);
      @endphp
      <div class="dash-panel">
        <div class="panel-header">
          <div class="game">
            <img src="{{ asset('games') }}/{{ $game->cover }}" alt="" />
            <div>
              <h6>{{ $game->name }}</h6>
              <span style="background-color: {{ $game->getPlatform->color }}">{{ $game->getPlatform->name }}</span>
            </div>
          </div>
        </div>
        <div class="panel-body">
          <ul class="custom-table">
             @forelse (\App\Models\Listing::where('game_id', $item->game_id)->get() as $listing)
             <li>
                <div class="table-content">
                  <div class="left">
                    <div class="type secure">
                      <span><i class="fas fa-shield-alt"></i></span>
                      <span class="primary">€ {{ $listing->price }}</span>
                    </div>
                  </div>
                  <div class="center">
                    <span class="value">
                      <small>Digital download</small>
                      <h5>{{ \App\Models\Digital::find($listing->digital)->name }}</h5>
                    </span>
                    <span class="value">
                      <small>Delivery</small>
                      <h5>
                        @if($listing->deliver_type == 1)
                        Auto Delivery 
                        @else 
                        Manual Delivery
                        @endif
                        <i class="fas fa-check-circle text-success ms-2"></i>
                      </h5>
                    </span>
                  </div>
                  <div class="right">
                    <a href="{{ route('frontend.listingDetails', $listing->id) }}">
                      <i class="fa fa-arrow-right me-2"></i>
                      <span class="d-none d-sm-inline">Details</span>
                    </a>
                  </div>
                </div>
              </li>
             @empty    
             <div class="panel-body">
                <span class="no-data"
                  ><i class="far fa-frown me-2"></i> There are no listings
                  available.</span
                >
              </div>
             @endforelse
          </ul>
        </div>
        <div class="panel-footer">
          <div class="actions">
            <a href="{{ route('wishlist.delete', $item->id) }}">
                <span><i class="fas fa-trash me-2"></i>Delete</span></a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </section>
@endsection