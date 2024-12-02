<?php

namespace App\Http\Controllers;

use App\Models\Realisateurs;
use Illuminate\Http\Request;

class RealisateurController extends Controller
{
    public function index()
    {
        $realisateurs = Realisateurs::all();
        return response()->json($realisateurs);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $realisateur = Realisateurs::create($validatedData);
        return response()->json($realisateur, 201);
    }
    public function show($id)
    {
        $el = Realisateurs::find($id);
        return response()->json($el);
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $realisateur = Realisateurs::find($id);

        $realisateur->update($validatedData);
        return response()->json($realisateur);
    }
    public function destroy($id)
    {
        $realisateur = Realisateurs::find($id);
        $realisateur->delete();
        return response()->json(null, 204);
    }
}
