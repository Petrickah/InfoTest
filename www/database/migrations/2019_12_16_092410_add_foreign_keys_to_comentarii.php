<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToComentarii extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Comentarii', function (Blueprint $table) {
            $table->foreign('Autor', 'fk_Comentarii_Useri_Email')
                ->references('Email')
                ->on('Useri')
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
        Schema::table('Comentarii', function (Blueprint $table) {
            $table->dropForeign('fk_Comentarii_Useri_Email');
        });
    }
}
