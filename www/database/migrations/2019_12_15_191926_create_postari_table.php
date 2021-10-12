<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostariTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Postari', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('slug', 120)->nullable(false)->unique()->primary();
            $table->string('Titlu', 120)->nullable(false);
            $table->longText('Continut')->nullable(false);
            $table->string('Password', 50)->nullable(true);
            $table->string('Autor', 40)->nullable(false);
            $table->string('Categorie', 45)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('Postari');
    }
}
