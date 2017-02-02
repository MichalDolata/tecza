@extends('layouts.app')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ action('AdminNewsController@store') }}">
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
        <input type="submit" class="btn btn-primary" value="Utwórz">
    </form>
@endsection