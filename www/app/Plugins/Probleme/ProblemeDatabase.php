<?php

namespace App\Plugins\Probleme;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;

class ProblemeDatabase {
    private function createTableSolutii() {
        if(!Schema::hasTable('solutii')) {
            Schema::create('solutii', function(Blueprint $table){
                $table->integerIncrements('ID')->nullable(false);
                $table->integer('score')->nullable(false);
                $table->string('utilizator')->nullable(false);
                $table->string('problema')->nullable(false);

                $table->foreign('utilizator', 'fk_solutii_has_user')
                    ->references('Email')
                    ->on('useri');
                $table->foreign('problema', 'fk_solutie_has_problema')
                    ->references('nume')
                    ->on('probleme')
                    ->onDelete('cascade');
            });
        }
    }

    private function createTableProbleme() {
        if(!Schema::hasTable('probleme')){
            Schema::create('probleme', function(Blueprint $table) {
                $table->string('nume')->nullable(false)->primary();
                $table->string('location')->nullable(false);
                $table->string('slug')->nullable(false)->unique();
                $table->string('thumbnail')->nullable(true);

                $table->foreign('slug', 'fk_probleme_is_postare')
                    ->references('slug')
                    ->on('postari')
                    ->onDelete('cascade');
            });
        }
    }

    public function boot() {
        App::booted(function(){
            include __DIR__.'/Routes/override.php';
        });

        $this->createTableProbleme();
        $this->createTableSolutii();
    }
}