<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUseriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Useri', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('Email',  40)->nullable(false)->unique()->primary();
            $table->string('Username', 30)->nullable(false)->unique();
            $table->string('Password', 64)->nullable(false);
            $table->string('Nume', 15)->nullable(true);
            $table->string('Prenume', 25)->nullable(true);
        });
        Schema::table('Useri', function (Blueprint $table){
            $table->string('auth_token', 60)->nullable(true)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('Useri');
    }
}
