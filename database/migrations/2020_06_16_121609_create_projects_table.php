<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('quest')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->date('ps')->nullable();
            $table->date('pe')->nullable();
            $table->date('ss')->nullable();
            $table->date('se')->nullable();
            $table->date('prs')->nullable();
            $table->date('pre')->nullable();
            $table->string('files_path')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
