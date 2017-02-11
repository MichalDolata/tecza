@extends('layouts.admin')

@section('title', 'Drużyny')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nazwa</th>
            <th>Kolejność</th>
            <th>Edytuj</th>
        </tr>
        </thead>
        <tbody>
        @foreach($teams as $team)
            <tr>
                <td>{{$team->id}}</td>
                <td>{{$team->name}}</td>
                <td>{{$team->order}}</td>
                <td><a href="{{action('AdminTeamController@edit', [$team->slug])}}">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection