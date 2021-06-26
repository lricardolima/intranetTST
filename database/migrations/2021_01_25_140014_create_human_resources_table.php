<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHumanResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('human_resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('administrative_id');

            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('photo')->nullable();
            $table->enum('type', ['Avançado', 'Comum']);
            $table->longText('link');
            $table->string('responsible');

            $table->foreign('administrative_id')
            ->references('id')
            ->on('administratives')
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
        Schema::dropIfExists('human_resources');
    }
}
