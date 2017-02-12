@extends('layouts.admin')

@section('title', 'Utwórz rozgrywki')

@section('content')
    @include('partials.admin.alerts')

    <form method="POST" action="{{ action('AdminContestController@store') }}">
        {{ csrf_field() }}
        <br>
        <div class="form-group">
            <label for="first_name">Nazwa</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="number_of_teams">Liczba drużyn</label>
            <input type="number" class="form-control" id="number_of_teams" min="0" value="10"
                   name="number_of_teams" value="{{ old('number_of_teams') }}" required>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="revenge" {{ old('revenge') !== null ? ' checked' : '' }}> Rewanże
            </label>
        </div>
        <input type="submit" class="btn btn-primary" value="Dodaj">
    </form>
@endsection