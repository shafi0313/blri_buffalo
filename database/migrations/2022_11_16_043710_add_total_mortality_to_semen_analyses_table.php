<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('semen_analyses', function (Blueprint $table) {
                $table->string('total_mortality', 16)->after('straw_prepared')->nullable();
                $table->string('progressive_mortality', 16)->after('straw_prepared')->nullable();
                $table->string('sperm_concentration', 16)->after('straw_prepared')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('semen_analyses', function (Blueprint $table) {
            $table->dropColumn(['total_mortality','progressive_mortality','sperm_concentration']);
        });
    }
};
