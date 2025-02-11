<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class PlanetPositionsController extends Controller
{
    public function showForm()
    {
        return view('/planet-positions.form');  // Show the form
    }
    //
    public function getPlanetPositions(Request $request)
    {
        // Validate incoming request parameters
        $validated = $request->validate([
            'ayanamsa' => 'required|numeric',
            'planets' => 'required|array',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',

        ]);
        dd($validated);
        // Instead of calling an API, just return the validated data for testing
        return response()->json([
            'data' => $validated
        ]);

    }

}
