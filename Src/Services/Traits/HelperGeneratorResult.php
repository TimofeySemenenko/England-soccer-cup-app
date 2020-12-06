<?php declare(strict_types=1);


namespace EnglandSoccerCup\Services\Traits;

use function EnglandSoccerCup\Services\Generator\teamInTour;

/**
 * Trait HelperGeneratorResult
 * @package EnglandSoccerCup\Services\Traits
 */
trait HelperGeneratorResult
{
    /**
     * @return array
     *
     * @throws \Exception
     */
    private function simulationScoredGoals(): array
    {

        $random = [
            'home' => random_int(0, 5),
            'way' => random_int(0, 5)
        ];

        if ($random['home'] == $random['way']) {
            $random = $this->simulationScoredGoals();
        }

        return $random;
    }

    /**
     * @param array $teams
     *
     * @return array
     */
    public function generateResult(array $teams): array
    {
        /**
         * @var array $result
         */
        $result = [];
        $totalTeam = $teams;

        if (count($teams) % 2 != 0) {
            array_push($teams, "bye");
        }

        $away = array_splice($teams, (count($teams) / 2));
        $home = $teams;

        for ($i = 0; $i < count($home) + count($away) - 1; $i++) {

            for ($j = 0; $j < count($home); $j++) {
                $scoredGoals = $this->simulationScoredGoals();
                $result[$i][$j][$home[$j]] = $scoredGoals['home'];
                $result[$i][$j][$away[$j]] = $scoredGoals['way'];
            }

            if (count($home) + count($away) - 1 > 2) {
                $array = array_splice($home, 1, 1);
                array_unshift($away, array_shift($array));
                array_push($home, array_pop($away));
            }
        }

//        foreach ($totalTeam as $key => $value) {
//            $result[count($totalTeam) - 1][$key][$value] = 1;
//        }

        unset($away);
        unset($home);
        unset($array);
        unset($teams);
        unset($scoredGoals);

        return $result;
    }
}
