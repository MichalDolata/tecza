@extends('layouts.admin')

@section('title', 'Edytuj następne spotkanie')

@section('content')
    @include('partials.admin.alerts')

    <form method="POST" action="{{ action('AdminNextMatchController@update') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <br>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="active" {{ $nextMatch->active ? 'checked' : '' }}> Aktywne
            </label>
        </div>
        <div class="form-group">
            <label for="opponent">Przeciwnik</label>
            <input type="text" class="form-control" id="opponent" name="opponent" value="{{ old('opponent', $nextMatch->opponent) }}">
        </div>
        <div class="form-group">
            <label for="image">Logo</label>
            <input type="file" name="image" id="image">
        </div>
        <div class="form-group">
            <label for="place">Miejsce</label>
            <input type="text" class="form-control" id="place" name="place" value="{{ old('place', $nextMatch->place) }}">
        </div>
        <div class="form-group">
            <label for="date">Data</label>
            <input type="date" class="form-control" id="date" name="date"
                   value="{{ $nextMatch->date }}">
        </div>
        <div class="form-group">
            <label for="time">Godzina</label>
            <input type="time" class="form-control" id="time" name="time"
                   value="{{ $nextMatch->time }}">
        </div>
        <label class="radio-inline">
            <input type="radio" name="type" value="home" {{ $nextMatch->type === 'home' ? 'checked' : '' }}> Dom
        </label>
        <label class="radio-inline">
            <input type="radio" name="type" value="away" {{ $nextMatch->type === 'away' ? 'checked' : '' }}> Wyjazd
        </label><br><br>
        <input type="submit" class="btn btn-primary" value="Edytuj">
    </form>
@endsection