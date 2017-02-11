@extends('layouts.admin')

@section('title', 'Edytuj artykuł')

@section('content')
    @include('partials.admin.alerts')

    <form method="POST" action="{{ action('AdminNewsController@update', [$news->slug]) }}">
        {{ csrf_field() }}
        <br>
        <div class="form-group">
            <label for="title">Tytuł</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $news->title) }}">
        </div>
        <div class="form-group">
            <label for="lead">Lead</label>
            <textarea name="lead" id="lead" class="form-control" rows="2">{{ old('lead',  $news->lead) }}</textarea>
        </div>
        <div class="form-group">
            <label for="content">Treść</label>
            <textarea name="content" id="content" class="form-control" rows="15">{{ old('content',  $news->content) }}</textarea>
        </div>
        <input type="submit" class="btn btn-primary" value="Edytuj">
    </form>
@endsection