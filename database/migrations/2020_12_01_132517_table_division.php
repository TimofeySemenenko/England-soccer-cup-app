<?php declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableDivision extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('division', function (Blueprint $table) {
            $table->increments('id');
            $table->string('team_name', 16000);
            $table->enum('league_name', ['PremierLeague', 'ChampionShip']);
            $table->integer('total')->nullable();
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
        Schema::dropIfExists('division');
    }
}
