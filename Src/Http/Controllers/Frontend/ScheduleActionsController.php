<?php declare(strict_types=1);


namespace EnglandSoccerCup\Http\Controllers\Frontend;

use EnglandSoccerCup\Http\EnglandSoccerCupHomeController;
use EnglandSoccerCup\Repositories\Results\ResultsContract;
use EnglandSoccerCup\Services\Generator\GeneratorInterface;
use EnglandSoccerCup\Repositories\Divisions\DivisionsContract;

/**
 * Class ScheduleActionsController
 * @package EnglandSoccerCup\Http\Controllers\Frontend
 */
class ScheduleActionsController extends EnglandSoccerCupHomeController
{
    /**
     * @var GeneratorInterface $generator
     */
    private $generator;
    /**
     * @var ResultsContract $resultsContact
     */
    private $resultsContact;
    /**
     * @var DivisionsContract|null $divisionsContract
     */
    private $divisionsContract;

    /**
     * EnglandSoccerCupActions constructor.
     * @param GeneratorInterface|null $generator
     * @param ResultsContract|null $resultsContact
     * @param DivisionsContract|null $divisionsContract
     */
    public function __construct(
        ?GeneratorInterface $generator,
        ?ResultsContract $resultsContact,
        ?DivisionsContract $divisionsContract
    )
    {
        $this->generator = $generator;
        $this->resultsContact = $resultsContact;
        $this->divisionsContract = $divisionsContract;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|
     * \Illuminate\Contracts\View\View
     */
    public function generateGroup()
    {
        $result = $this->resultsContact
            ->getAll()
            ->whereIn('tour', 'group')
            ->toArray();

        if (empty($result)) {
            // get teams Championship from repository layer
            $divisions = $this->divisionsContract->teamsByLeague('Championship');
            $arGeneration = $this->generator->generateGroup($divisions);
            $this->resultsContact->store($arGeneration);
            unset($result);
            unset($divisions);
            unset($arGeneration);

            // get teams PremierLeague from repository layer
            $divisions = $this->divisionsContract->teamsByLeague('PremierLeague');
            $arGeneration = $this->generator->generateGroup($divisions);
            $this->resultsContact->store($arGeneration);
            unset($divisions);
            unset($arGeneration);

            // update result
            $divisions = $this->divisionsContract->getAll();
            $result = $this->resultsContact->resultByTour('group');
            $this->generator->calculate($result, $divisions);
            unset($result);
            unset($divisions);
        } else {
            $alert = true;
        }

        $divisions = $this->divisionsContract->getAll();
        $result = $this->resultsContact->getAll()->whereIn('tour', 'group');
        $championShip = $this->generator->map($result->whereIn('tour', 'group')->toArray(), $divisions, 'ChampionShip');
        $premierLeague = $this->generator->map($result->whereIn('tour', 'group')->toArray(), $divisions, 'PremierLeague');

        return view(
            'engcup.info',
            [
                'divisionChampionship' => $divisions
                    ->whereIn('league_name', 'ChampionShip')
                    ->sortByDesc('total'),
                'divisionPrimerLeague' => $divisions
                    ->whereIn('league_name', 'PremierLeague')
                    ->sortByDesc('total'),
                'championShip' => $championShip,
                'premierLeague' => $premierLeague,
                'quarter' => $result->whereIn('tour', 'quarter final'),
                'semiFinal' => $result->whereIn('tour', 'semi-final'),
                'final' => $result->whereIn('tour', 'final'),
                'divisions' => $divisions,
                'alert' => isset($alert) ? true : false,
                'buttonPlayOff' => $result->whereIn('tour','group')->toArray()
            ]
        );
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|
     * \Illuminate\Contracts\View\View
     */
    public function generatePlayOff()
    {
        $result = $this->resultsContact
            ->getAll()
            ->whereIn('tour', 'quarter final')
            ->toArray();

        if (empty($result)) {
            $dataDivision = $this->divisionsContract->getAll();
            // get teams Playoff from repository layer
            $divisions = $this->divisionsContract->getAll();
            $arGeneration = $this->generator->generateQuarterFinal($divisions);
            $this->resultsContact->store($arGeneration);
            unset($result);
            unset($divisions);
            unset($arGeneration);

            // semi-final
            $result = $this->resultsContact->resultByTour('quarter final');
            $arGeneration = $this->generator->semiFinal($result, $dataDivision);
            $this->resultsContact->store($arGeneration);
            unset($result);
            unset($arGeneration);

            // final
            $result = $this->resultsContact->resultByTour('semi-final');
            $arGeneration = $this->generator->final($result, $dataDivision);
            $this->resultsContact->store($arGeneration);
            unset($result);
            unset($arGeneration);
        } else {
            $alert = true;
        }

        $divisions = $this->divisionsContract->getAll();
        $result = $this->resultsContact->getAll();
        $championShip = $this->generator->map($result->whereIn('tour', 'group')->toArray(), $divisions, 'ChampionShip');
        $premierLeague = $this->generator->map($result->whereIn('tour', 'group')->toArray(), $divisions, 'PremierLeague');

        return view(
            'engcup.info',
            [
                'divisionChampionship' => $divisions
                    ->whereIn('league_name', 'ChampionShip')
                    ->sortByDesc('total'),
                'divisionPrimerLeague' => $divisions
                    ->whereIn('league_name', 'PremierLeague')
                    ->sortByDesc('total'),
                'championShip' => $championShip,
                'premierLeague' => $premierLeague,
                'quarter' => $result->whereIn('tour', 'quarter final'),
                'semiFinal' => $result->whereIn('tour', 'semi-final'),
                'final' => $result->whereIn('tour', 'final'),
                'divisions' => $divisions,
                'alert' => isset($alert) ? true : false,
                'buttonPlayOff' => $result->whereIn('tour','group')->toArray()
            ]
        );
    }
}
