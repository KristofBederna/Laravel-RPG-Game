<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Place</title>
</head>
<body>
    <h1>Edit Place</h1>
    <form method="POST" action="{{ route('places.update', $place->id) }}">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $place->name }}" required><br><br>
        <label for="image">New Image:</label>
        <input type="file" id="image" name="image"><br><br>
        <button type="submit">Update Place</button>
    </form>
</body>
</html>
