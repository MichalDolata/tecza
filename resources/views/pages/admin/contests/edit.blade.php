@extends('layouts.admin')

@section('title', 'Edytuj rozgrywki')

@section('content')
    @include('partials.admin.alerts')
    <div class="row list-container">
        <div class="col-sm-6">
            <form method="POST" action="{{ action('AdminContestController@update', [$contest->id]) }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <br>
                <div class="form-group">
                    <label for="name">Nazwa</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $contest->name) }}">
                </div>

                <div class="form-group">
                    <label for="number_of_teams">Liczba drużyn</label>
                    <input type="text" class="form-control" id="number_of_teams"
                           name="number_of_teams" value="{{ $contest->number_of_teams }}" disabled>
                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="revenge"{{ $contest->revenge !== 0 ? ' checked' : '' }} disabled> Rewanże
                    </label>
                </div>
                <input type="submit" class="btn btn-primary" value="Edytuj">
                <a href="{{ action('AdminTimetableController@edit', ['id' => $contest->id]) }}" class="btn btn-default">Terminarz</a>
            </form>
            <hr>
            <ul class="list-group" id="contest_clubs">
                <li class="list-group-item active">
                    <h4>Drużyny (<span id="number_of_clubs">{{ $contest->clubs->count() }}</span>/{{ $contest->number_of_teams }})</h4>
                </li>
                @foreach($contest->clubs as $club)
                    <li class="list-group-item" data-id="${{$club->id}}">
                        <span>{{$club->name}}</span>
                        <span class="badge delete-club">X</span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-6">
            <h3>Dodaj druzyne</h3>
            <ul class="list-group">
                @foreach($clubs as $club)
                    <li class="list-group-item" data-id="{{$club->id}}">
                        <span>{{$club->name}}</span>
                        <span class="badge add-club">+</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('footer')
    @parent

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".list-container").on('click', '.add-club', function () {
            var memberId = $(this).closest("li").data("id"),
                description = $(this).siblings().first().text();
            $.ajax({
                url: window.location.pathname + '/kluby',
                data: {
                    'id': memberId
                },
                method: 'PUT'
            })
                .done(function (data) {
                    var item = '<li class="list-group-item" data-id="'
                        + memberId + '">'
                        + description + '<span class="badge delete-club">X</span></li>';

                    $("#contest_clubs").append(item);
                    console.log()
                    $("#number_of_clubs").text(parseInt($("#number_of_clubs").text()) + 1);
                })
        });

        $(".list-container").on('click', '.delete-club', function () {
            var memberId = $(this).closest("li").data("id"),
                container = $(this).closest('li');
            $.ajax({
                url: window.location.pathname + '/kluby',
                data: {
                    'id': memberId
                },
                method: 'DELETE'
            })
                .done(function (data) {
                    container.remove();
                    $("#number_of_clubs").text(parseInt($("#number_of_clubs").text()) - 1);
                })
        });
    </script>
@endsection