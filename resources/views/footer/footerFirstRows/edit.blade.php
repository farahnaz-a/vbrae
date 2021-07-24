@extends('layouts.dashboard')
                
@section('title')
    {{ config('app.name') }} - Footer First Row
@endsection
           
@section('breadcrumb')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Footer First Row</h2>
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Edit First Row</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('footerFirstRows.update', $footerFirstRow->id) }}" enctype="multipart/form-data" class="form form-vertical">
                        {{ method_field('PUT') }}
                        @csrf
                        <input type="hidden" name="id" value="{{ $footerFirstRow->id }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Existing Logo:</label>
                                    <br>
                                    <img src="{{ asset('uploads/footerfirstrows') }}/{{ $footerFirstRow->logo }}" width="100" alt="No Image">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <div class="custom-file">
                                        <input type="file" name="logo" value="{{ asset('uploads/footerfirstrows') }}/{{ $footerFirstRow->logo }}" class="custom-file-input" id="logo">
                                        <label class="custom-file-label" for="logo">Choose Image</label>
                                        @error('logo')
                                            <small class="alert alert-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Existing Mobile App 1:</label>
                                    <br>
                                    <img src="{{ asset('uploads/footerfirstrows') }}/{{ $footerFirstRow->mobile_app_1 }}" width="100" alt="No Image">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="mobile_app_1">Mobile App 1</label>
                                    <div class="custom-file">
                                        <input type="file" name="mobile_app_1" value="{{ asset('uploads/footerfirstrows') }}/{{ $footerFirstRow->mobile_app_1 }}" class="custom-file-input" id="mobile_app_1">
                                        <label class="custom-file-label" for="mobile_app_1">Choose Image</label>
                                        @error('mobile_app_1')
                                            <small class="alert alert-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Existing Mobile App 2:</label>
                                    <br>
                                    <img src="{{ asset('uploads/footerfirstrows') }}/{{ $footerFirstRow->mobile_app_2 }}" width="100" alt="No Image">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="mobile_app_2">Mobile App 2</label>
                                    <div class="custom-file">
                                        <input type="file" name="mobile_app_2" value="{{ asset('uploads/footerfirstrows') }}/{{ $footerFirstRow->mobile_app_2 }}" class="custom-file-input" id="mobile_app_2">
                                        <label class="custom-file-label" for="mobile_app_2">Choose Image</label>
                                        @error('mobile_app_2')
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