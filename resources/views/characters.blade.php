<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Characters</title>
</head>
<body>
    <h1>List of Characters</h1>

    @if (!is_null($characters) && !$characters->isEmpty())
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
                @foreach ($characters as $character)
                    <tr>
                        <td>{{ $character->name }}</td>
                        <td>{{ $character->defence }}</td>
                        <td>{{ $character->strength }}</td>
                        <td>{{ $character->accuracy }}</td>
                        <td>{{ $character->magic }}</td>
                        <td><a href="{{ route('characters.show', $character->id) }}">View Details</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No characters found.</p>
    @endif
</body>
</html>