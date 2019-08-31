@extends('layouts.app')
@section('content')
<div class="flex-form container">
    <div class="form-container">
        <div class="form-title">
                @include('svg.eolh')
            </div>
            @if(session('status'))
                <div class="notification notification--success">{{session('status')}}</div>
            @endif
            <form action={{ route('password.update') }} method="POST" class="form container--align-column center-horizontal">
                @csrf
                
                <input type="hidden" name="token" value="{{ $token }}">

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
                    <input value="Reset Password" type="submit" class="input button button__cta button__cta--primary center-horizontal bold">         
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
