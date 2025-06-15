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
    Schema::create('donations', function (Blueprint $table) {
        $table->id();
        $table->integer('campaign_id');
        $table->decimal('amount', 15,2);
        $table->integer('donaturname')->default('N/A');
        $table->integer('donaturemail')->default('N/A');
        $table->timestamps();
        $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('donations');
  }
};
