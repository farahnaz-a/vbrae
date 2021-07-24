@extends('layouts.dashboard')
                
@section('title')
    {{ config('app.name') }} - First Row
@endsection
           
@section('breadcrumb')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Sell</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active"><a href="#">Edit</a>
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
                    <h5 class="text-center">Update Sell</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('footerSells.update', $footerSell->id) }}">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="col-12">
                            <div class="form-group">
                                <label for="sell_item">Sell Item</label>
                                <input type="text" id="sell_item" class="form-control" name="sell_item" value="{{ $footerSell->sell_item }}" placeholder="Enter sell item">
                                @error('sell_item')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="link">Link</label>
                                <input type="text" id="link" class="form-control" name="link" value="{{ $footerSell->link }}" placeholder="Enter link">
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