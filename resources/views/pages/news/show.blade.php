@extends('layouts.app')

@section('content')
    <h2>{{ $news->title }}</h2>
    <h4>by {{ $news->author->name }}</h4>
    <p><b>{{ $news->lead }}</b></p>
    <p>
        {{ $news->content }}
    </p>
@endsection