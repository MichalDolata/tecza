@extends('layouts.app')

@section('content')
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>Link</th>
        </tr>
    </thead>
    <tbody>
        @foreach($allNews as $news)
            <tr>
                <td>{{$news->id}}</td>
                <td>{{$news->title}}</td>
                <td>{{$news->author_id}}</td>
                <td><a href="{{action('NewsController@show', [$news->slug])}}">Show</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection