<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index()
    {
        // Fetch all films and return them with full poster URLs
        $films = Film::all()->map(function ($film) {
            $film->poster = $film->poster ? url($film->poster) : null;
            return $film;
        });

        return response()->json($films);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'date_created' => 'required|integer',
            'duree' => 'required|integer',
            'prix' => 'required|integer',
            'poster' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // Max size: 2MB
            'id_categorie' => 'required|exists:categories,id',
            'id_acteur_principal' => 'required|exists:acteurs,id',
            'id_acteur_secondaire' => 'required|exists:acteurs,id',
            'id_editeur' => 'required|exists:editeurs,id',
            'id_langue' => 'required|exists:langues,id',
            'id_realisateur' => 'required|exists:realisateurs,id',
        ]);

        if ($request->hasFile('poster')) {
            // Generate a unique filename and store it in the `public/posters` directory
            $fileName = time() . '_' . $request->file('poster')->getClientOriginalName();
            $request->file('poster')->move(public_path('posters'), $fileName);
            $validatedData['poster'] = 'posters/' . $fileName; // Save the relative path
        }

        $film = Film::create($validatedData);

        // Add full URL to the poster in the response
        $film->poster = $film->poster ? url($film->poster) : null;

        return response()->json($film, 201);
    }

    public function show($id)
    {
        $film = Film::findOrFail($id);

        // Add full URL to the poster
        $film->poster = $film->poster ? url($film->poster) : null;

        return response()->json($film);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'date_created' => 'required|integer',
            'duree' => 'required|integer',
            'prix' => 'required|integer',
            'poster' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'id_categorie' => 'required|exists:categories,id',
            'id_acteur_principal' => 'required|exists:acteurs,id',
            'id_acteur_secondaire' => 'required|exists:acteurs,id',
            'id_editeur' => 'required|exists:editeurs,id',
            'id_langue' => 'required|exists:langues,id',
            'id_realisateur' => 'required|exists:realisateurs,id',
        ]);

        $film = Film::findOrFail($id);

        if ($request->hasFile('poster')) {
            // Delete the old poster if it exists
            if ($film->poster && file_exists(public_path($film->poster))) {
                unlink(public_path($film->poster));
            }

            // Upload the new poster
            $fileName = time() . '_' . $request->file('poster')->getClientOriginalName();
            $request->file('poster')->move(public_path('posters'), $fileName);
            $validatedData['poster'] = 'posters/' . $fileName; // Save the relative path
        }

        $film->update($validatedData);

        // Add full URL to the poster in the response
        $film->poster = $film->poster ? url($film->poster) : null;

        return response()->json($film);
    }

    public function destroy($id)
    {
        $film = Film::findOrFail($id);

        // Delete the poster file if it exists
        if ($film->poster && file_exists(public_path($film->poster))) {
            unlink(public_path($film->poster));
        }

        $film->delete();

        return response()->json(null, 204);
    }
}
