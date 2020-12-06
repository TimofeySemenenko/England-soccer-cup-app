<?php declare(strict_types=1);


namespace Database\Seeders\EnglandCupSeeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class DivisionsSeeders
 * @package Database\Seeders\EnglandCupSeeders
 */
class DivisionsSeeders extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('division')->delete();
        //championship
        DB::table('division')->insert(
            [
                'team_name' => 'Norwich City',
                'league_name' => 'ChampionShip',
                'total' => 0,
            ]);

        DB::table('division')->insert(
            [
                'team_name' => 'AFC Bournemouth',
                'league_name' => 'ChampionShip',
                'total' => 0,
            ]);

        DB::table('division')->insert(
            [
                'team_name' => 'Watford',
                'league_name' => 'ChampionShip',
                'total' => 0,
            ]);

        DB::table('division')->insert(
            [
                'team_name' => 'Swansea City',
                'league_name' => 'ChampionShip',
                'total' => 0,
            ]);

        DB::table('division')->insert(
            [
                'team_name' => 'Reading',
                'league_name' => 'ChampionShip',
                'total' => 0,
            ]);

        DB::table('division')->insert(
            [
                'team_name' => 'Bristol City',
                'league_name' => 'ChampionShip',
                'total' => 0,
            ]);

        DB::table('division')->insert(
            [
                'team_name' => 'Brentford',
                'league_name' => 'ChampionShip',
                'total' => 0,
            ]);

        DB::table('division')->insert(
            [
                'team_name' => 'Stoke City',
                'league_name' => 'ChampionShip',
                'total' => 0,
            ]);
        // primer
        DB::table('division')->insert(
            [
                'team_name' => 'Tottenham Hotspur',
                'league_name' => 'PremierLeague',
                'total' => 0,
            ]);

        DB::table('division')->insert(
            [
                'team_name' => 'Liverpool',
                'league_name' => 'PremierLeague',
                'total' => 0,
            ]);

        DB::table('division')->insert(
            [
                'team_name' => 'Chelsea',
                'league_name' => 'PremierLeague',
                'total' => 0,
            ]);

        DB::table('division')->insert(
            [
                'team_name' => 'Leicester City',
                'league_name' => 'PremierLeague',
                'total' => 0,
            ]);

        DB::table('division')->insert(
            [
                'team_name' => 'West Ham United',
                'league_name' => 'PremierLeague',
                'total' => 0,
            ]);

        DB::table('division')->insert(
            [
                'team_name' => 'Southampton',
                'league_name' => 'PremierLeague',
                'total' => 0,
            ]);

        DB::table('division')->insert(
            [
                'team_name' => 'Manchester United',
                'league_name' => 'PremierLeague',
                'total' => 0,
            ]);

        DB::table('division')->insert(
            [
                'team_name' => 'Newcastle United',
                'league_name' => 'PremierLeague',
                'total' => 0,
            ]);
    }
}
