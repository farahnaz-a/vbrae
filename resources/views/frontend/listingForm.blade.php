@extends('layouts.frontend')

@section('content')
<div class="page-header">
    <div class="container">
        <h3><i class="fas fa-tags me-2"></i>Add Listing</h3>
    </div>
</div>
<section class="game-overview">
    <div class="container">
        <div class="page-content search-section">
            <div class="content-header">
                <h5>Select Game</h5>
            </div>
            <div class="content-body">
                <div class="search">
                    <form action="{{ route('game.search') }}" method="GET">
                        <div class="input-group my-3">
                            <input type="submit" value="Search" class="input-group-text pnt">
                            {{-- <i class="fas fa-search"></i> --}}

                            <input type="text" class="form-control form-control-lg" placeholder="Search" name="name" />
                    </form>
                </div>
            </div>
        </div>
        <div class="content-footer">
            <p>
                Game not found?
                <a href="./add-game.html" class="add-btn ms-3"><i class="fas fa-plus me-2"></i>Add Game</a>
            </p>
        </div>
    </div>
    <form action="{{ route('listings.store') }}" class="selected-section active"
        style="overflow: hidden; transition: 0.3s ease-in-out">
        <div class="page-content">
            <div class="content-header">
                <h5>Selected Game</h5>
            </div>
            <div class="content-body">
                <div class="selected-game">
                    <img src="{{ asset('games') }}/{{ $data->cover }}" alt="" />
                    <div>
                        <h6>{{ $data->name }}
                            <small>{{ \Carbon\Carbon::parse($data->release_date)->format('Y') }}</small></h6>
                        <span
                            style="background-color: {{ $data->getPlatform->color }}">{{ $data->getPlatform->name }}</span>
                    </div>
                </div>
            </div>
            <div class="content-footer">
                <p>
                    <span class="reset-btn me-2"><i class="fas fa-exchange-alt me-2"></i>Reselect Game</span>
                    Warning: All inputs will be cleared!
                </p>
            </div>
        </div>
        <div class="page-content search-section">
            <div class="content-header">
                <h5><i class="fas fa-tag me-2"></i>Details</h5>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-sm-6">
                        {{-- <div class="form-check my-3">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                Default checkbox
                            </label>
                        </div> --}}
                    </div>
                    <div class="col-sm-6">
                        {{-- <div class="form-check my-3">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked />
                            <label class="form-check-label" for="flexCheckChecked">
                                Checked checkbox
                            </label>
                        </div> --}}
                    </div>
                    <div class="col-sm-6">
                        <label for="">Platform</label>
                        <select class="form-select mb-3">
                               <option value="{{ $data->platform_id }}">{{ $data->getPlatform->name }}</option>
                            @foreach (\App\Models\Platform::find($data->platform_id)->get() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="delivery">Select Delivery Type</label>
                        <select id="delivery" class="form-select mb-3">
                            <option value="Auto delivery">Auto delivery</option>
                            <option value="Manual delivery">Manual delivery</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="region">Select Region</label>
                        <select id="region" class="form-select mb-3">
                                <option value="Global">Global</option>
                            @foreach (\App\Models\Country::orderBy('name', 'asc')->get() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label id="game_key_input">Game Key</label>
                        <div class="d-flex">
                            <textarea class="form-control inline" rows="3" placeholder="Use comma after every key."
                                id="game_key_input"></textarea>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div id="editor"></div>
                    </div>
                </div>
            </div>
            <div class="sell-btn active">
                <h2><i class="fas fa-shopping-basket me-2"></i> Sell</h2>
            </div>
            <div class="content-header seller">
                <h5><i class="fas fa-shopping-basket me-2"></i>Seller Details</h5>
                <div class="form-check form-switch">
                    <label class="form-check-label" for="price_suggestion">Price suggestions
                    </label>
                    <input class="form-check-input" type="checkbox" id="price_suggestion" />
                </div>
            </div>
            <div class="content-body">
                <label for="price">Select Region</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
                    <input id="price" type="text" class="form-control form-control-lg" placeholder="Price in Euro..." />
                </div>
                <small class="text-muted">
                    <i class="fas fa-chart-line"></i> Average selling price for Age
                    of Empires IV: € 77,67</small>
                <div class="payment-system">
                    <h5><i class="fas fa-shield-alt me-2"></i>Secure Payment</h5>
                    <div>
                        <div>
                            <small>You'll get</small>
                            <small>Secure<i class="fas fa-shield-alt ms-2"></i></small>
                        </div>
                        <div>
                            <span>€ 0,00</span>
                            <small>Fast<i class="fas fa-rocket ms-2"></i></small>
                        </div>
                        <div>
                            <small>Fees € 0,00</small>
                            <small>Easy<i class="fas fa-child ms-2"></i></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-3 text-end">
                <button class="btn btn-green">
                    <i class="fas fa-plus me-2"></i>Add Listing
                </button>
            </div>
        </div>
    </form>


</section>
</section>
@endsection
