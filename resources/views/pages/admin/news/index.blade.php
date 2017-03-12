@extends('layouts.admin')

@section('title', 'Aktualności')

@section('content')
    @include('partials.admin.alerts')

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Tytuł</th>
            <th class="text-center">Autor</th>
            <th class="text-center">Edytuj</th>
            <th class="text-center">Usuń</th>
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
                <td class="text-center">
                    <a href="{{action('AdminNewsController@destroy', [$news->slug])}}"
                                           onclick="event.preventDefault(); document.getElementById('delete-form{{$news->id}}').submit();">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    <form id="delete-form{{$news->id}}" action="{{action('AdminNewsController@destroy', [$news->slug])}}" method="POST" style="display: none;">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection