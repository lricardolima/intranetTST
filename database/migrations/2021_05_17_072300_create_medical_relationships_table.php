<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_relationships', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('assistance_id');

            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('photo')->nullable();
            $table->enum('type', ['Avançado', 'Comum']);
            $table->longText('link');
            $table->string('responsible');

            $table->foreign('assistance_id')
            ->references('id')
            ->on('assistances')
            ->onDelete('cascade');

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
        Schema::dropIfExists('medical_relationships');
    }
}
