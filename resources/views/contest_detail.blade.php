<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contest details</title>
</head>
<style>
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
p {
    text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;
}
</style>
<body style="background-image: url('{{ asset('images/places/' . $contest->place->image) }}');">
<button class="dashboardButton" onclick="window.location.href = '{{ route('dashboard') }}';">Dashboard</button>
    <h2>Contest Details</h2>
    <?php
    use App\Models\Character;
    $character = Character::findOrFail($character);
    ?>
    @if ($contest)
        <p>Location: {{ $contest->place->name }}</p>
        <p>Character: {{$character->name}}</p>
        <p>Defence: {{ $character->defence }}</p>
        <p>Strength: {{ $character->strength }}</p>
        <p>Accuracy: {{ $character->accuracy }}</p>
        <p>Magical Ability: {{ $character->magic }}</p>
        <p><strong>Opponent:</strong> {{ $contest->characters()->where('character_id', '!=', $character->id)->first()->name }}</p>
        <p>Defence: {{ $character->defence }}</p>
        <p>Strength: {{ $character->strength }}</p>
        <p>Accuracy: {{ $character->accuracy }}</p>
        <p>Magical Ability: {{ $character->magic }}</p>
        <p>History: {{$contest->history}}</p>
    @else
        <p>Contest not found.</p>
    @endif
    <button onclick="window.location.href = '{{ route('characters') }}';">Characters</button>
</body>
</html>
