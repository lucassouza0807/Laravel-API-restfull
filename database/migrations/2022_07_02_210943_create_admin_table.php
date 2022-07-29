<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id("admin_id");
            $table->string("cpf")->unique();
            $table->string("nome");
            $table->string("sobrenome");
            $table->string("senha");
            $table->string("email")->unique();
            $table->boolean("role_master");
            $table->boolean("role_monitoramento");
            $table->boolean("role_vendas");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
};
