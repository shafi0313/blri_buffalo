<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMilkCompositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milk_compositions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('farm_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('community_cat_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('community_id')->nullable()->constrained()->cascadeOnUpdate();

            $table->foreignId('animal_info_id')->index()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('type')->comment('1=research,2=community');
            $table->date('calving_date')->nullable();
            $table->tinyInteger('day_count')->nullable();
            $table->date('date');
            $table->double('production');
            $table->double('fat');
            $table->double('density');
            $table->double('lactose');
            $table->double('snf');
            $table->double('protein');
            $table->double('water');
            $table->double('temperature');
            $table->double('freezing_point');
            $table->double('salt');
            $table->integer('period_count')->default(0);
            $table->string('remark',196)->nullable();
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
        Schema::dropIfExists('milk_compositions');
    }
}
