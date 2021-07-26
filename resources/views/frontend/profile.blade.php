@extends('layouts.frontend')
@php
    $listings = \App\Models\Listing::where('user_id', $user->id)->simplePaginate(20);
@endphp
@section('title')
    {{ config('app.name') }} - {{ $user->name }}'s Profile
@endsection

@section('content')
<section class="product">
    <div class="blur-bg" style="background: linear-gradient(0deg, #191818 30%, rgba(25,24,24,0) 80%),url({{ asset('uploads/users') }}/{{ $user->profile_photo_path }}) center center no-repeat !important;"></div>
    <div class="bg-color" style="top: 50%"></div>
    <div class="container" style="position: relative">
      <div class="profile">
        <div class="row">
          <div class="col-md-6">
            <div class="user">
              <img src="{{ asset('uploads/users') }}/{{ $user->profile_photo_path }}" alt="" />
              <div>
                <h3>{{ $user->name }}</h3>
                {{-- <p>
                  <img
                    src="./assets/images/flags/PK.svg"
                    width="16"
                    alt=""
                  />US, New York City <span>10001</span>
                </p>
                <small>ADMIN IS ONLINE</small> --}}
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="review-wrapper">
              <div class="review">
                <div class="rating-percent">
                  <i class="fas fa-thumbs-up text-success"></i>
                  @if(\App\Models\UserRating::where('user_id', $user->id)->exists())
                  {{ (positive($user->id)->count()/totalrating($user->id)->count()) * 100 }}%
                  @else 
                  NA
                  @endif
                </div>
                <div class="rating-counts">
                  <span class="text-danger">
                    <i class="fa fa-thumbs-down" aria-hidden="true"></i>{{ negative($user->id)->count() }}
                  </span>
                  <i class="fa fa-minus" aria-hidden="true"></i> 
                  <span class="text-success"
                    ><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{ positive($user->id)->count() }}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="game-content">
          <div class="content-tab">
            <div>
              <span data-target="#listing" class="active tab-btn"
                ><i class="fas fa-tags me-2"></i>Listing</span
              >
              <span data-target="#rating" class="tab-btn"
                ><i class="fas fa-thumbs-up me-2"></i>Rating</span
              >
            </div>
          </div>
          <div class="content">
            <div id="listing">
              <div class="listings">
                <div class="row">
                  @include('includes.listing')
                </div>
                @if($listings->hasPages())
                <div class="page-pagination">
                    <div class="prev">«</div>
                    <div class="pages">
                       @for ($i = 1; $i <= ceil($listings->total()/30); $i++)
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
            <div id="rating" class="d-none">
              <ul class="notification">
                <li>
                  <a href="#">
                    <div class="left">
                      <i class="fas fa-thumbs-up"></i>
                      {{-- <img src="./assets/images/no_avatar.jpg" alt="" /> --}}
                    </div>
                    <div class="right">
                      <p>No Rating to show yet</p>
                      <span class="notice"
                        ><i class="fa fa-quote-left" aria-hidden="true"></i>
                        No Rating to show yet
                        <i class="fa fa-quote-right" aria-hidden="true"></i
                      ></span>
                    </div>
                  </a>
                </li>
                {{-- <li>
                  <a href="#">
                    <div class="left">
                      <i class="fas fa-thumbs-up"></i>
                      <img src="./assets/images/no_avatar.jpg" alt="" />
                    </div>
                    <div class="right">
                      <p>Rating from sulabh0503</p>
                      <span class="notice"
                        ><i class="fa fa-quote-left" aria-hidden="true"></i>
                        It's good and working
                        <i class="fa fa-quote-right" aria-hidden="true"></i
                      ></span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="left">
                      <i class="fas fa-thumbs-up"></i>
                      <img src="./assets/images/no_avatar.jpg" alt="" />
                    </div>
                    <div class="right">
                      <p>Rating from sulabh0503</p>
                      <span class="notice"
                        ><i class="fa fa-quote-left" aria-hidden="true"></i>
                        It's good and working
                        <i class="fa fa-quote-right" aria-hidden="true"></i
                      ></span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="left">
                      <i class="fas fa-thumbs-up"></i>
                      <img src="./assets/images/no_avatar.jpg" alt="" />
                    </div>
                    <div class="right">
                      <p>Rating from sulabh0503</p>
                      <span class="notice"
                        ><i class="fa fa-quote-left" aria-hidden="true"></i>
                        It's good and working
                        <i class="fa fa-quote-right" aria-hidden="true"></i
                      ></span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="left">
                      <i class="fas fa-thumbs-up"></i>
                      <img src="./assets/images/no_avatar.jpg" alt="" />
                    </div>
                    <div class="right">
                      <p>Rating from sulabh0503</p>
                      <span class="notice"
                        ><i class="fa fa-quote-left" aria-hidden="true"></i>
                        It's good and working
                        <i class="fa fa-quote-right" aria-hidden="true"></i
                      ></span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="left">
                      <i class="fas fa-thumbs-up"></i>
                      <img src="./assets/images/no_avatar.jpg" alt="" />
                    </div>
                    <div class="right">
                      <p>Rating from sulabh0503</p>
                      <span class="notice"
                        ><i class="fa fa-quote-left" aria-hidden="true"></i>
                        It's good and working
                        <i class="fa fa-quote-right" aria-hidden="true"></i
                      ></span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="left">
                      <i class="fas fa-thumbs-up"></i>
                      <img src="./assets/images/no_avatar.jpg" alt="" />
                    </div>
                    <div class="right">
                      <p>Rating from sulabh0503</p>
                      <span class="notice"
                        ><i class="fa fa-quote-left" aria-hidden="true"></i>
                        It's good and working
                        <i class="fa fa-quote-right" aria-hidden="true"></i
                      ></span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="left">
                      <i class="fas fa-thumbs-up"></i>
                      <img src="./assets/images/no_avatar.jpg" alt="" />
                    </div>
                    <div class="right">
                      <p>Rating from sulabh0503</p>
                      <span class="notice"
                        ><i class="fa fa-quote-left" aria-hidden="true"></i>
                        It's good and working
                        <i class="fa fa-quote-right" aria-hidden="true"></i
                      ></span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="left">
                      <i class="fas fa-thumbs-up"></i>
                      <img src="./assets/images/no_avatar.jpg" alt="" />
                    </div>
                    <div class="right">
                      <p>Rating from sulabh0503</p>
                      <span class="notice"
                        ><i class="fa fa-quote-left" aria-hidden="true"></i>
                        It's good and working
                        <i class="fa fa-quote-right" aria-hidden="true"></i
                      ></span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="left">
                      <i class="fas fa-thumbs-up"></i>
                      <img src="./assets/images/no_avatar.jpg" alt="" />
                    </div>
                    <div class="right">
                      <p>Rating from sulabh0503</p>
                      <span class="notice"
                        ><i class="fa fa-quote-left" aria-hidden="true"></i>
                        It's good and working
                        <i class="fa fa-quote-right" aria-hidden="true"></i
                      ></span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="left">
                      <i class="fas fa-thumbs-up"></i>
                      <img src="./assets/images/no_avatar.jpg" alt="" />
                    </div>
                    <div class="right">
                      <p>Rating from sulabh0503</p>
                      <span class="notice"
                        ><i class="fa fa-quote-left" aria-hidden="true"></i>
                        It's good and working
                        <i class="fa fa-quote-right" aria-hidden="true"></i
                      ></span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="left">
                      <i class="fas fa-thumbs-up"></i>
                      <img src="./assets/images/no_avatar.jpg" alt="" />
                    </div>
                    <div class="right">
                      <p>Rating from sulabh0503</p>
                      <span class="notice"
                        ><i class="fa fa-quote-left" aria-hidden="true"></i>
                        It's good and working
                        <i class="fa fa-quote-right" aria-hidden="true"></i
                      ></span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="left">
                      <i class="fas fa-thumbs-up"></i>
                      <img src="./assets/images/no_avatar.jpg" alt="" />
                    </div>
                    <div class="right">
                      <p>Rating from sulabh0503</p>
                      <span class="notice"
                        ><i class="fa fa-quote-left" aria-hidden="true"></i>
                        It's good and working
                        <i class="fa fa-quote-right" aria-hidden="true"></i
                      ></span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="left">
                      <i class="fas fa-thumbs-up"></i>
                      <img src="./assets/images/no_avatar.jpg" alt="" />
                    </div>
                    <div class="right">
                      <p>Rating from sulabh0503</p>
                      <span class="notice"
                        ><i class="fa fa-quote-left" aria-hidden="true"></i>
                        It's good and working
                        <i class="fa fa-quote-right" aria-hidden="true"></i
                      ></span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="left">
                      <i class="fas fa-thumbs-up"></i>
                      <img src="./assets/images/no_avatar.jpg" alt="" />
                    </div>
                    <div class="right">
                      <p>Rating from sulabh0503</p>
                      <span class="notice"
                        ><i class="fa fa-quote-left" aria-hidden="true"></i>
                        It's good and working
                        <i class="fa fa-quote-right" aria-hidden="true"></i
                      ></span>
                    </div>
                  </a>
                </li> --}}
              </ul>
            </div>
            {{-- <div class="my-3">
              <button class="btn btn-sm btn-danger">
                <i class="fas fa-trash"></i> Ban
              </button>
              <button class="btn btn-sm btn-secondary">
                <i class="fas fa-edit"></i> Edit
              </button>
            </div> --}}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('js')
<script>
    const tabBtns = document.querySelectorAll('.tab-btn')
    const contentSections = document.querySelectorAll('.content > div')
    tabBtns.forEach((btn) => {
      btn.addEventListener('click', () => {
        tabBtns.forEach((tabBtn) => tabBtn.classList.remove('active'))
        btn.classList.add('active')
        contentSections.forEach((content) => content.classList.add('d-none'))
        document
          .querySelector(btn.getAttribute('data-target'))
          .classList.remove('d-none')
      })
    })
  </script>
@endsection