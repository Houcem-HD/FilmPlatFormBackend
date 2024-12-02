<?php

namespace App\Http\Controllers;

use App\Models\Editeur;
use Illuminate\Http\Request;

class EditeurController extends Controller
{
    public function index()
    {
        $editeurs = Editeur::all();
        return response()->json($editeurs);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'nationalite' => 'required|string|max:255',
            'date_naissance' => 'required|date',
        ]);

        $editeur = Editeur::create($validatedData);
        return response()->json($editeur, 201);
    }
    public function show($id)
    {
        $el = Editeur::find($id);
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

        $editeur = Editeur::find($id);

        $editeur->update($validatedData);
        return response()->json($editeur);
    }
    public function destroy($id)
    {
        $editeur = Editeur::find($id);
        $editeur->delete();
        return response()->json(null, 204);
    }
}
