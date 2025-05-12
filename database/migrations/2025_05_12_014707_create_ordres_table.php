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
        Schema::create('ordres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('travail_id')->constrained()->onDelete('cascade');
            $table->string('freelancer_nom');
            $table->string('freelancer_email');
            $table->text('proposition');
            $table->decimal('prix_propose', 10, 2);
            $table->integer('delai_jours');
            $table->string('statut')->default('en_attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordres');
    }
};
