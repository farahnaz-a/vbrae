{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Email Password Reset Link') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}

{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}
@extends('layouts.frontend')
@section('title')
    {{ config('app.name') }} | Login 
@endsection

@section('content')



<section class="login-wrapper">
    <div class="container">
      <div class="gradient"></div>
      <div class="login">
        <div>
          <img src="{{ asset('uploads/footerfirstrows') }}/{{ firstrows()->logo }}" class="img-fluid" alt="" />
          @if($errors->all())
          @foreach ($errors->all() as $item)
              <div class="alert alert-danger">
                  <li>{{ $item }}</li>
              </div>
          @endforeach
          @endif
          @if (session('status'))
            <p class="alert alert-success">{{ session('status') }}</p>
          @endif
          <h3 class="text-white mb-4 mt-3" style="font-weight: 400">
            Sign in
          </h3>
          <div class="social-btn steam">
            <span class="icon"><i class="fab fa-steam"></i></span>
            <span>Sign in with stream</span>
          </div>
          <div class="social-btn twitter">
            <span class="icon"><i class="fab fa-twitter"></i></span>
            <span>Sign in with twitter</span>
          </div>
          <div class="social-btn facebook">
            <span class="icon"><i class="fab fa-facebook-f"></i></span>
            <span>Sign in with facebook</span>
          </div>
          <div class="line"><span>or</span></div>
          <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group mb-2">
              <span class="input-group-text" id="basic-addon1"
                ><i class="fas fa-envelope"></i
              ></span>
              <input
                type="email"
                class="form-control form-control-sm"
                placeholder="Email Address"
                name="email"
              />
            </div>
            <div class="input-group mb-2">
              <span class="input-group-text" id="basic-addon1"
                ><i class="fas fa-unlock"></i
              ></span>
              <input
                type="password"
                class="form-control form-control-sm"
                placeholder="Password"
                name="password"
              />
            </div>
            <div class="d-flex justify-content-between">
              <div class="form-check mb-2">
                <input
                  class="form-check-input"
                  type="checkbox"
                  value=""
                  id="remember"
                />
                <label class="form-check-label" for="remember">
                  Remember Me
                </label>
              </div>
              <a
                href="#"
                class="text-white"
                data-bs-toggle="modal"
                data-bs-target="#exampleModal"
                >Forget Password?</a
              >
            </div>
            <button
              type="submit"
              class="btn btn-animation btn-sm btn-green w-100 mb-2"
            >
              <span class="icon"><i class="fas fa-sign-in-alt"></i></span>
              <span class="text">Sign in</span>
            </button>
            <div class="create">
              Don't have an account?
              <span
                class="text-white pnt"
                data-bs-toggle="modal"
                data-bs-target="#create"
                >Create one for free</span
              >
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- forget password modal -->
  <div
    class="modal fade"
    id="myModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <i class="fas fa-lock me-2"></i>Forget your password
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
            <div class="input-group mb-2">
              <span class="input-group-text" id="basic-addon1"
                ><i class="fas fa-envelope"></i
              ></span>
              <input
                type="email"
                name="email"
                class="form-control form-control-sm"
                placeholder="Email Address"
              />
            </div>
            <button type="submit" class="btn btn-sm btn-secondary w-100">
              Reset Password
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $("#myModal").modal('show');
    });
</script> 
@endsection
