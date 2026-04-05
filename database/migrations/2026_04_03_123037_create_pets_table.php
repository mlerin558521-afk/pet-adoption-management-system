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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');                     
            $table->string('photo')->nullable();        
            $table->string('species')->nullable();      
            $table->text('characteristics')->nullable(); 
            $table->string('breed')->nullable();      
            $table->string('gender')->nullable();       
            $table->integer('age')->nullable();        
            $table->boolean('adopted')->default(false);  
            $table->timestamps();
            $table->string('status')->default('available');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
