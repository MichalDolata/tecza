@extends('layouts.admin')

@section('title', 'Aktualności')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Tytuł</th>
            <th class="text-center">Autor</th>
            <th class="text-center">Edytuj</th>
        </tr>
        </thead>
        <tbody>
        @foreach($allNews as $news)
            <tr>
                <td>{{$news->id}}</td>
                <td>{{$news->title}}</td>
                <td class="text-center">{{$news->author_id}}</td>
                <td class="text-center"><a href="{{action('AdminNewsController@edit', [$news->slug])}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection