@extends('layouts.admin')

@section('title', 'Rozgrywki')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nazwa</th>
            <th class="text-center">Liczba zespołów</th>
            <th class="text-center">Edytuj</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contests as $contest)
            <tr>
                <td>{{$contest->id}}</td>
                <td>{{$contest->name}}</td>
                <td class="text-center">{{$contest->number_of_teams}}</td>
                <td class="text-center"><a href="{{action('AdminContestController@edit', [$contest->id])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection