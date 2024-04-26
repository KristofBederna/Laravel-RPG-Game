<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styleCharacters.css') }}">
    <title>List of Characters</title>
</head>
<body>
<button class="dashboardButton" onclick="window.location.href = '{{ route('dashboard') }}';">Dashboard</button>
<table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Defensive</th>
                    <th>Offensive</th>
                    <th>Accuracy</th>
                    <th>Magical Ability</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
    <h1>List of Characters</h1>
    @if(auth()->user()->admin == 1)
            @foreach ($characters as $character)
            @if($character->enemy == 1)
                    <tr>
                        <td>{{ $character->name }}</td>
                        <td>{{ $character->defence }}</td>
                        <td>{{ $character->strength }}</td>
                        <td>{{ $character->accuracy }}</td>
                        <td>{{ $character->magic }}</td>
                        <td><a href="{{ route('characters.show', ['character' => $character->id, 'userId' => $character->user_id]) }}">Details</a></td>
                    </tr>
                    @endif
                @endforeach
                @endif
    @if (!is_null($characters) && !$characters->isEmpty())
                @foreach ($characters as $character)
                @if(auth()->user()->id == $character->user_id)
                    <tr>
                        <td>{{ $character->name }}</td>
                        <td>{{ $character->defence }}</td>
                        <td>{{ $character->strength }}</td>
                        <td>{{ $character->accuracy }}</td>
                        <td>{{ $character->magic }}</td>
                        <td><a href="{{ route('characters.show', ['character' => $character->id, 'userId' => $character->user_id]) }}">Details</a></td>
                    </tr>
                    @endif
                @endforeach
    @else
        <p>No characters found.</p>
    @endif
    </tbody>
    </table>
    <h2>Create New Character</h2>
    <form method="POST" action="{{ route('characters.store') }}">
        @csrf

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="defence">Defence:</label>
        <input type="number" id="defence" name="defence" required>

        <label for="strength">Strength:</label>
        <input type="number" id="strength" name="strength" required>

        <label for="accuracy">Accuracy:</label>
        <input type="number" id="accuracy" name="accuracy" required>

        <label for="magic">Magical Ability:</label>
        <input type="number" id="magic" name="magic" required>

        @if (auth()->user()->admin == 1)
            <label for="enemy">Enemy:</label>
            <input type="checkbox" id="enemy" name="enemy" value="1">
        @endif
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

        <button type="submit">Create Character</button>
    </form>
</body>
</html>
