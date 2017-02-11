@extends('layouts.admin')

@section('title', 'Utwórz drużynę')

@section('content')
    @include('partials.admin.alerts')

    <form method="POST" action="{{ action('AdminTeamController@store') }}">
        {{ csrf_field() }}
        <br>
        <div class="form-group">
            <label for="first_name">Nazwa</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>
        <input type="submit" class="btn btn-primary" value="Dodaj">
    </form>
@endsection