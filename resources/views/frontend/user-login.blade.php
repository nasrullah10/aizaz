@extends('frontend.layouts.master')
@section('title', __('Login'))
@section('content')

    <div class="container">
        <div class="mb-4">
            <h1 class="text-center">Login</h1>
        </div>
        <div class="my-4 my-xl-8">
            <div class="col-md-5 mx-auto">
                <div class="border-bottom border-color-1 mb-6">
                    <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Login</h3>
                </div>
                <p class="text-gray-90 mb-4">Welcome back! Sign in to your account.</p>

                <form method="POST" action="{{ route('login') }}" class="js-validate" novalidate="novalidate">
                    @csrf

                    <!-- Email Address -->
                    <div class="js-form-message form-group">
                        <x-input-label for="email" :value="__('Username or Email address')" />
                        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="Username or Email address" aria-label="Username or Email address" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="js-form-message form-group mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="form-control" type="password" name="password" placeholder="Password" aria-label="Password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="js-form-message mb-3 mt-4">
                        <div class="custom-control custom-checkbox d-flex align-items-center">
                            <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                            <label class="custom-control-label form-label" for="remember_me">{{ __('Remember me') }}</label>
                        </div>
                    </div>

                    <!-- Submit Button and Forgot Password -->
                    <div class="mb-1">
                        <x-primary-button class="btn btn-primary-dark-w px-5">
                            {{ __('Login') }}
                        </x-primary-button>
                        <div class="mt-2">
                            @if (Route::has('password.request'))
                                <a class="text-blue" href="{{ route('password.request') }}">{{ __('Lost your password?') }}</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
