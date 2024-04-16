<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Contest;

class HomeController extends Controller
{
    public function index()
    {
        $numberOfCharacters = Character::count();
        $numberOfContests = Contest::count();

        return view('welcome', compact('numberOfCharacters', 'numberOfContests'));
    }
}
