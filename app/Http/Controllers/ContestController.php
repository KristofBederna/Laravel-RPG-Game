<?php

namespace App\Http\Controllers;

use App\Models\Contest;

class ContestController extends Controller
{
    public function show($id, $character)
    {
        $contest = Contest::findOrFail($id);
        return view('contest_detail', compact('contest', 'character'));
    }

}
