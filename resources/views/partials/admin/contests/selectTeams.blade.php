<select name="name="{{$match->id}}[awayScore]"" id="" class="form-control">
    @foreach($contest->clubs as $club)
        <option value="{{ $club->id }}">{{ $club->name }}</option>
    @endforeach
</select>