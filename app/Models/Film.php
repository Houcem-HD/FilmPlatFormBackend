<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'description',
        'date_created',
        'duree',
        'prix',
        'id_categorie',
        'id_acteur_principal',
        'id_acteur_secondaire',
        'id_editeur',
        'id_langue',
        'id_realisateur',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_created' => 'integer',
        'duree' => 'integer',
        'prix' => 'integer',
    ];

    /**
     * Define relationships.
     */
    public function categorie()
    {
        return $this->belongsTo(Category::class, 'id_categorie', 'id');
    }

    public function acteurPrincipal()
    {
        return $this->belongsTo(Acteur::class, 'id_acteur_principal', 'id');
    }

    public function acteurSecondaire()
    {
        return $this->belongsTo(Acteur::class, 'id_acteur_secondaire', 'id');
    }

    public function editeur()
    {
        return $this->belongsTo(Editeur::class, 'id_editeur', 'id');
    }

    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue', 'id');
    }

    public function realisateur()
    {
        return $this->belongsTo(Realisateurs::class, 'id_realisateur', 'id');
    }
}
