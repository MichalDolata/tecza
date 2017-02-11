@extends('layouts.admin')

@section('title', 'Drużyny')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nazwa</th>
            <th class="text-center">Kolejność</th>
            <th class="text-center">Edytuj</th>
        </tr>
        </thead>
        <tbody>
        @foreach($teams as $team)
            <tr>
                <td>{{$team->id}}</td>
                <td>{{$team->name}}</td>
                <td class="text-center">{{$team->order}}</td>
                <td class="text-center"><a href="{{action('AdminTeamController@edit', [$team->slug])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection