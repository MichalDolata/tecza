@extends('layouts.page')

@section('content')
    <div id="teamsList">
        @foreach($teams as $team)
            <a href="{{ action('TeamController@show', compact('team')) }}">
                <div class="mask"></div>
                <div class="title">{{ $team->name }}</div>
                <img src="{{ $team->getImageURL() }}">
            </a>
        @endforeach
    </div>
@endsection