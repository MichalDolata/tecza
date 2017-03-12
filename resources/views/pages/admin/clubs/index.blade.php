@extends('layouts.admin')

@section('title', 'Kluby')

@section('content')
    @include('partials.admin.alerts')

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nazwa</th>
            <th class="text-center">Edytuj</th>
            <th class="text-center">Usuń</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clubs as $club)
            <tr>
                <td>{{$club->id}}</td>
                <td>{{$club->name}}</td>
                <td class="text-center"><a href="{{action('AdminClubController@edit', [$club->id])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                <td class="text-center">
                    <a href="{{action('AdminClubController@destroy', [$club->id])}}"
                       onclick="event.preventDefault(); document.getElementById('delete-form{{$club->id}}').submit();">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    <form id="delete-form{{$club->id}}" action="{{action('AdminClubController@destroy', [$club->id])}}" method="POST" style="display: none;">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection