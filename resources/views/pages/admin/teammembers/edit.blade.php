@extends('layouts.admin')

@section('title', 'Edytuj członka')

@section('content')
    @include('partials.admin.alerts')

    <form method="POST" action="{{ action('AdminTeamMemberController@update', [$member->id]) }}">
        {{ csrf_field() }}
        <br>
        <div class="form-group">
            <label for="first_name">Imię</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $member->first_name) }}">
        </div>
        <div class="form-group">
            <label for="last_name">Nazwisko</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $member->last_name) }}">
        </div>
        <div class="form-group">
            <label for="content">Data urodzenia</label>
            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $member->date_of_birth, '') }}">
        </div>
        <input type="submit" class="btn btn-primary" value="Edytuj">
    </form>
@endsection