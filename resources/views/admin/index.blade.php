@extends('layouts.dashboard')
                
@section('title')
    {{ config('app.name') }} - Admin Dashboard
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
                    </li>
                    <li class="breadcrumb-item active">Admin Dashboard
                    </li> --}}
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection
                
@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="text-center">Welcome to Admin Dashboard !!!</h1>
    </div>
</div>

<div class="row py-5">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">Create Admin</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('create.admin') }}">
                    @csrf
                    
                    <div class="form-group icon-input mb-3">
                        <i class="font-sm ti-user text-grey-500 pr-0"></i>
                        <input type="text" class="style2-input pl-5 form-control text-grey-900 font-xsss fw-600" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Your Name">                        
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group icon-input mb-3">
                        <i class="font-sm ti-email text-grey-500 pr-0"></i>
                        <input type="email" name="email" :value="old('email')" required class="style2-input pl-5 form-control text-grey-900 font-xsss fw-600" placeholder="Your Email Address">                        
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group icon-input mb-3">
                        <input type="password" name="password" required autocomplete="new-password" class="style2-input pl-5 form-control text-grey-900 font-xss ls-3" placeholder="Password">
                        <i class="font-sm ti-lock text-grey-500 pr-0"></i>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group icon-input mb-1">
                        <input type="password" name="password_confirmation" required autocomplete="new-password" class="style2-input pl-5 form-control text-grey-900 font-xss ls-3" placeholder="Confirm Password">
                        <i class="font-sm ti-lock text-grey-500 pr-0"></i>
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                 
                <div class="col-sm-12 p-0 text-left">
                    <div class="form-group mb-1"><button type="submit" class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 ">Register</button></div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">User Lists</h5>
            </div>
            <div class="card-body">
              
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Sl.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>
                                    {{-- <img src="../../../app-assets/images/icons/angular.svg" class="mr-75" height="20" width="20" alt="Angular"> --}}
                                    <span class="font-weight-bold">{{ $loop->index + 1 }}</span>
                                </td>
                                <td>{{ ucfirst($user->name) }}</td>
                                <td>
                                   {{  $user->email  }}
                                </td>
                                <td>
                                    @if($user->email_verified_at)
                                    <span class="badge badge-pill badge-light-primary mr-1">Verified</span>
                                    @else
                                    <span class="badge badge-pill badge-light-warning mr-1">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                           @if(Auth::id() == $user->id)
                                           <a class="dropdown-item" href="javascript:void(0);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                            <span>Edit</span>
                                            </a>
                                           @endif
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                <span>Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <p>No data available</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
              
            </div>
        </div>
    </div>
</div>

@endsection
