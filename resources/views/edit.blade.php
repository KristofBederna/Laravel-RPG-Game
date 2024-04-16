<h1>Edit Character</h1>
<form method="POST" action="{{ route('characters.update', $character->id) }}">
    @csrf
    @method('PUT')
    <!-- Add form fields to edit character details -->
    <button type="submit">Save Changes</button>
</form>