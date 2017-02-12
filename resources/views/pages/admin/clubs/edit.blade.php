@extends('layouts.admin')

@section('title', 'Edytuj klub')

@section('content')
    @include('partials.admin.alerts')

    <form method="POST" action="{{ action('AdminClubController@update', [$club->id]) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <br>
        <div class="form-group">
            <label for="name">Nazwa</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $club->name) }}">
        </div>
        <input type="submit" class="btn btn-primary" value="Edytuj">
    </form>
@endsection