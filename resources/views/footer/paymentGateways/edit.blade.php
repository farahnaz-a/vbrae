@extends('layouts.dashboard')
                
@section('title')
    {{ config('app.name') }} - Payment Gateway
@endsection

@section('paymentGateways')
    active
@endsection
           
@section('breadcrumb')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Payment Gateway</h2>
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
                    <h5 class="text-center">Update Payment Gateway</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('paymentGateways.update', $paymentGateway->id) }}" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Existing Image:</label>
                                <br>
                                <img src="{{ asset('uploads/paymentGateways') }}/{{ $paymentGateway->image }}" width="120" alt="No Image">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <div class="custom-file">
                                    <input type="file" name="image" value="{{ asset('uploads/paymentGateways') }}/{{ $paymentGateway->image }}" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Choose Image</label>
                                    @error('image')
                                        <small class="alert alert-danger">{{ $message }}</small>
                                    @enderror
                                </div>
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