<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styleCharactersDetail.css') }}">
    <title>{{ $character->name }}</title>
</head>
<body>
</body>
<button class="dashboardButton" onclick="window.location.href = '{{ route('dashboard') }}';">Dashboard</button>
<div class="container">
  <div class="characterDetails">
    <h1>{{ $character->name }}</h1>

    <p>Defence: {{ $character->defence }}</p>
    <p>Strength: {{ $character->strength }}</p>
    <p>Accuracy: {{ $character->accuracy }}</p>
    <p>Magical Ability: {{ $character->magic }}</p>
  </div>
  <div class="matchesList">
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

  </div>
  <div class="buttons">
  <form action="{{ route('characters.edit', ['character' => $character->id, 'userId' => $character->user_id]) }}" method="GET">
    <button type="submit">Edit</button>
</form>

        <form method="POST" action="{{ route('characters.destroy', $character->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
        <form method="POST" action="{{ route('characters.matches.store', $character->id) }}">
    @csrf
    <button type="submit">New Match</button>
</form>

  </div>
</div>
</html>
