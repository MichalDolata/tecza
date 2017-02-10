@extends('layouts.app')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Session::has('status'))
        <div class="alert alert-success">
            <p>{{ Session::get('status') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ action('AdminTeamController@update', [$team->slug]) }}">
        {{ csrf_field() }}
        <br>
        <div class="form-group">
            <label for="first_name">Nazwa</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $team->name) }}">
        </div>
        <input type="submit" class="btn btn-primary">
    </form>
@endsection