<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;

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
}
