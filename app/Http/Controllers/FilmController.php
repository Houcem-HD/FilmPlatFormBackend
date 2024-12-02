<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::with(['categorie', 'acteurPrincipal', 'acteurSecondaire', 'editeur', 'langue', 'realisateur'])->get();
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
            'poster' => 'nullable|file|mimes:jpg,jpeg,png',
            'id_categorie' => 'required|exists:categories,id',
            'id_acteur_principal' => 'required|exists:acteurs,id',
            'id_acteur_secondaire' => 'required|exists:acteurs,id',
            'id_editeur' => 'required|exists:editeurs,id',
            'id_langue' => 'required|exists:langues,id',
            'id_realisateur' => 'required|exists:realisateurs,id',
        ]);

        if ($request->hasFile('poster')) {
            // Générer un nom de fichier unique
            $fileName = time() . '_' . $request->file('poster')->getClientOriginalName();
            // Déplacer le fichier vers le dossier public/posters
            $request->file('poster')->move(public_path('posters'), $fileName);
            // Stocker le chemin relatif du fichier dans la base de données
            $validated['poster'] = 'posters/' . $fileName;
        }

        $film = Film::create($validatedData);
        return response()->json($film, 201);
    }
    public function show($id)
    {
        $el = Film::find($id);
        return response()->json($el);
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'date_created' => 'required|integer',
            'duree' => 'required|integer',
            'prix' => 'required|integer',
            'poster' => 'nullable|string',
            'id_categorie' => 'required|exists:categories,id',
            'id_acteur_principal' => 'required|exists:acteurs,id',
            'id_acteur_secondaire' => 'required|exists:acteurs,id',
            'id_editeur' => 'required|exists:editeurs,id',
            'id_langue' => 'required|exists:langues,id',
            'id_realisateur' => 'required|exists:realisateurs,id',
        ]);

        if ($request->hasFile('poster')) {
            $posterFile = $request->file('poster');
            $posterFileName = time() . '_' . $posterFile->getClientOriginalName();
            $posterFile->move(public_path('posters'), $posterFileName);
            $validated['poster'] = 'posters/' . $posterFileName;
        }

        $film = Film::find($id);
        
        $film->update($validatedData);
        $film->refresh();
        return response()->json($film);
    }
    public function destroy($id)
    {
        $film = Film::find($id);
        $film->delete();
        return response()->json(null, 204);
    }
}
