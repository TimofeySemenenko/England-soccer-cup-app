<?php declare(strict_types=1);


namespace EnglandSoccerCup\Http\Controllers\Frontend;

use EnglandSoccerCup\Http\EnglandSoccerCupHomeController;
use EnglandSoccerCup\Repositories\Results\ResultsContract;
use EnglandSoccerCup\Services\Generator\GeneratorInterface;
use EnglandSoccerCup\Repositories\Divisions\DivisionsContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;

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
    ) {
        $this->generator = $generator;
        $this->resultsContact = $resultsContact;
        $this->divisionsContract = $divisionsContract;
    }

    /**
     * @return Application|Factory|
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
            unset($result, $divisions, $arGeneration);

            // semi-final
            $result = $this->resultsContact->resultByTour('quarter final');
            $arGeneration = $this->generator->semiFinal($result, $dataDivision);
            $this->resultsContact->store($arGeneration);
            unset($arGeneration, $result);

            // final
            $result = $this->resultsContact->resultByTour('semi-final');
            $arGeneration = $this->generator->final($result, $dataDivision);
            $this->resultsContact->store($arGeneration);
            unset($arGeneration, $result);
        } else {
            $alert = true;
        }

        $divisions = $this->divisionsContract->getAll();
        $result = $this->resultsContact->getAll();
        $championShip = $this->generator->map(
            $result->whereIn('tour', 'group')->toArray(),
            $divisions,
            'ChampionShip'
        );
        $premierLeague = $this->generator->map(
            $result->whereIn('tour', 'group')->toArray(),
            $divisions,
            'PremierLeague'
        );

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
                'alert' => isset($alert),
                'buttonPlayOff' => $result->whereIn('tour', 'group')->toArray()
            ]
        );
    }
}
