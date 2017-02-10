@extends('layouts.app')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Order</th>
            <th>Edit</th>
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