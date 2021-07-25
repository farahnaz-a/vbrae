@extends('layouts.dashboard')
                
@section('title')
    {{ config('app.name') }} - Gaming Console
@endsection

@section('gamingconsoles')
    active
@endsection
           
@section('breadcrumb')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Gaming Console</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="row py-2">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit gamingConsole</small></h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('gamingconsoles.update', $gamingconsole->id) }}" enctype="multipart/form-data" class="form form-vertical">
                        {{ method_field('PUT') }}
                        @csrf
                        <input type="hidden" name="id" value="{{ $gamingconsole->id }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Existing Image:</label>
                                    <br>
                                    <img src="{{ asset('uploads/gamingconsoles') }}/{{ $gamingconsole->image }}" width="100" alt="No Image">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="customFile">Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" value="{{ asset('uploads/gamingconsoles') }}/{{ $gamingconsole->image }}" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose Image</label>
                                        @error('image')
                                            <small class="alert alert-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 pt-1">
                                <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection