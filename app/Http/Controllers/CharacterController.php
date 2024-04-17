<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Contest;

class CharacterController extends Controller
{
    public function index()
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // Fetch the authenticated user's ID
            $userId = auth()->id();

            // Fetch the characters belonging to the authenticated user
            $characters = Character::where('user_id', $userId)->get();

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
}
