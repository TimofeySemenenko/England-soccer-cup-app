<?php declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_first')->index();
            $table->integer('team_second')->index();
            $table->enum('tour', ['group', 'quarter final', 'semi-final', 'final']);
            $table->integer('scored_team_first');
            $table->integer('scored_team_second');
            $table->integer('winner')->index();
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
        Schema::dropIfExists('result');
    }
}
