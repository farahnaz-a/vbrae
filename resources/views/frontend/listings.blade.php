@extends('layouts.frontend')

@if(Route::is('frontend.game'))
@section('game')
    active
@endsection
@endif

@section('content')
<section>
    <div class="bg-image" style="height: 360px"></div>
    <div class="container">
      <div class="listing-title">
        <div>
          <a href="javascript:viod(0)"
            ><i class="fas fa-tags"></i> Listings
          </a>
        </div>
        <div class="total">{{ $listings->currentPage() }} / {{ ceil($listings->total()/30) }}</div>
      </div>
      <div class="list-filter">
        <span
          class="filter-btn"
          data-bs-toggle="modal"
          data-bs-target="#exampleModal"
          ><i class="fas fa-filter"></i>Filter</span
        >
        <div>
          <span class="sort-btn">
            <i class="fa fa-sort-amount-down"></i>
          </span>
          <select class="form-select form-select-sm">
            <option value="" disabled>Sort by</option>
            <option value="date">Date</option>
            <option value="price">price</option>
          </select>
        </div>
      </div>
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                <i class="fas fa-filter me-2"></i>Filter
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-separator">Platforms</div>
            <div class="modal-body">
              <div class="labels">
                <a href="#" class="label">PlayStation 4</a>
                <a href="#" class="label">Nintendo 3DS</a>
                <a href="#" class="label">Xbox One</a>
                <a href="#" class="label">PC</a>
                <a href="#" class="label">PlayStation 3</a>
                <a href="#" class="label">Wii U</a>
                <a href="#" class="label">PlayStation 5</a>
              </div>
            </div>
            <div class="modal-separator">Options</div>
            {{-- <div class="modal-body">
              <div class="labels">
                <a href="#" class="label"
                  ><i class="fa fa-shopping-basket"></i> Sell</a
                >
                <a href="#" class="label"
                  ><i class="fa fa-exchange-alt"></i>Trade</a
                >
                <a href="#" class="label"
                  ><i class="fa fa-handshake"></i>Pickup</a
                >
                <a href="#" class="label"
                  ><i class="fa fa-truck"></i>Delivery</a
                >
                <a href="#" class="label"
                  ><i class="fa fa-download"></i>Digital Download</a
                >
                <a href="#" class="label"
                  ><i class="fa fa-shield-alt"></i>Secure Payment</a
                >
              </div>
            </div> --}}
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-animation btn-sm btn-secondary"
                data-bs-dismiss="modal"
              >
                <span class="icon"><i class="fas fa-times"></i></span>
                <span class="text">Cancel</span>
              </button>
              <button
                type="button"
                class="btn btn-animation btn-sm btn-green"
              >
                <span class="icon"><i class="fas fa-filter"></i></span>
                {{-- <span class="text">Filter</span> --}}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container mb-5">
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
  </section>
@endsection
