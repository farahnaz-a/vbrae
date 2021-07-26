@extends('layouts.dashboard')
                
@section('title')
    {{ config('app.name') }} - Admin Games List
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
                    <li class="breadcrumb-item active">Games
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
                <h4 class="card-title">Game Lists</h4>
            </div>
            <div class="card-body">
             
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Platform</th>
                            <th>Publishers</th>
                            <th>Release date</th>
                            <th>Active Listing</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($games as $key => $game)
                        <tr>
                            <td>{{ $games->firstItem() + $key  }}</td>
                            <td>
                                <img src="{{ asset('games') }}/{{ $game->cover }}" class="mr-75" height="20" width="20" alt="game image not found">
                                <span class="font-weight-bold">{{ ucfirst($game->name) }}</span>
                            </td>
                            <td>{{ $game->getPlatform->name }}</td>
                            <td>
                                {{ $game->publisher }}
                            </td>
                            <td><span class="badge badge-pill badge-light-primary mr-1">{{ $game->release_date }}</span></td>
                            <td>
                              
                               {{ $game->getListing->count() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $games->links() }}
            </div>
        </div>
    </div>
</div>
@endsection