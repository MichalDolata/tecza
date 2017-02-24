@extends('layouts.page')

@section('content')
    <div id="news">
        <div id="news__image">
            <img src="{{ Storage::url("images/{$news->image_id}.jpg") }}">
            <div id="news__tags">
                <div class="news__tag">
                    #MKSTĘCZA
                </div>
            </div>
        </div>
        <h1 id="news__title">{{$news->title}}</h1>
        <p id="news__author">
            Autor: {{ $news->author->name }} | Dodano {{ $news->created_at->diffForHumans(null)}}
        </p>
        <p id="news__lead">
            {{ $news->lead }}
        </p>
        {{ $news->content }}
    </div>
@endsection