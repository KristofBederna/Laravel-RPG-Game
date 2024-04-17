<h1>Edit Character</h1>
<form method="POST" action="{{ route('characters.update', ['character' => $character->id, 'userId' => $character->user_id]) }}">
    @csrf
    @method('PUT')

    <!-- Add form fields to edit character details -->
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ $character->name }}" required>

    <label for="defence">Defence:</label>
    <input type="number" id="defence" name="defence" value="{{ $character->defence }}" required>

    <label for="strength">Strength:</label>
    <input type="number" id="strength" name="strength" value="{{ $character->strength }}" required>

    <label for="accuracy">Accuracy:</label>
    <input type="number" id="accuracy" name="accuracy" value="{{ $character->accuracy }}" required>

    <label for="magic">Magical Ability:</label>
    <input type="number" id="magic" name="magic" value="{{ $character->magic }}" required>

    <button type="submit">Save Changes</button>
</form>
