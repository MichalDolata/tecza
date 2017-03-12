@extends('layouts.admin')

@section('title', 'Rozgrywki')

@section('content')
    @include('partials.admin.alerts')

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nazwa</th>
            <th class="text-center">Liczba zespołów</th>
            <th class="text-center">Edytuj</th>
            <th class="text-center">Usuń</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contests as $contest)
            <tr>
                <td>{{$contest->id}}</td>
                <td>{{$contest->name}}</td>
                <td class="text-center">{{$contest->number_of_teams}}</td>
                <td class="text-center"><a href="{{action('AdminContestController@edit', [$contest->id])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                <td class="text-center">
                    <a href="{{action('AdminContestController@destroy', [$contest->id])}}"
                       onclick="event.preventDefault(); document.getElementById('delete-form{{$contest->id}}').submit();">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    <form id="delete-form{{$contest->id}}" action="{{action('AdminContestController@destroy', [$contest->id])}}" method="POST" style="display: none;">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection