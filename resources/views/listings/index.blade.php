@extends('layouts.dashboard')
                
@section('title')
    {{ config('app.name') }} - Admin Listings List
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
                    <li class="breadcrumb-item active">Listings
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
                <h4 class="card-title">Listings Lists</h4>
            
            </div>
            <div class="card-body">
             
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Status</th>
                            <th>User</th>
                            <th>Game</th>
                            <th>Price</th>
                            <th>Created</th>
                            <th>Offers</th>
                            <th>Clicks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listings as $key => $listing)
                        <tr>
                            <td>
                                @if($listing->status == 0)
                                <span class="badge badge-pill badge-light-success mr-1">Active</span>
                                @elseif($listing->staus == 1)
                                <span class="badge badge-pill badge-light-primary mr-1">Sold</span>
                                @elseif($listing->status == 2)
                                <span class="badge badge-pill badge-light-info mr-1">Completed</span>
                                @endif
                            </td>
                            <td>
                                <img src="{{ asset('uploads/users') }}/{{ $listing->getUser->profile_photo_path }}" class="mr-75" height="20" width="20" alt="listing image not found">
                                <span class="font-weight-bold">{{ $listing->getUser->name }}</span>
                            </td>
                            <td>{{ $listing->getGame->name }}</td>
                            <td>
                                {{ $listing->price }}
                            </td>
                            <td>
                              
                               {{ $listing->created_at->format('d M Y') }}
                            </td>
                            <td>
                                24
                            </td>
                            <td>
                                {{ $listing->clicks }}
                            </td>
                            <td>
                                 <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                    </button>
                                    <div class="dropdown-menu">
                                        {{-- <a class="dropdown-item" href="javascript:void(0);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                            <span>Edit</span>
                                        </a> --}}
                                        <a class="dropdown-item" href="{{ route('listings.delete', $listing->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                            <span>Delete</span>
                                        </a>
                                    </div>
                                </div> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $listings->links() }}
            </div>
        </div>
    </div>
</div>
@endsection