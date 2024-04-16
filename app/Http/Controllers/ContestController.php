<?php

namespace App\Http\Controllers;

use App\Models\Contest;

class ContestController extends Controller
{
    public function show($id)
    {
        $contest = Contest::findOrFail($id);
        return view('create_contest', compact('contest'));
    }

}
