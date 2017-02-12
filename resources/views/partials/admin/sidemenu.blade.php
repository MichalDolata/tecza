<ul class="nav nav-sidebar">
    <li{!! Request::is('admin/aktualnosci*') ? ' class="active"' : '' !!}><a href="{{ action('AdminNewsController@index') }}">Aktualności</a></li>
    <li{!! Request::is('admin/druzyny*') ? ' class="active"' : '' !!}><a href="{{ action('AdminTeamController@index') }}">Drużyny</a></li>
    <li{!! Request::is('admin/czlonkowie*') ? ' class="active"' : '' !!}><a href="{{ action('AdminTeamMemberController@index') }}">Członkowie</a></li>
    <li{!! Request::is('admin/kluby*') ? ' class="active"' : '' !!}><a href="{{ action('AdminClubController@index') }}">Kluby</a></li>
    <li{!! Request::is('admin/rozgrywki*') ? ' class="active"' : '' !!}><a href="{{ action('AdminContestController@index') }}">Rozgrywki</a></li>
</ul>
<ul class="nav nav-sidebar">
    <li{!! Request::is('*/dodaj') ? ' class="active"' : '' !!}>
        <a href="{{ Request::url() }}{!! Request::is('*/dodaj') ? '' : '/dodaj' !!}">Dodaj</a>
    </li>
</ul>