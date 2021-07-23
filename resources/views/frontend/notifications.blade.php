@extends('layouts.frontend')

@section('title')
    {{ config('app.name') }} - Game Overview 
@endsection

@section('content')
<div class="page-header">
    <div class="container">
      <div class="d-flex justify-content-between">
        <h3><i class="fas fa-bell me-2"></i> Notifications</h3>
      </div>
    </div>
  </div>
<section class="game-overview">
    <div class="container">
      <div class="my-3">
        @if($notifications->hasPages())
        <div class="page-pagination">
            <div class="prev">«</div>
            <div class="pages">
               @for ($i = 1; $i <= ceil($notifications->total()/30); $i++)
               <a href="?page={{ $i }}"><span class="{{ (request()->page == $i) ? 'active' : '' }}">{{ $i }}</span></a>
               @endfor
              
              {{-- <span>3</span>
              <span>4</span>
              <span>5</span>
              <span>6</span>
              <span>7</span>
              <span>8</span>
              <span>9</span>
              <span>10</span> --}}
            </div>
            <div class="next">»</div>
          </div>
        @endif
        <ul class="notification">
 
            @forelse ($notifications as $item)
            <li>
                <a href="{{ $item->url }}">
                  <div class="left">
                    <span>
                        @if($item->type == 'wishlist')
                        <i class="fas fa-heart"></i>
                        @elseif($item->type == 'bought')
                        <i class="fas fa-money-bill"></i>
                        @elseif($item->type == 'sold')
                        <i class="fas fa-key"></i>
                        @elseif($item->type == 'report')
                        <i class="fas fa-money-bill"></i>
                        @endif
                    </span>
                   @if($item->game_id)
                    <img src="{{ asset('games') }}/{{ \App\Models\Games::where('id', $item->game_id)->first()->cover }}" alt="" />
                    @elseif($item->listing_id)
                    <img src="{{ asset('games') }}/{{ \App\Models\Listing::where('id', $item->listing_id)->first()->getGame->cover }}" alt="" />
                  @endif 
                  </div>
                  <div class="right">
                    <p>{{ $item->message }}</p>
                    <small><i class="fas fa-money-bill"></i> {{ $item->created_at->diffForHumans() }}</small>
                  </div>
                </a>
              </li>
            @empty

                <li>
                    You have no notifications.
                </li>

            @endforelse
  
        </ul>
        @if($notifications->hasPages())
        <div class="page-pagination">
            <div class="prev">«</div>
            <div class="pages">
               @for ($i = 1; $i <= ceil($notifications->total()/30); $i++)
               <a href="?page={{ $i }}"><span class="{{ (request()->page == $i) ? 'active' : '' }}">{{ $i }}</span></a>
               @endfor
              
              {{-- <span>3</span>
              <span>4</span>
              <span>5</span>
              <span>6</span>
              <span>7</span>
              <span>8</span>
              <span>9</span>
              <span>10</span> --}}
            </div>
            <div class="next">»</div>
          </div>
        @endif
      </div>
    </div>
  </section>
@endsection