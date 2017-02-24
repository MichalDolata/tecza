@extends('layouts.app')

@section('content')
    <h2>{{ $contest->name }}</h2>

    <table class="table table-hover">
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
