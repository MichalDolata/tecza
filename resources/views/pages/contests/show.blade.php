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
                    @if($club->name === "MKS Tęcza Kościan")
                        <td><strong>{{ $club->position }}</strong></td>
                        <td><strong>{{ $club->name }}</strong></td>
                        <td><strong>{{ $club->mainStats->matches }}</strong></td>
                        <td><strong>{{ $club->mainStats->won }}</strong></td>
                        <td><strong>{{ $club->mainStats->drawn }}</strong></td>
                        <td><strong>{{ $club->mainStats->lost }}</strong></td>
                        <td><strong>{{ $club->mainStats->goalsFor }}</strong></td>
                        <td><strong>{{ $club->mainStats->goalsAgainst }}</strong></td>
                        <td><strong>{{ $club->mainStats->goalsDiff }}</strong></td>
                        <td><strong>{{ $club->mainStats->points }}</strong></td>
                    @else
                        <td>{{ $club->position }}</td>
                        <td>{{ $club->name }}</td>
                        <td>{{ $club->mainStats->matches }}</td>
                        <td>{{ $club->mainStats->won }}</td>
                        <td>{{ $club->mainStats->drawn }}</td>
                        <td>{{ $club->mainStats->lost }}</td>
                        <td>{{ $club->mainStats->goalsFor }}</td>
                        <td>{{ $club->mainStats->goalsAgainst }}</td>
                        <td>{{ $club->mainStats->goalsDiff }}</td>
                        <td>{{ $club->mainStats->points }}</td>
                    @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        @foreach($contest->matches->groupBy('round') as $no => $round)
        <ul>
            <li class="position">
                {{$no}}. kolejka
            </li>
            <li>
                <table>
            @foreach($round as $match)
                @if($match->homeClub and $match->awayClub)
                <tr>
                    @if($match->homeClub->name === "MKS Tęcza Kościan")
                        <td><strong>{{$match->homeClub->name}}</strong></td>
                    @else
                        <td>{{$match->homeClub->name}}</td>
                    @endif
                    <td>{{ "{$match->home_score}:{$match->away_score}" }}</td>
                        @if($match->awayClub->name === "MKS Tęcza Kościan")
                            <td><strong>{{$match->awayClub->name}}</strong></td>
                        @else
                            <td>{{$match->awayClub->name}}</td>
                        @endif
                </tr>
                @endif
            @endforeach
                </table>
            </li>
        </ul>
        @endforeach
    </div>
@endsection