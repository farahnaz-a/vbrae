@extends('layouts.dashboard')
                
@section('title')
    {{ config('app.name') }} - Admin Sale List
@endsection
           
@section('breadcrumb')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Admin Dashboard</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                    </li>
                    {{-- <li class="breadcrumb-item"><a href="#">Layouts</a>
                    </li>  --}}
                    <li class="breadcrumb-item active">Sales
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row" id="table-head">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sales Lists</h4>
            
            </div>
            <div class="card-body">
             
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sl</th>
                            <th>Buyer</th>
                            <th>Seller</th>
                            <th>Price</th>
                            <th>Listing</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $key => $sale)
                        @php
                            $buyer = \App\Models\User::find($sale->user_id);
                            $listing = \App\Models\Listing::find($sale->listing_id);
                            $seller = \App\Models\User::find($listing->user_id);
                        @endphp
                        <tr>
                          <td>{{ $loop->index + 1 }}</td>
                          <td>
                              <a target="_blank" href="{{ route('frontend.userprofile', array('id' => $buyer->id, 'name' => $buyer->name)) }}">
                             {{ $buyer->name }}
                              </a>
                          </td>
                          <td>
                            <a target="_blank" href="{{ route('frontend.userprofile', array('id' => $seller->id, 'name' => $seller->name)) }}">
                                {{ $seller->name }}
                                 </a>
                          </td>
                          <td>
                              {{ $sale->price }}
                          </td>
                          <td>
                              <a target="_blank" href="{{ route('frontend.overview', $listing->getGame->id) }}">
                                {{ $listing->getGame->name }}
                              </a>
                          </td>
                          <td>
                              <span class="badge badge-pill badge-success">Payment confirmed</span>
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection