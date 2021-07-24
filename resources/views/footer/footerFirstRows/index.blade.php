@extends('layouts.dashboard')
                
@section('title')
    {{ config('app.name') }} - First Row
@endsection
           
@section('breadcrumb')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">First Row</h2>
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
    <div class="row py-2">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Create Footer First Row</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('footerFirstRows.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <div class="form-group">
                                <label for="logo">Upload First Row Image</label>
                                <div class="custom-file">
                                    <input type="file" name="logo" class="custom-file-input" id="logo">
                                    <label class="custom-file-label" for="logo">Choose Image</label>
                                </div>
                                @error('logo')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="mobile_app_1">First Row App 1</label>
                                <div class="custom-file">
                                    <input type="file" name="mobile_app_1" class="custom-file-input" id="mobile_app_1">
                                    <label class="custom-file-label" for="mobile_app_1">Choose Image</label>
                                </div>
                                @error('mobile_app_1')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="mobile_app_2">First Row App 2</label>
                                <div class="custom-file">
                                    <input type="file" name="mobile_app_2" class="custom-file-input" id="mobile_app_2">
                                    <label class="custom-file-label" for="mobile_app_2">Choose Image</label>
                                </div>
                                @error('mobile_app_2')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Footer First Row List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-bordered">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Sl.</th>
                                    <th>Logo</th>
                                    <th>Mobile App 1</th>
                                    <th>Mobile App 2</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($footerFirstRow as $item)
                                    <tr>
                                        <td>{{ $loop ->index + 1 }}</td>
                                        <td><img src="{{ asset('uploads/footerfirstrows') }}/{{ $item->logo }}" width="150" alt="not-found"></td>
                                        <td><img src="{{ asset('uploads/footerfirstrows') }}/{{ $item->mobile_app_1 }}" width="150" alt="not-found"></td>
                                        <td><img src="{{ asset('uploads/footerfirstrows') }}/{{ $item->mobile_app_2 }}" width="150" alt="not-found"></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('footerFirstRows.edit', $item->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                        <span>Edit</span>
                                                    </a>
                                                    <form action="{{ route('footerFirstRows.destroy', $item->id) }}" method="POST">
                                                        {{-- Initiate Delete method --}}
                                                        {{ method_field('DELETE') }}
                                                        @csrf 
                                                        <a class="dropdown-item" href="{{ route('footerFirstRows.destroy', $item->id) }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                            <span>Delete</span>
                                                        </a>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>no data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
@endsection