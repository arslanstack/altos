<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workorders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('no_small_format');
            //$table->unsignedBigInteger('user_id');  //unsignedBigInteger('user');
            //$table->foreign('user')->references('id')->on('users');
            $table->char('jobname');
            $table->char('jobnumber')->nullable();
             $table->integer('lg1orig')->nullable();
            $table->integer('lg1copy')->nullable();
            $table->string('lg1size')->nullable();
            $table->string('lg1colorsides')->nullable();
            $table->string('lg1scale')->nullable();
            $table->string('lg1binding')->nullable();
             $table->string('lg1description')->nullable();
             $table->string('lg2orig')->nullable();
            $table->integer('lg2copy')->nullable();
            $table->string('lg2size')->nullable();
             $table->string('lg2colorsides')->nullable();
             $table->string('lg2scale')->nullable();
             $table->string('lg2binding')->nullable();
             $table->string('lg2description')->nullable();
              $table->integer('sm1orig')->default(0);
            $table->integer('sm1copy')->default(0);
            $table->string('sm1size')->nullable();
            $table->string('sm1colorsides')->nullable();
            $table->string('sm1scale')->nullable();
            $table->string('sm1binding')->nullable();
             $table->string('sm1description')->nullable();        
             $table->string('sm2orig')->nullable();       
             $table->integer('sm2copy')->nullable();       
             $table->string('sm2size')->nullable();
             $table->string('sm2colorsides')->nullable();
             $table->string('sm2scale')->nullable();
             $table->string('sm2binding')->nullable();
             $table->string('sm2description')->nullable();    
             $table->string('turnaround');
             $table->string('delivery');
             $table->string('alt_address')->nullable();
             $table->string('specialinstructions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workorders');
    }
};
