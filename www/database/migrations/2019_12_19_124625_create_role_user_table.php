<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Role_User', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string("role_role", 20)->nullable(false);
            $table->string("user_Email", 40)->nullable(false);
        });

        Schema::table('role_user', function (Blueprint $table){
            $table->foreign('role_role', 'fk_Role_User_Roles_role')
                  ->references('role')
                  ->on('Roles')
                  ->onDelete('cascade');
            $table->foreign('user_Email', 'fk_Role_User_Useri_Email')
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
        Schema::table('Role_User', function (Blueprint $table) {
            $table->dropForeign('fk_Role_User_Roles_role');
            $table->dropForeign('fk_Role_User_Useri_Email');
        });
        Schema::dropIfExists('Role_User');
    }
}
