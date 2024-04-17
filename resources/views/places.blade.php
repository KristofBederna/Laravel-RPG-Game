<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Places</title>
</head>
<body>
    <h1>List of Places</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($places as $place)
            <tr>
                <td>{{ $place->name }}</td>
                <td><img src="{{ asset('storage/' . $place->image) }}" alt="{{ $place->name }}" width="100"></td>
                <td>
                    <a href="{{ route('places.edit', $place->id) }}">Edit</a>
                    <form method="POST" action="{{ route('places.destroy', $place->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('places.create') }}">Create New Place</a>
</body>
</html>
