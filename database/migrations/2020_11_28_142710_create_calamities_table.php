<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalamitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calamities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        });

        $preData =
            [
                ['title'=> "Power Outage",],
                ['title'=> "Flood",],
                ['title'=> "Earthquake",],
            ];
        DB::table('calamities')->insert($preData);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calamities');
    }
}
