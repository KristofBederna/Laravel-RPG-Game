<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Place</title>
</head>
<body>
    <h1>Create New Place</h1>
    <form method="POST" action="{{ route('places.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required><br><br>
        <button type="submit">Create Place</button>
    </form>
</body>
</html>
