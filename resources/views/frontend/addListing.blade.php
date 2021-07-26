@extends('layouts.frontend')

@section('title')
    {{ config('app.name') }} - Search Games
@endsection

@section('content')
<div class="page-header">
    <div class="container">
      <h3><i class="fas fa-tags me-2"></i>Add Listing</h3>
    </div>
  </div>
  <section class="game-overview">
    <div class="container">
      <div class="page-content search-section">
        <div class="content-header">
          <h5>Select Game</h5>
        </div>
        <div class="content-body">
          <div class="search">
            <form action="{{ route('game.search') }}" method="GET">
            <div class="input-group my-3">
              <input type="submit" value="Search" class="input-group-text pnt"
              >
              {{-- <i class="fas fa-search"></i> --}}
             
              <input
                type="text"
                class="form-control form-control-lg"
                placeholder="Search"
                name="name"
              />
              </form>
            </div>
          </div>
        </div>
        <div class="content-footer">
          <p>
            Game not found?
            <a href="{{ route('frontend.addGame') }}" class="add-btn ms-3"
              ><i class="fas fa-plus me-2"></i>Add Game</a
            >
          </p>
        </div>
      </div>
      <div class="search-details 
        @isset($game)
        active
        @endisset
      "

      >
        <div class="row">
            @isset($game)
              @foreach ($game as $item)
              <div class="col-lg-3 col-xl-2 col-md-3 col-sm-4 col-6">
                <a href="{{ route('frontend.listingForm', $item->id) }}">
                  <div class="list-item">
                    <span>
                      <div>
  
                 
                        <span class="label" style="background-color: {{ $item->getPlatform->color ?? '#0000' }}"
                          >{{ $item->getPlatform->name ?? 'Platform not found' }}</span
                        > 
                        <div class="game-image">
                          <img src="{{ asset('games') }}/{{ $item->cover }}" alt="" />
                          <div class="game-title">{{ $item->name }}</div>
                        </div>
                      </div>
                    </span>
                  </div>
                </a>
              </div>
              @endforeach
            @else 
             Game Not found !!!
            @endisset
        </div>
      </div>
    </div>
  </section>
@endsection