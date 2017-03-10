@extends('layouts.page')

@section('content')
    <div id="showContest">
        <h2>Aktualne</h2>

        <ul>
            @foreach($contests as $contest)
                <li class="position">
                    <a href="{{ action('ContestController@show', compact('contest')) }}">
                        {{ $contest->name }} &raquo;
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

@endsection