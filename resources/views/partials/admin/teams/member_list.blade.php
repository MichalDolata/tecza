<li class="list-group-item" data-id="{{ $member->id }}"
    data-position="{{ $member->pivot->position }}">
    {{ "{$member->first_name} {$member->last_name} ({$member->date_of_birth})" }}
    <span class="badge delete-member">X</span>
</li>