<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToKeywords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Keywords', function (Blueprint $table) {
            $table->foreign('Postare', 'fk_Keywords_Postari_Slug')
                ->references('Slug')
                ->on('Postari')
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
        Schema::table('Keywords', function (Blueprint $table) {
            $table->dropForeign('fk_Keywords_Postari_Slug');
        });
    }
}
