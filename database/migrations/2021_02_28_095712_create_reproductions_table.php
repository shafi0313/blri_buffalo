<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReproductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reproductions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('farm_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('community_cat_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('community_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('animal_info_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('puberty_age')->nullable();
            
            $table->date('service_1st_date')->nullable();
            $table->date('calving_1st_date')->nullable();

            // $table->float('ges_lenght_1st_kidding')->nullable();
            // $table->float('age_1st_kidding')->nullable();
            $table->float('milk_production')->nullable();

            $table->date('service_2nd_date')->nullable();
            $table->date('calving_2nd_date')->nullable();

            $table->date('service_3rd_date')->nullable();
            $table->date('calving_3rd_date')->nullable();

            $table->date('service_4th_date')->nullable();
            $table->date('calving_4th_date')->nullable();

            $table->date('service_5th_date')->nullable();
            $table->date('calving_5th_date')->nullable();

            $table->date('service_6th_date')->nullable();
            $table->date('calving_6th_date')->nullable();

            $table->date('service_7th_date')->nullable();
            $table->date('calving_7th_date')->nullable();

            $table->date('service_8th_date')->nullable();
            $table->date('calving_8th_date')->nullable();

            $table->date('service_9th_date')->nullable();
            $table->date('calving_9th_date')->nullable();

            $table->date('service_10th_date')->nullable();
            $table->date('calving_10th_date')->nullable();
            $table->string('remarks',50)->nullable();
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
        Schema::dropIfExists('reproductions');
    }
}
