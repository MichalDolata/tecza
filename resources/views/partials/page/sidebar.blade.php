<div id="sidebar">
    <div class="sideBlock">
        <div class="sideBlock__header">
            NASTĘPNE SPOTKANIE
        </div>
        <div class="sideBlock__content" id="nextMatch">
            <div id="nextMatch__logos">
                <div class="nextMatch__team">
                    <img src="{{ url('/images/logo.png') }}" class="nextMatch__teamImage">
                    <span class="nextMatch__teamName">MKS Tęcza Kościan</span>
                </div>
                <span id="nextMatch__vs">VS.</span>
                <div class="nextMatch__team">
                    <img src="{{ url('/images/logo.png') }}" class="nextMatch__teamImage">
                    <span class="nextMatch__teamName">MKS Tęcza Kościan</span>
                </div>
            </div>
            <div id="nextMatch__details">
                <p><i class="fa fa-clock-o" aria-hidden="true"></i><span>12 września 2017r. 15:00</span></p>
                <p><i class="fa fa-map-marker" aria-hidden="true"></i><span>ZSP im. Franciszka Ratajczaka</span></p>
            </div>
        </div>
    </div>
    <div class="sideBlock">
        <div class="sideBlock__header">
            {{ strtoupper($contest->name) }}
        </div>
        <div class="sideBlock__content">
            <table id="sideTable">
                <thead>
                <tr>
                    <th>Lp.</th>
                    <th>Drużyna</th>
                    <th>M</th>
                    <th>Pkt</th>
                </tr>
                </thead>
                <tbody>
                @foreach($table->getClubs() as $club)
                    @if($club->id === 1)
                    <tr>
                        <td><strong>{{ $club->position }}</strong></td>
                        <td><strong>{{ $club->name }}</strong></td>
                        <td><strong>{{ $club->matches }}</strong></td>
                        <td><strong>{{ $club->points }}</strong></td>
                    </tr>
                    @else
                    <tr>
                        <td>{{ $club->position }}</td>
                        <td>{{ $club->name }}</td>
                        <td>{{ $club->matches }}</td>
                        <td>{{ $club->points }}</td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>