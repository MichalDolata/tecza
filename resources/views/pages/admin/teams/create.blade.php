@extends('layouts.admin')

@section('title', 'Utwórz drużynę')

@section('content')
    @include('partials.admin.alerts')

    <form method="POST" action="{{ action('AdminTeamController@store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <br>
        <div class="form-group">
            <label for="first_name">Nazwa</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="image">Zdjęcie</label>
            <input type="file" name="image" id="image">
        </div>
        <input type="submit" class="btn btn-primary" value="Dodaj">
    </form>
@endsection