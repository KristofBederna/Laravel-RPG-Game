<h1>Confirm Deletion</h1>
<p>Are you sure you want to delete this character?</p>
<form method="POST" action="{{ route('characters.destroy', $character->id) }}">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>
