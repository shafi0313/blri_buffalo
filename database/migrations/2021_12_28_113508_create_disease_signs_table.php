<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseaseSignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_signs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disease_treatment_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('disease_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('clinical_sign_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('disease_signs');
    }
}
