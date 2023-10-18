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
        Schema::table('voyages', function (Blueprint $table) {
            $table->string('lieu');
            $table->string('type');
            $table->integer('nombre_personnes');
            $table->integer('nombre_jours');
            $table->integer('budget');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('voyages', function (Blueprint $table) {
            $table->dropColumn('itineraires');
            $table->dropColumn('recommandation');
            $table->dropColumn('lieu');
            $table->dropColumn('type');
            $table->dropColumn('nombre_personnes');
            $table->dropColumn('nombre_jours');
            $table->dropColumn('budget');
        });
    }
};
