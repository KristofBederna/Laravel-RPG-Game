<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $character->name }}</title>
</head>
<body>
    <h1>{{ $character->name }}</h1>

    <p>Defensive: {{ $character->defence }}</p>
    <p>Offensive: {{ $character->strength }}</p>
    <p>Accuracy: {{ $character->accuracy }}</p>
    <p>Magical Ability: {{ $character->magic }}</p>

    <h2>Matches</h2>
    <ul>
        @foreach ($contests as $contest)
            @php
    $location = $contest->place->name;
    $opponent = $contest->characters()->where('character_id', '!=', $character->id)->first()->name;
            @endphp
<li><a href="{{ route('contests.show', ['id' => $contest->id, 'character' => $character->id]) }}">{{ $location }} vs. {{ $opponent }}</a></li>


        @endforeach
    </ul>

    <!-- Buttons for edit, delete, and new match -->
    <div>
<form style="display: inline-block;" action="{{ route('characters.edit', ['character' => $character->id, 'userId' => $character->user_id]) }}" method="GET">
    <button type="submit">Edit</button>
</form>

        <form style="display: inline-block;" method="POST" action="{{ route('characters.destroy', $character->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
        <form style="display: inline-block;" action="{{ route('characters.matches.create', $character->id) }}">
            <button type="submit">New Match</button>
        </form>
    </div>
</body>
</html>
