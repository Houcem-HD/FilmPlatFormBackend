<?php

namespace App\Http\Controllers;

use App\Models\Acteur;
use Illuminate\Http\Request;

class ActeurController extends Controller
{
    public function index()
    {
        $acteurs = Acteur::all();
        return response()->json($acteurs);
    }
   public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'nationalite' => 'required|string|max:255',
            'date_naissance' => 'required|date',
        ]);

        $acteur = Acteur::create($validatedData);
        return response()->json($acteur, 201);
    }
    public function show($id)
    {
        $el = Acteur::find($id);
        return response()->json($el);
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'nationalite' => 'required|string|max:255',
            'date_naissance' => 'required|date',
        ]);

        $acteur = Acteur::find($id);

        $acteur->update($validatedData);
        return response()->json($acteur);
    }
    public function destroy($id)
    {
        $acteur = Acteur::find($id);
        $acteur->delete();
        return response()->json(null, 204);
    }
}
