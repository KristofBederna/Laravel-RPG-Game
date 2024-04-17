<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Characters</title>
</head>
<body>
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
</body>
</html>