<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Keywords', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('Keyword', 40)->nullable(false)->unique()->primary();
            $table->string('Postare', 120)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('Keywords');
    }
}
