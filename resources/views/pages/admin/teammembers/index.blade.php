@extends('layouts.admin')

@section('title', 'Członkowie')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Data urodzenia</th>
            <th>Edytuj</th>
        </tr>
        </thead>
        <tbody>
        @foreach($members as $member)
            <tr>
                <td>{{$member->id}}</td>
                <td>{{$member->first_name}}</td>
                <td>{{$member->last_name}}</td>
                <td>{{$member->date_of_birth}}</td>
                <td><a href="{{action('AdminTeamMemberController@edit', [$member->id])}}">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection