@extends('layouts.admin')

@section('title', 'Członkowie')

@section('content')
    @include('partials.admin.alerts')

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Data urodzenia</th>
            <th class="text-center">Edytuj</th>
            <th class="text-center">Usuń</th>
        </tr>
        </thead>
        <tbody>
        @foreach($members as $member)
            <tr>
                <td>{{$member->id}}</td>
                <td>{{$member->first_name}}</td>
                <td>{{$member->last_name}}</td>
                <td>{{$member->date_of_birth}}</td>
                <td class="text-center"><a href="{{action('AdminTeamMemberController@edit', [$member->id])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                <td class="text-center">
                    <a href="{{action('AdminTeamMemberController@destroy', [$member->id])}}"
                       onclick="event.preventDefault(); document.getElementById('delete-form{{$member->id}}').submit();">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    <form id="delete-form{{$member->id}}" action="{{action('AdminTeamMemberController@destroy', [$member->id])}}" method="POST" style="display: none;">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection