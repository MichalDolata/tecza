@extends('layouts.admin')

@section('title', 'Kluby')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nazwa</th>
            <th class="text-center">Edytuj</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clubs as $club)
            <tr>
                <td>{{$club->id}}</td>
                <td>{{$club->name}}</td>
                <td class="text-center"><a href="{{action('AdminClubController@edit', [$club->id])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection