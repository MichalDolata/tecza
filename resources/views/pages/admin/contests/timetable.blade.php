@extends('layouts.admin')

@section('title', 'Edytuj terminarz')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <form method="POST" action="{{ action('AdminTimetableController@update', ['id' => $contest->id]) }}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                @foreach($contest->matches->groupBy('round') as $no => $round)
                    <ul class="list-group">
                        <li class="list-group-item active">
                            {{$no}}. kolejka
                        </li>
                        @foreach($round as $match)
                            <li class="list-group-item form-inline text-center">
                                <select name="matches[{{$match->id}}][homeTeam]" class="form-control">
                                    <option value=""></option>
                                @foreach($contest->clubs as $club)
                                    <option value="{{ $club->id }}" {{ $match->home_id === $club->id ? 'selected' : ''}}>{{ $club->name }}</option>
                                    @endforeach
                                    </select>
                                <input type="number" name="matches[{{$match->id}}][homeScore]"
                                       min="0" class="form-control text-center" style="max-width: 65px" value="{{$match->home_score}}"> :
                                <input type="number" name="matches[{{$match->id}}][awayScore]"
                                       min="0" class="form-control text-center" style="max-width: 65px" value="{{$match->away_score}}">
                                <select name="matches[{{$match->id}}][awayTeam]" class="form-control">
                                    <option value=""></option>
                                    @foreach($contest->clubs as $club)
                                        <option value="{{ $club->id }}" {{ $match->away_id === $club->id ? 'selected' : ''}}>{{ $club->name }}</option>
                                    @endforeach
                                </select>
                                <input type="datetime-local" name="matches[{{$match->id}}][date]" class="form-control"
                                    value="{{ $match->date ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $match->date)->format('Y-m-d\TH:i:s') : ''}}">
                            </li>
                        @endforeach
                    </ul>
                @endforeach
                <input type="submit" class="btn btn-primary" value="Edytuj">
            </form>
        </div>
    </div>
@endsection