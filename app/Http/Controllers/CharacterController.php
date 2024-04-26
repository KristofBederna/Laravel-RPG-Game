<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Character;
use App\Models\Contest;
use App\Models\Place;
use Illuminate\Support\Facades\Validator;



class CharacterController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $userId = auth()->id();
            $characters = Character::get();
            return view('characters', compact('characters'));
        } else {
            dd('User is not authenticated.');
        }
    }
    public function show(int $characterId, int $userId)
    {
        $character = Character::get()->where('id', $characterId)->first();

        if (Auth::id() !== $character->user_id && (!Auth::user()->admin && $character->enemy)) {
            return redirect()->route('characters');
        }

        $contests = $character->contests()->get();

        return view('characters_detail', ['character' => $character, 'contests' => $contests]);
    }

    public function edit(int $characterId)
    {
        $character = Character::get()->where('id', $characterId)->first();

        if (Auth::id() !== $character->user_id) {
            if (Auth::user()->admin && $character->enemy) {
                return view('edit', compact('character'));
            }
            return redirect()->route('characters');
        }

        return view('edit', compact('character'));
    }

    public function update(Request $request, $id)
    {
        $character = Character::findOrFail($id);

        if (Auth::id() !== $character->user_id) {
            if (Auth::user()->admin && $character->enemy) {
                // Admin can update enemy characters
            } else {
                return redirect()->route('characters');
            }
        }

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

        if (($character->defence + $character->strength + $character->accuracy + $character->magic) == 20) {
            $character->save();
        } else {
            return redirect()->back()->with('error', 'Stats should sum up to 20!');
        }

        return redirect()->route('characters.show', ['character' => $character->id, 'userId' => $character->user_id]);
    }


    public function destroy($id)
    {
        $character = Character::findOrFail($id);

        if (Auth::id() !== $character->user_id) {
            if (Auth::user()->admin && $character->enemy) {

            } else {
                return redirect()->route('characters');
            }
        }

        $character->delete();

        return redirect()->route('characters');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'defence' => 'required|numeric|min:0|max:3',
            'strength' => 'required|numeric|min:0|max:20',
            'accuracy' => 'required|numeric|min:0|max:20',
            'magic' => 'required|numeric|min:0|max:20',
            'enemy' => 'boolean',
        ]);

        if ($validatedData['defence'] > 3) {
            return redirect()->back()->with('error', 'Defence can be maximum 3!');
        }
        if ($validatedData['defence'] + $validatedData['strength'] + $validatedData['accuracy'] + $validatedData['magic'] !== 20) {
            return redirect()->back()->with('error', 'Stats should sum up to 20!');
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

        $contest = Contest::create([
            'win' => null,
            'history' => "",
            'user_id' => auth()->user()->id,
            'place_id' => $location->id,
        ]);

        $contest->characters()->attach([$character->id => ['enemy_hp' => 100, 'hero_hp' => 100], $opponentCharacter->id => ['enemy_hp' => 100, 'hero_hp' => 100]]);


        return redirect()->route('contests.show', ['id' => $contest->id, 'character' => $character->id]);
    }
}
