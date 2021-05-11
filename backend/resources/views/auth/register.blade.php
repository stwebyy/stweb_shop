@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="role_id" value="2">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="last_name" class="col-form-label text-md-right">{{ __('last_name') }}</label>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" placeholder="{{ __('last_name') }}" autofocus>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="first_name" class="col-form-label text-md-right">{{ __('first_name') }}</label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" placeholder="{{ __('first_name') }}" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="last_name_ruby" class="col-form-label text-md-right">{{ __('last_name_ruby') }}</label>
                                <input id="last_name_ruby" type="text" class="form-control @error('last_name_ruby') is-invalid @enderror" name="last_name_ruby" value="{{ old('last_name_ruby') }}" required autocomplete="last_name_ruby" placeholder="{{ __('last_name_ruby') }}" autofocus>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="first_name_ruby" class="col-form-label text-md-right">{{ __('first_name_ruby') }}</label>
                                <input id="first_name_ruby" type="text" class="form-control @error('first_name_ruby') is-invalid @enderror" name="first_name_ruby" value="{{ old('first_name_ruby') }}" required autocomplete="first_name_ruby" placeholder="{{ __('first_name_ruby') }}" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="gender" class="col-form-label text-md-right">{{ __('gender') }}</label>
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                    <option value="1">男性</option>
                                    <option value="2">女性</option>
                                    <option value="3">その他</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-right">{{ __('email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="{{ __('email') }}" autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-3">
                                <label for="phone_number" class="col-form-label text-md-right">{{ __('phone_number') }}</label>
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required placeholder="{{ __('phone_number') }}" autocomplete="phone_number">
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-3">
                                <label for="birthday" class="col-form-label text-md-right">{{ __('birthday') }}</label>
                                <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" required placeholder="{{ __('birthday') }}" autocomplete="birthday">
                                @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-3">
                                <label for="postal_code" class="col-form-label text-md-right">{{ __('postal_code') }}</label>
                                <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code') }}" required placeholder="{{ __('postal_code') }}" autocomplete="postal_code">
                                @error('postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-3">
                                <label for="pref_id" class="col-form-label text-md-right">{{ __('pref_id') }}</label>
                                <select id="pref_id" class="form-control @error('pref_id') is-invalid @enderror" name="pref_id" required>
                                    @php
                                     $prefs = \App\Models\Pref::all();   
                                    @endphp
                                    @foreach ($prefs as $pref)
                                    <option value="{{ $pref->id }}">{{ $pref->name }}</option>
                                    @endforeach
                                </select>
                                @error('pref_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="city" class="col-form-label text-md-right">{{ __('city') }}</label>
                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required placeholder="{{ __('city') }}" autocomplete="city">
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="block" class="col-form-label text-md-right">{{ __('block') }}</label>
                            <input id="block" type="text" class="form-control @error('block') is-invalid @enderror" name="block" value="{{ old('block') }}" required placeholder="{{ __('block') }}" autocomplete="block">
                            @error('block')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="building" class="col-form-label text-md-right">{{ __('building') }}</label>
                            <input id="building" type="text" class="form-control @error('building') is-invalid @enderror" name="building" value="{{ old('building') }}" required placeholder="{{ __('building') }}" autocomplete="building">
                            @error('building')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-right">{{ __('password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="{{ __('password') }}" autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="{{ __('Confirm Password') }}" autocomplete="new-password">
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
