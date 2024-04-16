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
            dump($userId);

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

    public function edit(Character $character)
    {
        // Check if the current user is authorized to edit the character
        if (auth()->id() !== $character->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('characters.edit', compact('character'));
    }

    public function destroy(Character $character)
    {
        // Check if the current user is authorized to delete the character
        if (auth()->id() !== $character->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $character->delete();

        // Redirect to a suitable route after deletion
    }

    public function createMatch(Character $character)
    {
        // Implement logic to start a new match
    }
}
