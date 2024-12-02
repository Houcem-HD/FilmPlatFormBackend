<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acteur extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'acteurs';

    protected $fillable = [
        'nom',
        'prenom',
        'nationalite',
        'date_naissance',
    ];
}
