@extends('layouts.app')

@section('content')
<div class="register container">
    <div class="form-container">
        <div class="form-title">
                @include('svg.eolh')
            </div>
            <form action={{ route('register') }} method="POST" class="form container--align-column center-horizontal">
                @csrf
                <div class="form form__row">
                    <input placeholder="Name" name="name" type="text" class="input" value="{{ old('name') }}" required>            
                </div>
                @error('name')
                    <div class="form form__row">
                        <span class="error">{{ $message }}</span>
                    </div>
                @enderror
                <div class="form form__row">
                    <input placeholder="Email" name="email" type="email" class="input" value="{{ old('email') }}" required>            
                </div>
                @error('email')
                    <div class="form form__row">
                        <span class="error">{{ $message }}</span>
                    </div>
                @enderror
                <div class="form form__row">
                    <input placeholder="Password" name="password" type="password" class="input" required>            
                </div>
                <div class="form form__row">
                    <input placeholder="Password Confirmation" name="password_confirmation" type="password" class="input" required>            
                </div>
                @error('password')
                    <div class="form form__row">
                        <span class="error">{{ $message }}</span>
                    </div>
                @enderror
                <div class="form form__row">
                    <input value="Sign Up" type="submit" class="input button button__cta button__cta--primary center-horizontal bold">         
                </div>
            </form>
    </div>
</div>
@endsection
