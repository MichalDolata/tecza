@extends('layouts.admin')

@section('title', 'Drużyny')

@section('content')
    @include('partials.admin.alerts')

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nazwa</th>
            <th class="text-center">Kolejność</th>
            <th class="text-center">Edytuj</th>
            <th class="text-center">Usuń</th>
        </tr>
        </thead>
        <tbody>
        @foreach($teams as $team)
            <tr>
                <td>{{$team->id}}</td>
                <td>{{$team->name}}</td>
                <td class="text-center">{{$team->order}}</td>
                <td class="text-center"><a href="{{action('AdminTeamController@edit', [$team->slug])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                <td class="text-center">
                    <a href="{{action('AdminTeamController@destroy', [$team->slug])}}"
                       onclick="event.preventDefault(); document.getElementById('delete-form{{$team->id}}').submit();">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    <form id="delete-form{{$team->id}}" action="{{action('AdminTeamController@destroy', [$team->slug])}}" method="POST" style="display: none;">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection