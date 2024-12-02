<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("description");
            $table->integer("date_created");
            $table->integer("duree");
            $table->integer("prix");
            $table->string('poster')->nullable();
            $table->unsignedBigInteger("id_categorie");
            $table->foreign("id_categorie")->references("id")->on("categories")->onDelete("cascade");
            $table->unsignedBigInteger("id_acteur_principal");
            $table->foreign("id_acteur_principal")->references("id")->on("acteurs")->onDelete("cascade");
            $table->unsignedBigInteger("id_acteur_secondaire");
            $table->foreign("id_acteur_secondaire")->references("id")->on("acteurs")->onDelete("cascade");
            $table->unsignedBigInteger("id_editeur");
            $table->foreign("id_editeur")->references("id")->on("editeurs")->onDelete("cascade");
            $table->unsignedBigInteger("id_langue");
            $table->foreign("id_langue")->references("id")->on("langues")->onDelete("cascade");
            $table->unsignedBigInteger("id_realisateur");
            $table->foreign("id_realisateur")->references("id")->on("realisateurs")->onDelete("cascade");

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
