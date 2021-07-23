@extends('layouts.frontend') 

@section('title')
    {{ config('app.name') }} | User Dashboard 
@endsection

@section('content')
<div class="page-header">
    <div class="container">
      <h3><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h3>
    </div>
  </div>
  <section class="dashboard">
    <div class="container">
      <div class="quick-links">
        {{-- <a href="./offers.html">
          <span class="icon"><i class="fas fa-briefcase"></i></span>
          <span class="number">32</span>
          <span>Offers</span>
        </a> --}}
        <a href="./wishlist.html">
          <span class="icon"><i class="fas fa-heart"></i></span>
          <span>Wishlist</span>
        </a>
        <a href="./message.html">
          <span class="icon"><i class="fas fa-envelope"></i></span>
          <span>Messages</span>
        </a>
        <a href="./notification.html">
          <span class="icon"><i class="fas fa-bell"></i></span>
          <span>Notifications</span>
        </a>
        <a href="{{ route('user.settings', Auth::id()) }}">
          <span class="icon"><i class="fas fa-wrench"></i></span>
          <span>Settings</span>
        </a>
      </div>
      <div class="dash-title">
        <h4>
          <i class="fas fa-tags me-2"></i>Active Listings
          <small class="badge bg-secondary ms-2">{{ $listings->count() }}</small>
        </h4>
        <a href="{{ route('frontend.listing') }}"
          ><i class="fas fa-angle-right me-2"></i>Show All</a
        >
      </div>
       @foreach ($listings as $item)
       <div class="dash-panel">
        <div class="panel-header">
          <div class="game">
            <img src="{{ asset('games') }}/{{ $item->getGame->cover }}" alt="" />
            <div>
              <h6>{{ $item->getGame->name }}</h6>
              <span style="color:white; background-color: {{ $item->getGame->getPlatform->color }}">{{ $item->getGame->getPlatform->name }}</span>
            </div>
          </div>
          <div class="price"><span>€ {{ $item->price }}</span></div>
        </div>
        <div class="panel-body">
          @if($item->status == 0)
          <span class="no-data"
          ><i class="far fa-frown me-2"></i>Currently active.</span
        >
        @elseif($item->status == 1)
         @if(\App\Models\Gamekey::where('game_list_id', $item->id)->doesntExist())
         <span class="no-data"
         ><i class="far fa-frown me-2"></i>Please update game keys. This listing is sold.</span
          >
          @else
          <span class="no-data"
          ><i class="far fa-frown me-2"></i>Completed.</span
        >
         @endif
          @endif
        </div>
        <div class="panel-footer">
          <small
            >{{ $item->created_at->diffForHumans() }} <br /><i class="fas fa-chart-area me-1"></i> {{ $item->clicks }}
            clicks</small
          >
          <div class="actions">
            <span>
              <a style="color : white;" href="{{ route('listings.delete', $item->id) }}">
              <i class="fas fa-trash me-2"></i>Delete
              </a>
            </span>
             <span>
              <a style="color : white;" href="{{ route('frontend.listingEditForm', $item->id) }}">
               <i class="fas fa-edit me-2"></i>Edit
              </span> 
              </a> 
            <span>
                <a href="{{ route('frontend.listingDetails', $item->id) }}"><i class="fas fa-caret-square-right me-2"></i>Details</a>
            </span>
          </div>
        </div>
      </div>
       @endforeach
      <div class="text-center my-3">
        @if($listings->count() > 3)
        <a href="#" class="btn btn-sm btn-secondary"
          >Show {{ $listings->count() - 3 }} more active listings</a
        >
        @endif
      </div>




      
      <div class="dash-title">
        <h4>
          <i class="fas fa-briefcase me-2"></i> You Bought
          <small class="badge bg-secondary ms-2">224</small>
        </h4>
        <a href="./dash-listing.html"
          ><i class="fas fa-angle-right me-2"></i>Show All</a
        >
      </div>
      {{-- <div class="dash-panel">
        <div class="panel-header">
          <div class="game">
            <img src="./assets/images/games/game-1.jpg" alt="" />
            <div>
              <h6>Stonefly</h6>
              <span style="background-color: #e60012; color: #fff"
                >Nintendo Switch
              </span>
            </div>
          </div>
          <!-- <div class="price">
            <span>€ 5,00</span>
          </div> -->
        </div>
        <div class="panel-body">
          <ul class="custom-table">
            <li>
              <div class="table-content">
                <div class="left">
                  <div class="type">
                    <span class="primary">€ 0,15</span>
                  </div>
                </div>
                <div class="center">
                  <div class="left-col">
                    <i class="fas fa-truck"></i>
                  </div>
                  <a href="./user.html" class="right-col">
                    <img src="./assets/images/admin.jpg" alt="" />
                    <div>
                      <h6 class="title">Mohammad Sayem</h6>
                      <small class="text-muted"
                        ><img
                          class="img-fluid me-2"
                          style="width: 14px; height: 14px; object-fit: cover"
                          src="./assets/images/flags/PK.svg"
                          alt=""
                        />
                        PK, Abbottabad Gpo
                      </small>
                    </div>
                  </a>
                </div>
                <div class="right">
                  <a href="./details.html" class="primary"
                    ><i class="fa fa-thumbs-up me-2"></i>
                    <span class="d-none d-sm-inline"
                      >Rate BenaliZakaria</span
                    ></a
                  >
                </div>
              </div>
              <div class="pluse danger">
                <i class="fas fa-exclamation"></i>
              </div>
            </li>
          </ul>
        </div>
        <div class="panel-footer">
          <small>1 WEEK AGO </small>
          <div class="actions">
            <span><i class="fas fa-caret-square-right me-2"></i>Details</span>
          </div>
        </div>
      </div> --}} 

       <h4>You did not make any purchase yet.</h4>

      <div class="text-center my-3">
        <a href="{{ route('frontend.listing') }}" class="btn btn-sm btn-secondary"
          >Show {{ \App\Models\Listing::where('status', 0)->get()->count() }} more active listings</a
        >
      </div>
      <div class="dash-title">
        <h4>
          <i class="fas fa-chart-bar me-2"></i> Stats
        </h4>
      </div>
      <div class="d-flex justify-content-between" style="flex-flow: row wrap">
        <div class="text-center p-3">
          <h4 class="text-white">€ 0.00</h4>
          <small class="text-uppercase">spend money</small>
        </div>
        <div class="text-center p-3">
          <h4 class="text-white"> {{ $listings->sum('click') }} <i class="fas fa-dot-circle"></i></h4>
          <small class="text-uppercase">clicks on listings</small>
        </div>
        <div class="text-center p-3">
          <h4 class="text-white"> 0 <i class="fas fa-briefcase"></i></h4>
          <small class="text-uppercase">Keys bought</small>
        </div>
        <div class="text-center p-3">
          <h4 class="text-white"> {{ Auth::user()->created_at->diffForHumans() }} <i class="fas fa-user"></i></h4>
          <small class="text-uppercase">membership</small>
        </div>
      </div>
    </div>
  </section>
@endsection