<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Contest;
use App\Models\Place;

class CharacterController extends Controller
{
    public function index()
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // Fetch the authenticated user's ID
            $userId = auth()->id();

            // Fetch the characters belonging to the authenticated user
            $characters = Character::get();

            // Pass the characters to the view
            return view('characters', compact('characters'));
        } else {
            // User is not authenticated
            dd('User is not authenticated.');
        }
    }
    public function show(int $characterId, int $userId)
    {
        $character = Character::get()->where('id', $characterId)->first();
        $contests = $character->contests()->get();

        return view('characters_detail', ['character' => $character, 'contests' => $contests]);
    }

    public function edit(int $characterId)
    {
        $character = Character::get()->where('id', $characterId)->first();

        return view('edit', compact('character'));
    }

    public function update(Request $request, $id)
    {
        $character = Character::findOrFail($id);

        $character->name = $request->input('name');
        $character->defence = $request->input('defence');
        $character->strength = $request->input('strength');
        $character->accuracy = $request->input('accuracy');
        $character->magic = $request->input('magic');
        if ($request->input('enemy')) {
            $character->enemy = 0;
        } else {
            $character->enemy = 1;
        }

        $character->save();

        return redirect()->route('characters.show', ['character' => $character->id, 'userId' => $character->user_id]);
    }

    public function destroy($id)
    {
        $character = Character::findOrFail($id);

        $character->delete();

        return redirect()->route('characters');
    }

    public function createMatch(Character $character)
    {
        // Implement logic to start a new match
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'defence' => 'required|numeric|min:0|max:10',
            'strength' => 'required|numeric|min:0|max:10',
            'accuracy' => 'required|numeric|min:0|max:10',
            'magic' => 'required|numeric|min:0|max:10',
            'enemy' => 'boolean',
        ]);

        if ($validatedData['defence'] + $validatedData['strength'] + $validatedData['accuracy'] + $validatedData['magic'] !== 20) {
            return back()->withInput()->withErrors(['sum' => 'The sum of defence, strength, accuracy, and magic must be equal to 20.']);
        }

        Character::create([
            'name' => $validatedData['name'],
            'defence' => $validatedData['defence'],
            'strength' => $validatedData['strength'],
            'accuracy' => $validatedData['accuracy'],
            'magic' => $validatedData['magic'],
            'enemy' => $request->input('enemy', false),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('characters');
    }

    public function storeMatch(Character $character)
    {
        $location = Place::inRandomOrder()->first();
        $opponentCharacter = Character::where('id', '!=', $character->id)->inRandomOrder()->first();
        $opponent = $opponentCharacter->name;
        $history = $location->name . " vs. " . $opponent;

        $contest = Contest::create([
            'win' => true,
            'history' => $history,
            'user_id' => auth()->user()->id,
            'place_id' => $location->id,
        ]);

        $contest->characters()->attach([$character->id => ['enemy_hp' => 100, 'hero_hp' => 100], $opponentCharacter->id => ['enemy_hp' => 100, 'hero_hp' => 100]]);


        return redirect()->route('contests.show', ['id' => $contest->id, 'character' => $character->id]);
    }
}
