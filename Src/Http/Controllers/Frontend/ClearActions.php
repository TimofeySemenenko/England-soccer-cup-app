<?php declare(strict_types=1);


namespace EnglandSoccerCup\Http\Controllers\Frontend;

use EnglandSoccerCup\Http\EnglandSoccerCupHomeController;
use EnglandSoccerCup\Repositories\Results\ResultsContract;
use EnglandSoccerCup\Repositories\Divisions\DivisionsContract;
use EnglandSoccerCup\Services\Generator\GeneratorInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;

/**
 * Class ClearActions
 * @package EnglandSoccerCup\Http\Controllers\Frontend
 */
class ClearActions extends EnglandSoccerCupHomeController
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
     * ClearActions constructor.
     * @param ResultsContract $resultsContact
     * @param DivisionsContract $divisionsContract
     * @param GeneratorInterface $generator
     */
    public function __construct(
        ResultsContract $resultsContact,
        DivisionsContract $divisionsContract,
        GeneratorInterface $generator
    ) {
        $this->generator = $generator;
        $this->resultsContact = $resultsContact;
        $this->divisionsContract = $divisionsContract;
    }

    /**
     * @return Application|Factory|
     * \Illuminate\Contracts\View\View
     */
    public function truncate()
    {
        $this->resultsContact->truncate();
        $divisions = $this->divisionsContract->getAll();
        $result = $this->resultsContact->getAll()->whereIn('tour', 'group');
        $championShip = $this->generator->map($result->whereIn('tour', 'group')->toArray(), $divisions, 'ChampionShip');
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
                'alert' => false,
                'buttonPlayOff' => $result->whereIn(
                    'tour',
                    'group'
                )->toArray()
            ]
        );
    }
}
