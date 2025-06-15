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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string ('status')->default('PENDING');
            $table->integer('owner');
            $table->string ('title');
            $table->string ('category')->default('N/A');
            $table->string ('location');
            $table->string ('photo');
            $table->string ('description');
            $table->string ('updateplan')->nullable();
            $table->string ('videolink')->nullable();
            $table->decimal('targetfunding', 15,2);
            $table->date   ('deadline');
            $table->string ('accounttype');
            $table->string ('accountbank');
            $table->string ('accountholder');
            $table->string ('accountno');
            $table->string ('address')->default('N/A');
            $table->timestamps();
            $table->foreign('owner')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
