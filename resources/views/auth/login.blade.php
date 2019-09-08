@extends('layouts.app')

@section('content')
<div class="flex-form container">
    <div class="form-container">
        <div class="form-title-svg">
            @include('svg.eolh')
        </div>
        <form action={{ route('login') }} method="POST" class="form container--align-column center-horizontal">
            @csrf
            <div class="form form__row">
                <input placeholder="Email" name="email" type="email" class="input" value="{{ old('email') }}" required>            
            </div>
            <div class="form form__row">
                <input placeholder="Password" name="password" type="password" class="input" required>            
            </div>
            @error('email')
                <div class="form form__row">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
            @error('password')
                <div class="form form__row">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
            <div class="form form__row">
                <div class="checkbox-container">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="checkbox" class="" for="remember">
                        Remember Me
                    </label>
                </div>
            </div>
            <div class="form form__row flex flex-row">
                <input value="Login" type="submit" class="input button button__cta button__cta--primary center-horizontal bold">
                <a href={{ route('password.request') }} class="input button button__cta button__cta--secondary center-horizontal bold">Reset</a>
            </div>
        </form>
    </div>
</div>
@endsection