<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return response()->json($categories);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $Categorie = Categorie::create($validatedData);
        return response()->json($Categorie, 201);
    }
    public function show($id)
    {
        $el = Categorie::find($id);
        return response()->json($el);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $Categorie = Categorie::find($id);

        $Categorie->update($request->all());
        return response()->json($Categorie);
    }
    public function destroy($id)
    {
        $Categorie = Categorie::find($id);
        $Categorie->delete();
        return response()->json(null, 204);
    }
}
