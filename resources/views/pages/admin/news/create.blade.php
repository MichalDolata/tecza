@extends('layouts.admin')

@section('title', 'Dodaj artykuł')

@section('content')
    @include('partials.admin.alerts')

    <form method="POST" action="{{ action('AdminNewsController@store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <br>
        <div class="form-group">
            <label for="title">Tytuł</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="lead">Lead</label>
            <textarea name="lead" id="lead" class="form-control" rows="2">{{ old('lead') }}</textarea>
        </div>
        <div class="form-group">
            <label for="content">Treść</label>
            <textarea name="content" id="content" class="form-control" rows="15">{{ old('content') }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Zdjęcie</label>
            <input type="file" name="image" id="image">
        </div>
        <input type="submit" class="btn btn-primary" value="Dodaj">
    </form>
@endsection