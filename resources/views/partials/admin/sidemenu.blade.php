<ul class="nav nav-sidebar">
    <li{!! Request::is('admin/aktualnosci*') ? ' class="active"' : '' !!}><a href="{{ action('AdminNewsController@index') }}">Aktualności</a></li>
    <li{!! Request::is('admin/druzyny*') ? ' class="active"' : '' !!}><a href="{{ action('AdminTeamController@index') }}">Drużyny</a></li>
    <li{!! Request::is('admin/czlonkowie*') ? ' class="active"' : '' !!}><a href="{{ action('AdminTeamMemberController@index') }}">Członkowie</a></li>
    <li><a href="#">Rozgrywki</a></li>
</ul>
<ul class="nav nav-sidebar">
    <li{!! Request::is('*/dodaj') ? ' class="active"' : '' !!}><a href="{{ Request::url() }}/dodaj">Dodaj</a></li>
</ul>