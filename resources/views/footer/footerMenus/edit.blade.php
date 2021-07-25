@extends('layouts.dashboard')
                
@section('title')
    {{ config('app.name') }} - Footer Menu
@endsection

@section('footerMenus')
    active
@endsection
           
@section('breadcrumb')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Footer Menu</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="row py-2">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Update Footer Menu</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('footerMenus.update', $footerMenu->id) }}">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="col-12">
                            <div class="form-group">
                                <label for="menu">Menu</label>
                                <input type="text" id="menu" class="form-control" name="menu" value="{{ $footerMenu->menu }}" placeholder="Enter Menu">
                                @error('menu')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="link">Link</label>
                                <input type="text" id="link" class="form-control" name="link" value="{{ $footerMenu->link }}" placeholder="Enter link">
                                @error('link')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection