@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow border-0">
                <div class="card-body p-4">
                    <h4 class="text-center mb-4 text-primary">
                        <i class="bi bi-person-circle me-2"></i> {{ __('messages.auth.login') }}
                    </h4>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('messages.auth.email') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('messages.auth.password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" required>
                            </div>
                            @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('messages.auth.remember') }}
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right me-1"></i> {{ __('messages.auth.login') }}
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <small>
                                {{ __('messages.auth.no_account') }}
                                <a href="{{ route('register') }}">{{ __('messages.auth.register') }}</a>
                            </small>
                        </div>

                        {{--                    @if (Route::has('password.request'))--}}
                        {{--                        <div class="text-center mt-2">--}}
                        {{--                            <a href="{{ route('password.request') }}">{{ __('messages.auth.forgot') }}</a>--}}
                        {{--                        </div>--}}
                        {{--                    @endif--}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
