<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;

class PlaceController extends Controller
{
  // List all places
  public function index()
  {
    $places = Place::all();
    return view('places', compact('places'));
  }

  // Show the form for creating a new place
  public function create()
  {
    return view('places_create');
  }

  // Store a newly created place in storage
  public function store(Request $request)
  {
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

  // Show the form for editing the specified place
  public function edit(Place $place)
  {
    return view('places_edit', compact('place'));
  }

  // Update the specified place in storage
  public function update(Request $request, Place $place)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
      $imageName = time() . '.' . $request->image->extension();
      $request->image->move(public_path('images/places'), $imageName);
      $place->image = $imageName;
    }

    $place->name = $validatedData['name'];
    $place->save();

    return redirect()->route('places');
  }

  // Remove the specified place from storage
  public function destroy(Place $place)
  {
    $place->delete();

    // Delete the associated image file
    if (file_exists(public_path('images/places/' . $place->image))) {
      unlink(public_path('images/places/' . $place->image));
    }

    return redirect()->route('places');
  }
}
