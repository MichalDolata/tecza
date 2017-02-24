@extends('layouts.page')

@section('content')
    <div id="newsList">
        <ul>
            @foreach($allNews as $news)
                <li>
                    <a href="{{action('NewsController@show', [$news->slug])}}">
                        <img src="{{ $news->getThumbnailURL() }}" class="newsList__thumbnail">
                        <h3 class="newsList__title">{{$news->title}}</h3>
                        <p class="newsList__date">Dodano {{ $news->created_at->diffForHumans(null)}}</p>
                        <p class="newsList__lead">{{$news->lead}}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    {{ $allNews->links() }}
@endsection