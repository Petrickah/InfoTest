<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPostari extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Postari', function (Blueprint $table) {
            $table->foreign('Autor', 'fk_Postari_Useri_Email')
                ->references('Email')
                ->on('Useri')
                ->onDelete('cascade');
            $table->foreign('Categorie', 'fk_Postari_Categorii_Denumire')
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
        Schema::table('Postari', function (Blueprint $table) {
            $table->dropForeign('fk_Postari_Useri_Email');
            $table->dropForeign('fk_Postari_Categorii_Denumire');
        });
    }
}
