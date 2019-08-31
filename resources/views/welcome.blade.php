@extends('layouts.app')
@section('content')
    <body>
        <div class="container container--align-column welcome-title">
            <div>
            @include('svg.eolh')
            </div>
            <div class="container welcome-cta">
                <a class="button button__cta button__cta--primary" href={{route('register')}}>Sign Up</a>
                <a class="button button__cta button__cta--secondary" href={{route('login')}}>Log In</a>
            </div>
        </div>
@endsection
