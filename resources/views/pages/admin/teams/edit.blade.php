@extends('layouts.admin')

@section('title', 'Edytuj drużynę')

@section('content')
    @include('partials.admin.alerts')

    <form method="POST" action="{{ action('AdminTeamController@update', [$team->slug]) }}">
        {{ csrf_field() }}
        <br>
        <div class="form-group">
            <label for="first_name">Nazwa</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $team->name) }}">
        </div>
        <input type="submit" class="btn btn-primary" value="Edytuj">
    </form>
@endsection