<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodyWeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('body_weights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('farm_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('community_cat_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('community_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('animal_info_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('day_0')->nullable();
            $table->date('date_d_0')->nullable();
            $table->decimal('day_15')->nullable();
            $table->decimal('month_1')->nullable();
            $table->decimal('month_2')->nullable();
            $table->decimal('month_3')->nullable();
            $table->decimal('month_6')->nullable();
            $table->decimal('month_12')->nullable();
            $table->decimal('month_18')->nullable();
            $table->decimal('month_24')->nullable();
            $table->decimal('month_30')->nullable();
            $table->decimal('month_36')->nullable();
            $table->decimal('month_42')->nullable();
            $table->decimal('month_48')->nullable();
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
        Schema::dropIfExists('body_weights');
    }
}
