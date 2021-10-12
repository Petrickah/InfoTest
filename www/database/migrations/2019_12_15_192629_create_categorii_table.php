<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Categorii', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('Denumire', 45)->nullable(false)->unique()->primary();
            $table->longText('Descriere')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('Categorii');
    }
}
