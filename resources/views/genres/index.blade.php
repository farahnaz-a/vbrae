@extends('layouts.dashboard')
                
@section('title')
    {{ config('app.name') }} - Admin Genres List
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
                    <li class="breadcrumb-item active">Genres
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
                <h4 class="card-title">Genres Lists</h4>
                {{-- <div class="float-right">
                    <a href="" class="btn btn-primary">+ Add Genres</a>
                </div> --}}
            </div>
            <div class="card-body">
             
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Games</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($genres as $key => $genre)
                        <tr>
                            <td>{{ $genres->firstItem() + $key  }}</td>
                            <td>
                                
                                <span class="font-weight-bold">{{ ucfirst($genre->name) }}</span>
                            </td>
                            <td><span class="badge badge-pill badge-light-primary mr-1">{{ $genre->getGames->count() }}</span></td>
                            {{-- <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                    </button>
                                </div>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $genres->links() }}
            </div>
        </div>
    </div>
</div>
@endsection