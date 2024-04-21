<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PlaceController extends Controller
{
  // List all places
  public function index()
  {
    if (!Auth::user()->admin) {
      return redirect()->route('characters');
    }
    $places = Place::all();
    return view('places', compact('places'));
  }

  // Show the form for creating a new place
  public function create()
  {
    if (!Auth::user()->admin) {
      return redirect()->route('characters');
    }
    return view('places_create');
  }

  public function store(Request $request)
  {
    if (!Auth::user()->admin) {
      return redirect()->route('characters');
    }
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imageName = time() . '.' . $request->image->extension();
    $request->image->move(public_path('images/places'), $imageName);

    Place::create([
      'name' => $validatedData['name'],
      'image' => $imageName,
    ]);

    return redirect()->route('places');
  }

  public function edit(Place $place)
  {
    if (!Auth::user()->admin) {
      return redirect()->route('characters');
    }
    return view('places_edit', compact('place'));
  }

  public function update(Request $request, Place $place)
  {
    if (!Auth::user()->admin) {
      return redirect()->route('characters');
    }

    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
      if ($place->image) {
        $imagePath = public_path('images/places/') . $place->image;
        if (File::exists($imagePath)) {
          File::delete($imagePath);
        }
      }

      $imageName = time() . '.' . $request->image->extension();
      $request->image->move(public_path('images/places'), $imageName);
      $place->image = $imageName;
    }

    $place->name = $validatedData['name'];
    $place->save();

    return redirect()->route('places');
  }

  public function destroy(Place $place)
  {
    if (!Auth::user()->admin) {
      return redirect()->route('characters');
    }
    $place->delete();

    if (file_exists(public_path('images/places/' . $place->image))) {
      unlink(public_path('images/places/' . $place->image));
    }

    return redirect()->route('places');
  }
}
