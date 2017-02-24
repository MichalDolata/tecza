@extends('layouts.page')

@section('content')
    <div id="showTeam">
        <h2>{{ $team->name }}</h2>
        <img src="{{ $team->getImageURL() }}">

        <ul>
            <li class="position">
                <h4>Trenerzy</h4>
            </li>

            @if(isset($teamMembers['coach']))
                @foreach($teamMembers['coach'] as $member)
                    @include('partials.teams.member_list')
                @endforeach
            @endif
        </ul>

        <ul>
            <li class="position">
                <h4>Bramkarze</h4>
            </li>

            @if(isset($teamMembers['goalkeeper']))
                @foreach($teamMembers['goalkeeper'] as $member)
                    @include('partials.teams.member_list')
                @endforeach
            @endif
        </ul>

        <ul>
            <li class="position">
                <h4>Obrotowi</h4>
            </li>

            @if(isset($teamMembers['pivot']))
                @foreach($teamMembers['pivot'] as $member)
                    @include('partials.teams.member_list')
                @endforeach
            @endif
        </ul>

        <ul>
            <li class="position">
                <h4>Skrzydłowi</h4>
            </li>

            @if(isset($teamMembers['wingman']))
                @foreach($teamMembers['wingman'] as $member)
                    @include('partials.teams.member_list')
                @endforeach
            @endif
        </ul>

        <ul>
            <li class="position">
                <h4>Rozgrywajacy</h4>
            </li>

            @if(isset($teamMembers['backcourt']))
                @foreach($teamMembers['backcourt'] as $member)
                    @include('partials.teams.member_list')
                @endforeach
            @endif
        </ul>
    </div>
@endsection