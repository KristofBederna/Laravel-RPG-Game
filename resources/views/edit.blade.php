    <style>
        body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    
    h1 {
        text-align: center;
        margin-bottom: 20px;
    }
    
    form {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
    }
    
    label {
        display: block;
        margin-bottom: 5px;
    }
    
    input[type="text"],
    input[type="number"],
    button {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }
    
    button {
  appearance: none;
  background-color: #000000;
  border: 2px solid #1A1A1A;
  border-radius: 15px;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  font-family: Roobert, -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  font-size: 16px;
  font-weight: 600;
  line-height: normal;
  margin: 0;
  outline: none;
  text-align: center;
  text-decoration: none;
  transition: all 300ms cubic-bezier(.23, 1, 0.32, 1);
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  will-change: transform;
  border: none;
  cursor: pointer;
  margin-bottom: 10px;
}

button:disabled {
  pointer-events: none;
}

button:hover {
  box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
  transform: translateY(-2px);
}

button:active {
  box-shadow: none;
  transform: translateY(0);
}

button:hover {
  background-color: #0056b3;
}
    
    input[type="text"]:focus,
    input[type="number"]:focus {
        outline: none;
        border: 1px solid #4CAF50;
    }
    
    input[type="text"]::placeholder,
    input[type="number"]::placeholder {
        color: #aaa;
    }
    
    input[type="text"]:invalid,
    input[type="number"]:invalid {
        border: 1px solid red;
    }
    
    input[type="text"]:invalid::placeholder,
    input[type="number"]:invalid::placeholder {
        color: red;
    }
    .dashboardButton {
  width: 10%;
}
    
    </style>
<button class="dashboardButton" onclick="window.location.href = '{{ route('dashboard') }}';">Dashboard</button>
<h1>Edit Character</h1>
<form method="POST" action="{{ route('characters.update', ['character' => $character->id, 'userId' => $character->user_id]) }}">
    @csrf
    @method('PUT')

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

