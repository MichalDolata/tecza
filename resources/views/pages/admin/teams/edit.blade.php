@extends('layouts.admin')

@section('title', 'Edytuj drużynę')

@section('content')
    @include('partials.admin.alerts')

    <div class="row" id="team">
        <div class="col-sm-6">
            <form method="POST" action="{{ action('AdminTeamController@update', [$team->slug]) }}">
                {{ csrf_field() }}
                <br>
                <div class="form-group">
                    <label for="first_name">Nazwa</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $team->name) }}">
                </div>
                <input type="submit" class="btn btn-primary" value="Edytuj">
            </form>
            <h3>Członkowie drużyny</h3>

            <ul class="list-group" data-position="coach">
                <li class="list-group-item active">
                    <h4>Trenerzy</h4>
                </li>

                @if(isset($teamMembers['coach']))
                    @foreach($teamMembers['coach'] as $member)
                        @include('partials.admin.teams.member_list')
                    @endforeach
                @endif
            </ul>

            <ul class="list-group" data-position="goalkeeper">
                <li class="list-group-item active">
                    <h4>Bramkarze</h4>
                </li>

                @if(isset($teamMembers['goalkeeper']))
                    @foreach($teamMembers['goalkeeper'] as $member)
                        @include('partials.admin.teams.member_list')
                    @endforeach
                @endif
            </ul>

            <ul class="list-group" data-position="pivot">
                <li class="list-group-item active">
                    <h4>Obrotowi</h4>
                </li>

                @if(isset($teamMembers['pivot']))
                    @foreach($teamMembers['pivot'] as $member)
                        @include('partials.admin.teams.member_list')
                    @endforeach
                @endif
            </ul>

            <ul class="list-group" data-position="wingman">
                <li class="list-group-item active">
                    <h4>Skrzydłowi</h4>
                </li>

                @if(isset($teamMembers['wingman']))
                    @foreach($teamMembers['wingman'] as $member)
                        @include('partials.admin.teams.member_list')
                    @endforeach
                @endif
            </ul>

            <ul class="list-group" data-position="backcourt">
                <li class="list-group-item active">
                    <h4>Rozgrywajacy</h4>
                </li>

                @if(isset($teamMembers['backcourt']))
                    @foreach($teamMembers['backcourt'] as $member)
                        @include('partials.admin.teams.member_list')
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="col-sm-6">
            <h3>Dodaj zawodnika</h3>
            <ul class="list-group">
                @foreach($members as $member)
                    <li class="list-group-item" data-id="{{$member->id}}">
                        <span>{{$member->first_name}} {{$member->last_name}} {{ $member->date_of_birth ? "({$member->date_of_birth})" : '' }}</span>
                        <span class="badge add-member" data-position="coach">Trener</span>
                        <span class="badge add-member" data-position="goalkeeper">Bramkarz</span>
                        <span class="badge add-member" data-position="pivot">Obrotowy</span>
                        <span class="badge add-member" data-position="wingman">Skrzydłowy</span>
                        <span class="badge add-member" data-position="backcourt">Rozgrywający</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('footer')
    @parent

    <script>
        $("#team").on('click', '.add-member', function () {
            var memberId = $(this).closest("li").data("id"),
                position = $(this).data("position"),
                description = $(this).siblings().first().text();
            $.ajax({
                url: window.location.pathname + '/czlonkowie',
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                   'id': memberId,
                   'position': position
                },
                method: 'PUT'
            })
                .done(function (data) {
                   var item = '<li class="list-group-item" data-id="'
                       + memberId + '" data-position="' + position + '">'
                       + description + '<span class="badge delete-member">X</span></li>';

                   $("ul[data-position=" + position + "]").append(item);
                })
        });

        $("#team").on('click', '.delete-member', function () {
            var memberId = $(this).closest("li").data("id"),
                position = $(this).closest("li").data("position"),
                container = $(this).closest('li');
            $.ajax({
                url: window.location.pathname + '/czlonkowie',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id': memberId,
                    'position': position
                },
                method: 'DELETE'
            })
                .done(function (data) {
                    container.remove();
                })
        });
    </script>
@endsection