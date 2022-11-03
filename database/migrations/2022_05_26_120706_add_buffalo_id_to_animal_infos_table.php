<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBuffaloIdToAnimalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('animal_infos', function (Blueprint $table) {
            $table->string('identification_no',16)->index()->nullable()->after('animal_tag');
            $table->integer('buffalo_id')->index()->nullable()->after('animal_tag');
            $table->integer('tattoo_no')->index()->nullable()->after('animal_tag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('animal_infos', function (Blueprint $table) {
            $table->dropColumn(['identification_no','buffalo_id','tattoo_no']);
        });
    }
}
