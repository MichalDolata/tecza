@extends('layouts.page')

@section('content')
    <div id="portal">
        <div id="main_article">
            <a href="{{ action('NewsController@show', ['news' => $news[0]]) }}">
                <div class="mask"></div>
                <div class="title"><h3>{{ $news[0]->title }}</h3></div>
                <div><img src="{{ $news[0]->getImageURL() }}"></div>
            </a>
        </div>
        <div id="secondary_articles">
            @if(isset($news[1]))
            <div class="secondary_article">
                <a href="{{ action('NewsController@show', ['news' => $news[1]]) }}">
                    <div class="mask"></div>
                    <div class="title"><h3>{{ $news[1]->title }}</h3></div>
                    <div><img src="{{ $news[1]->getImageURL() }}"></div>
                </a>
            </div>
            @endif
            @if(isset($news[2]))
            <div class="secondary_article">
                <a href="{{ action('NewsController@show', ['news' => $news[2]]) }}">
                    <div class="mask"></div>
                    <div class="title"><h3>{{ $news[2]->title }}</h3></div>
                    <div><img src="{{ $news[2]->getImageURL() }}"></div>
                </a>
            </div>
            @endif
        </div>
    </div>
@endsection
