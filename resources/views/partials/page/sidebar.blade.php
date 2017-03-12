<div id="sidebar">
    <div class="sideBlock">
        <div class="sideBlock__header">
            NASTĘPNE SPOTKANIE
        </div>
        <div class="sideBlock__content" id="nextMatch">
            @if($nextMatch->active)
            <div id="nextMatch__logos">
                @if($nextMatch->type == 'home')
                <div class="nextMatch__team">
                    <img src="{{ url('/images/logo.png') }}" class="nextMatch__teamImage">
                    <span class="nextMatch__teamName">MKS Tęcza Kościan</span>
                </div>
                <span id="nextMatch__vs">VS.</span>
                <div class="nextMatch__team">
                    <img src="{{ url('/storage/images/opponent_logo.png') }}" class="nextMatch__teamImage">
                    <span class="nextMatch__teamName">{{ $nextMatch->opponent }}</span>
                </div>
                @else
                    <div class="nextMatch__team">
                        <img src="{{ url('/storage/images/opponent_logo.png') }}" class="nextMatch__teamImage">
                        <span class="nextMatch__teamName">{{ $nextMatch->opponent }}</span>
                    </div>
                    <span id="nextMatch__vs">VS.</span>
                    <div class="nextMatch__team">
                        <img src="{{ url('/images/logo.png') }}" class="nextMatch__teamImage">
                        <span class="nextMatch__teamName">MKS Tęcza Kościan</span>
                    </div>
                @endif
            </div>
            <div id="nextMatch__details">
                <p><span><i class="fa fa-clock-o" aria-hidden="true"></i>{{ $nextMatch->date ?
                    \Carbon\Carbon::createFromFormat('Y-m-d', $nextMatch->date)->format("d.m.Y") : ''}} {{ date('H:i',
                    strtotime($nextMatch->time)) }}</span></p>
                @if($nextMatch->place)<p><span><i class="fa fa-map-marker" aria-hidden="true"></i>{{ $nextMatch->place }}</span></p>@endif
            </div>
            @else
                <p>Brak spotkań w najbliższym czasie</p>
            @endif
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
                    @if($club->name === "MKS Tęcza Kościan")
                    <tr>
                        <td><strong>{{ $club->position }}</strong></td>
                        <td><strong>{{ $club->name }}</strong></td>
                        <td><strong>{{ $club->mainStats->matches }}</strong></td>
                        <td><strong>{{ $club->mainStats->points }}</strong></td>
                    </tr>
                    @else
                    <tr>
                        <td>{{ $club->position }}</td>
                        <td>{{ $club->name }}</td>
                        <td>{{ $club->mainStats->matches }}</td>
                        <td>{{ $club->mainStats->points }}</td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>