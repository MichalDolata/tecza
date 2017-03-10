@extends('layouts.page')

@section('content')
    <div id="showContest">
    <h2>{{ $contest->name }}</h2>
        <table id="contestTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Klub</th>
                    <th>Spotkania</th>
                    <th>Zwycięstwa</th>
                    <th>Remisy</th>
                    <th>Porażki</th>
                    <th>GZ</th>
                    <th>GS</th>
                    <th>BG</th>
                    <th>Punkty</th>
                </tr>
            </thead>
            <tbody>
                @foreach($table->getClubs() as $club)
                    <tr>
                        <td>{{ $club->position }}</td>
                        <td>{{ $club->name }}</td>
                        <td>{{ $club->matches }}</td>
                        <td>{{ $club->won }}</td>
                        <td>{{ $club->drawn }}</td>
                        <td>{{ $club->lost }}</td>
                        <td>{{ $club->goalsFor }}</td>
                        <td>{{ $club->goalsAgainst }}</td>
                        <td>{{ $club->goalsDiff }}</td>
                        <td>{{ $club->points }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @foreach($contest->matches->groupBy('round') as $no => $round)
        <ul>
            <li class="position">
                {{$no}}. kolejka
            </li>
            @foreach($round as $match)
            <li>
                {{ "{$match->homeClub->name} {$match->home_score}:{$match->away_score} {$match->awayClub->name}" }}
            </li>
            @endforeach
        </ul>
        @endforeach
    </div>
@endsection