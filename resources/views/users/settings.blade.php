@extends('layouts.frontend')

@section('title')
    {{ config('app.name') }} | {{ $user->name }} Settings 
@endsection

@section('content')
<section class="game-overview" >
    <div class="container">
      <div class="tab-content" id="myTabContent">
        <div
          class="tab-pane fade show active"
          id="profile"
          role="tabpanel"
          aria-labelledby="home-tab"
        >
          <form action="{{ route('user.update', $user->id) }}" style="margin-top: 100px;" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="page-content">
              <div class="content-header">
                <h5>Profile</h5>
              </div>
              <div class="content-body">
                <div class="mb-3">
                  <label for="username">Username</label>
                  <div class="input-group">
                    <span
                      class="input-group-text"
                      style="padding: 0.375rem 0.75rem"
                      ><i class="fas fa-user"></i
                    ></span>
                    <input
                      id="username"
                      type="text"
                      class="form-control"
                      placeholder="Enter the username"
                      name="name"
                      value="{{ $user->name }}"
                    />
                  </div>
                  <small
                    ><i class="fas fa-link me-2"></i>Your dashboard link:
                    https://dev.vbrae.com/users/dashboard/{{ Str::slug($user->name) }}</small
                  >
                </div>
                <div class="mb-3">
                  <label for="email">Email Address</label>
                  <div class="input-group">
                    <span
                      class="input-group-text"
                      style="padding: 0.375rem 0.75rem"
                      ><i class="fas fa-user"></i
                    ></span>
                    <input
                      id="email"
                      type="email"
                      class="form-control"
                      name="email"
                      placeholder="Enter email address"
                      value="{{ $user->email }}"
                    />
                  </div>
                </div>
                <div class="mb-3">
                  <label for="profile">Change Profile Image</label>
                  <input id="profile" type="file" class="form-control" name="profile_photo_path"/>
                </div>
                <div class="mb-3">
                  <div class="d-flex flex-wrap text-nowrap">
                    <span class="badge bg-secondary me-2"
                      ><img
                        class="img-fluid me-2"
                        src="{{ $user->profile_photo_url }}"
                        style="width: 14px; height: 14px"
                        alt=""
                      /></span
                    >
                    {{-- <button class="btn btn-sm btn-green">
                      <i class="fas fa-map-marker"></i> Change Location
                    </button> --}}
                  </div>
                </div>
              </div>
            </div>
            <div class="my-3 text-end">
              <button class="btn btn-green">
                <i class="fas fa-plus me-2"></i>Save Settings
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection