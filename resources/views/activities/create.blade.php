@extends('layouts.app')
@section('content')
<div class="flex-form container flex-align-top">
    <div>
        <h2 class="margin-bottom-md bold">Upload Activity</h2>
    </div>
    <form method="POST" action={{route('activities.store')}} class="form container--align-column center-horizontal" enctype="multipart/form-data">
        @csrf
        <div class="form form__row">
            <input class="input" placeholder="Title" type="text" name="title">
        </div>
        @error('title')
            <div class="form form__row form__row--error">
                <span class="error">{{ $message }}</span>
            </div>
        @enderror
        <div class="form form__row">
            <label class="input__file button button__cta button__cta--secondary bold" for="route">Choose file...</label>
            <input id="route" type="file" name="route"/>
        </div>
        @error('route')
            <div class="form form__row form__row--error">
                <span class="error">{{ $message }}</span>
            </div>
        @enderror
        <div class="form form__row">
            <textarea placeholder="Description" class="textarea" name="description"></textarea>
        </div>
        <div class="form form__row flex flex-row">
            <input value="Add" type="submit" class="input button button__cta button__cta--primary bold">
        </div>
    </form>
</div>
@endsection
