<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        {
//            "id": 2062,
//            "area": {
//            "id": 2262,
//                "name": "Venezuela"
//            },
//            "name": "Primera División",
//            "code": null,
//            "emblemUrl": null,
//            "plan": "TIER_FOUR",
//            "currentSeason": {
//            "id": 456,
//                "startDate": "2019-01-25",
//                "endDate": "2019-12-07",
//                "currentMatchday": 19,
//                "winner": null
//            },
//            "numberOfAvailableSeasons": 2,
//            "lastUpdated": "2019-05-24T13:40:08Z"
//        },
        Schema::create('competitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('footballdata_id')->unique();
            $table->integer('area_id');
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('emblemUrl')->nullable();
            $table->timestamps();

//            $table->foreign('area_id')->references('id')
//                ->on('areas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competitions');
    }
}
