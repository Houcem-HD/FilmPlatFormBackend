<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use Illuminate\Http\Request;

class LangueController extends Controller
{
    public function index()
    {
        $langues = Langue::all();
        return response()->json($langues);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'langues' => 'required|string|max:255',
        ]);

        $langue = Langue::create($validatedData);
        return response()->json($langue, 201);
    }
    public function show($id)
    {
        $el = Langue::find($id);
        return response()->json($el);
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'langues' => 'required|string|max:255',
        ]);

        $langue = Langue::find($id);

        $langue->update($validatedData);
        return response()->json($langue);
    }
    public function destroy($id)
    {
        $langue = Langue::find($id);
        $langue->delete();
        return response()->json(null, 204);
    }
}
