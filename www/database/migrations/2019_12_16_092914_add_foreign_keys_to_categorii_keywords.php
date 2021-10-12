<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCategoriiKeywords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Categorie_Keyword', function (Blueprint $table) {
            $table->foreign('keyword_Keyword', 'fk_Categorie_Keyword_Keywords_Keyword')
                ->references('Keyword')
                ->on('Keywords')
                ->onDelete('cascade');
            $table->foreign('categorie_Denumire', 'fk_Categorie_Keyword_Categorii_Denumire')
                ->references('Denumire')
                ->on('Categorii')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Categorie_Keyword', function (Blueprint $table) {
            $table->dropForeign('fk_Categorie_Keyword_Keywords_Keyword');
            $table->dropForeign('fk_Categorie_Keyword_Categorii_Denumire');
        });
    }
}
