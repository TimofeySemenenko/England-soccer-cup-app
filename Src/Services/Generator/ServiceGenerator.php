<?php declare(strict_types=1);


namespace EnglandSoccerCup\Services\Generator;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use PharIo\Manifest\ElementCollectionException;
use EnglandSoccerCup\Repositories\Results\ResultsContract;
use EnglandSoccerCup\Services\Traits\HelperGeneratorResult;
use EnglandSoccerCup\Repositories\Divisions\DivisionsContract;

/**
 * Class ServiceGenerator
 * @package EnglandSoccerCup\Services\Generator
 */
final class ServiceGenerator implements GeneratorInterface
{
    use HelperGeneratorResult;

    /**
     * @var DivisionsContract $resultsContact
     */
    private $resultsContact;
    /**
     * @var ResultsContract $divisionsContract
     */
    private $divisionsContract;

    /**
     * ServiceGenerator constructor.
     *
     * @param DivisionsContract $divisionsContract
     * @param ResultsContract $resultsContact
     */
    public function __construct(
        DivisionsContract $divisionsContract,
        ResultsContract $resultsContact
    ) {
        $this->resultsContact = $resultsContact;
        $this->divisionsContract = $divisionsContract;
    }

    /**
     * @param Collection $collection
     *
     * @return array
     */
    public function generateGroup(Collection $collection): array
    {
        $res = [];
        $teams = array_keys($collection->keyBy('team_name')->all());
        $result = $this->generateResult($teams);
        call_user_func_array('array_merge', $result);

        foreach ($result as $key => $value) {
            call_user_func_array('array_merge', $value);
            foreach ($value as $items => $item) {
                $teams = array_keys($item);

                // teams and winners id
                if (count($teams) == 1) {
                    $homeTeam = $collection->firstWhere(
                        'team_name',
                        array_shift($teams)
                    )->toArray();
                    $wayTeam = $homeTeam;
                    $winner = 0;
                } else {
                    $homeTeam = $collection->firstWhere(
                        'team_name',
                        array_shift($teams)
                    )->toArray();

                    $wayTeam = $collection->firstWhere(
                        'team_name',
                        array_pop($teams)
                    )->toArray();

                    $winner = ($item[$homeTeam['team_name']] > $item[$wayTeam['team_name']]) ? $homeTeam['id'] :
                        $wayTeam['id'];
                }

                $res[] = [
                    'team_first' => $homeTeam['id'],
                    'team_second' => $wayTeam['id'],
                    'tour' => 'group',
                    'scored_team_first' => $item[$homeTeam['team_name']],
                    'scored_team_second' => $item[$wayTeam['team_name']],
                    'winner' => $winner
                ];
            }
        }

        unset($teams, $result);

        return $res;
    }

    /**
     * @param Collection $collection
     * @return array
     *
     * @throws Exception
     */
    public function generateQuarterFinal(Collection $collection): array
    {
        $pairs = [];
        $basketA = array_values(
            $collection
                ->whereIn('league_name', 'ChampionShip')
                ->sortByDesc('total')
                ->take(4)
                ->toArray()
        );
        $basketB = array_reverse(
            $collection
                ->whereIn('league_name', 'PremierLeague')
                ->sortByDesc('total')
                ->take(4)
                ->toArray()
        );

        foreach ($basketA as $item => $value) {
            $scored = $this->simulationScoredGoals();
            $pairs[] = [
                'team_first' => $value['id'],
                'team_second' => $basketB[$item]['id'],
                'tour' => 'quarter final',
                'scored_team_first' => $scored['home'],
                'scored_team_second' => $scored['way'],
                'winner' => ($scored['home'] > $scored['way']) ? $value['id'] : $basketB[$item]['id']
            ];
        }

        unset($basketA, $basketB);

        return $pairs;
    }

    /**
     * @param Collection $result
     * @param Collection $division
     *
     * @return array
     * @throws Exception
     */
    public function semiFinal(Collection $result, Collection $division): array
    {
        $res = [];
        $data = $result->keyBy('winner')->toArray();
        shuffle($data);
        $winners = array_chunk($data, 2);

        foreach ($winners as $item => $value) {
            $firsTeam = $division->whereIn(
                'id',
                array_shift($value)['winner']
            )
                ->first()
                ->toArray();

            $secondTeam = $division->whereIn(
                'id',
                array_pop($value)['winner']
            )
                ->first()
                ->toArray();
            $scored = $this->simulationScoredGoals();

            $res[] = [
                'team_first' => $firsTeam['id'],
                'team_second' => $secondTeam['id'],
                'tour' => 'semi-final',
                'scored_team_first' => $scored['home'],
                'scored_team_second' => $scored['way'],
                'winner' => ($scored['home'] > $scored['way']) ? $firsTeam['id'] :
                    $secondTeam['id']
            ];
        }

        unset($data, $winners, $firsTeam, $secondTeam);

        return $res;
    }

    /**
     * @param Collection $result
     * @param Collection $division
     *
     * @return array
     * @throws Exception
     */
    public function final(Collection $result, Collection $division): array
    {
        $data = $result->keyBy('winner')->toArray();
        shuffle($data);

        $firsTeam = $division->whereIn(
            'id',
            array_shift($data)['winner']
        )
            ->first()
            ->toArray();
        $secondTeam = $division->whereIn(
            'id',
            array_pop($data)['winner']
        )
            ->first()
            ->toArray();

        $scored = $this->simulationScoredGoals();

        $res = [
            'team_first' => $firsTeam['id'],
            'team_second' => $secondTeam['id'],
            'tour' => 'final',
            'scored_team_first' => $scored['home'],
            'scored_team_second' => $scored['way'],
            'winner' => ($scored['home'] > $scored['way']) ? $firsTeam['id'] :
                $secondTeam['id']
        ];


        unset($data, $winners, $firsTeam, $secondTeam);

        return $res;
    }

    /**
     * @param Collection $results
     * @param Collection $division
     */
    public function calculate(Collection $results, Collection $division): void
    {
        try {
            foreach ($division as $value) {
                // 3 point for one victory
                $res = $results->whereIn('winner', $value->id)->count() * 3;
                $resUpdate = $value->update(['total' => $res]);
                if (!$resUpdate) {
                    throw new ElementCollectionException('Something went wrong');
                }
            }

            unset($res, $results, $division, $resUpdate);
        } catch (ElementCollectionException $errorException) {
            $errorException->getMessage();
        }
    }

    /**
     * @param array $data
     * @param Collection $divisions
     * @param string $league
     *
     * @return array
     */
    public function map(array $data, Collection $divisions, string $league): array
    {
        $pairs = [];
        $divisions = $divisions->whereIn(
            'league_name',
            $league
        )
            ->sortByDesc('total')
            ->toArray();

        $i = 0;
        foreach ($divisions as $key => $team) {
            foreach ($data as $datum) {
                if ($datum['team_first'] == $team['id']) {
                    $pairs[$team['team_name']][] = '(H)' . $datum['scored_team_first'] . ' - '
                        . $datum['scored_team_second'];
                }
                if ($datum['team_second'] == $team['id']) {
                    $pairs[$team['team_name']][] = $datum['scored_team_first'] . ' - '
                        . $datum['scored_team_second'] . '(W)';
                }
            }
            $pairs[$team['team_name']]['total'] = $team['total'];
            array_splice($pairs[$team['team_name']], $i++, 0, '');
        }

        return $pairs;
    }
}
