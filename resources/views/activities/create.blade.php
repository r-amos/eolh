@extends('layouts.app')
@section('content')
<div class="flex-form container flex-align-top">
    <div>
        <h2 class="margin-bottom-md bold">Upload Activity</h2>
    </div>
    <form method="POST" action={{route('activities.store')}} class="form container--align-column center-horizontal">
        @csrf
        <div class="form form__row">
            <input class="input" placeholder="Title" type="text">
        </div>
        <div class="form form__row">
            <label class="input__file button button__cta button__cta--secondary bold" for="route">Choose file...</label>
            <input id="route" type="file" name="route"/>
        </div>
        <div class="form form__row">
            <textarea placeholder="Description" class="textarea"></textarea>
        </div>
        <div class="form form__row flex flex-row">
            <input value="Add" type="submit" class="input button button__cta button__cta--primary bold">
        </div>
    </form>
</div>
@endsection
