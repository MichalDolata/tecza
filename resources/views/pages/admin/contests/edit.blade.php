@extends('layouts.admin')

@section('title', 'Edytuj rozgrywki')

@section('content')
    @include('partials.admin.alerts')

    <form method="POST" action="{{ action('AdminContestController@update', [$contest->id]) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <br>
        <div class="form-group">
            <label for="name">Nazwa</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $contest->name) }}">
        </div>

        <div class="form-group">
            <label for="number_of_teams">Liczba drużyn</label>
            <input type="text" class="form-control" id="number_of_teams"
                   name="number_of_teams" value="{{ old('number_of_teams', $contest->number_of_teams) }}">
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="revenge"{{ $contest->revenge !== 0 ? ' checked' : '' }} disabled> Rewanże
            </label>
        </div>
        <input type="submit" class="btn btn-primary" value="Edytuj">
    </form>
@endsection