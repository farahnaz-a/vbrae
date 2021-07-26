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
        <a href="{{ url('/wishlists') }}">
          <span class="icon"><i class="fas fa-heart"></i></span>
          <span>Wishlist</span>
        </a>
        <a href="./message.html">
          <span class="icon"><i class="fas fa-envelope"></i></span>
          <span>Messages</span>
        </a>
        <a href="{{route('notification.index')}}">
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
         @if(\App\Models\GameKey::where('game_list_id', $item->id)->doesntExist())
         <span class="no-data text-warning"
         ><i class="far fa-frown me-2"></i>Please update game keys. This listing is sold.</span
          >
          @else
          <span class="no-data text-success"
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
               @if(\App\Models\Sale::where('listing_id', $item->id)->exists())
               <a href="{{ route('frontend.orderDetails', \App\Models\Sale::where('listing_id', $item->id)->first()->id) }}"><i class="fas fa-caret-square-right me-2"></i>Details</a>
               @else
               <a href="{{ route('frontend.listingDetails', $item->id) }}"><i class="fas fa-caret-square-right me-2"></i>Details</a>
               @endif
            </span>
          </div>
        </div>
      </div>
       @endforeach
      <div class="text-center my-3">
        @if($listings->count() > 3)
        <a href="{{ route('frontend.listing') }}" class="btn btn-sm btn-secondary"
          >Show {{ $listings->count() - 3 }} more active listings</a
        >
        @endif
      </div>




      
      <div class="dash-title">
        <h4>
          <i class="fas fa-briefcase me-2"></i> You Bought
          <small class="badge bg-secondary ms-2">{{ \App\Models\Sale::where('user_id', Auth::id())->count() }}</small>
        </h4>
     
      </div>
      <div class="dash-panel">
        @foreach (\App\Models\Sale::where('user_id', Auth::id())->where('status', 'confirmed')->get() as $item)
            @php
                $listing = \App\Models\Listing::find($item->listing_id); 
            @endphp
                    <div class="panel-header">
                      <div class="game">
                        <img src="{{ asset('games') }}/{{ $listing->getGame->cover }}" alt="" />
                        <div>
                          <h6>{{ $listing->getGame->name }}</h6>
                          <span style="color:white; background-color: {{ $listing->getGame->getPlatform->color }}">{{ $listing->getGame->getPlatform->name }}</span>
                        </div>
                      </div>
                      <div class="price">
                        <span>€ {{ $listing->price }}</span>
                      </div> 
                    </div>
                    <div class="panel-body">
                      <ul class="custom-table">
                        <li>
                          <div class="table-content">
                            {{-- <div class="left">
                              <div class="type">
                                <span class="primary">€ 0,15</span>
                              </div>
                            </div> --}}
                            <div class="center">
                              <div class="left-col">
                                <i class="fas fa-truck"></i>
                              </div>
                              <a href="{{ route('frontend.userprofile', array('id' => $item->user_id, 'name' => \App\Models\User::find($item->user_id)->name)) }}" class="right-col">
                                <img src="{{ asset('uploads/users') }}/{{ \App\Models\User::find($item->user_id)->profile_photo_path }}" alt="" />
                                <div>
                                  <h6 class="title">{{ \App\Models\User::find($item->user_id)->name }}</h6>
                                </div>
                              </a>
                            </div>
                            @if(\App\Models\UserRating::where('listing_id', $listing->id)->exists())
                            @php
                                $rating = \App\Models\UserRating::where('listing_id', $listing->id)->first(); 
                            @endphp
                                <div class="right">
                                  <a href="javascript:void(0)" @if($rating->rating == 'bad') style="background: red;" @endif @if($rating->rating == 'good') class="primary" @endif
                                    ><i class="fa {{ ($rating->rating == 'bad') ? 'fa-thumbs-down' : 'fa-thumbs-up'  }} me-2"></i>
                                    <span class="d-none d-sm-inline"
                                      >{{ \App\Models\User::find($listing->user_id)->name }} has been rated</span
                                    ></a
                                  >
                                </div>
                            @else 
                            <div class="right">
                              <form action="{{ route('user.rating') }}" method="POST">
                               @csrf 
                               <input type="hidden" name="user_id" value="{{ $listing->user_id }}">
                               <input type="hidden" name="rating" value="good">
                               <input type="hidden" name="rated_by" value="{{ Auth::id() }}">
                               <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                               <a href="{{ route('user.rating') }}" onclick="event.preventDefault();this.closest('form').submit();" class="primary"
                               ><i class="fa fa-thumbs-up me-2"></i>
                               <span class="d-none d-sm-inline"
                                 >Rate {{ \App\Models\User::find($listing->user_id)->name }}</span
                               ></a
                             >
                             </form>
                           </div>
                           <div class="right" style="margin-left: 20px">
                             <form action="{{ route('user.rating') }}" method="POST">
                               @csrf 
                               <input type="hidden" name="user_id" value="{{ $listing->user_id }}">
                               <input type="hidden" name="rating" value="bad">
                               <input type="hidden" name="rated_by" value="{{ Auth::id() }}">
                               <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                             <a href="{{ route('user.rating') }}" onclick="event.preventDefault();this.closest('form').submit();" style="background: red;"
                             ><i class="fa fa-thumbs-down me-2"></i>
                             <span class="d-none d-sm-inline"
                               >Rate {{ \App\Models\User::find($listing->user_id)->name }}</span
                             ></a
                           >
                             </form>
                           </div>
                            @endif
                          </div>
                          {{-- <div class="pluse danger">
                            <i class="fas fa-exclamation"></i>
                          </div> --}}
                        </li>
                      </ul>
                    </div>
                    <div class="panel-footer">
                      <small>{{ $item->created_at->diffForHumans() }} </small>
                      <div class="actions">
                        <a href="{{ route('frontend.orderDetails', $item->id) }}" ><span><i class="fas fa-caret-square-right me-2"></i>Details</span></a>
                      </div>
                    </div>
        @endforeach
      </div> 

       {{-- <h4>You did not make any purchase yet.</h4> --}}

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