@extends('layouts.dashboard')
                
@section('title')
    {{ config('app.name') }} - Buy
@endsection
           
@section('breadcrumb')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Buy</h2>
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
                    <h5 class="text-center">Create Buy</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('footerBuys.store') }}">
                        @csrf
                        <div class="col-12">
                            <div class="form-group">
                                <label for="buy_item">Buy Item</label>
                                <input type="text" id="buy_item" class="form-control" name="buy_item" placeholder="Enter buy item">
                                @error('buy_item')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="link">Link</label>
                                <input type="text" id="link" class="form-control" name="link" placeholder="Enter link">
                                @error('link')
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
                    <h5 class="text-center">Buy Item List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-bordered">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Sl.</th>
                                    <th>Buy Item</th>
                                    <th>Link</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($footerBuy as $item)
                                    <tr>
                                        <td>{{ $loop ->index + 1 }}</td>
                                        <td>{{ $item->buy_item }}</td>
                                        <td>{{ $item->link }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('footerBuys.edit', $item->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                        <span>Edit</span>
                                                    </a>
                                                    <form action="{{ route('footerBuys.destroy', $item->id) }}" method="POST">
                                                        {{-- Initiate Delete method --}}
                                                        {{ method_field('DELETE') }}
                                                        @csrf 
                                                        <a class="dropdown-item" href="{{ route('footerBuys.destroy', $item->id) }}" onclick="event.preventDefault(); this.closest('form').submit();">
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
                                        <td colspan="4">No data</td>
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