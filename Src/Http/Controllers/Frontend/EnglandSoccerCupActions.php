<?php declare(strict_types=1);


namespace EnglandSoccerCup\Http\Controllers\Frontend;

use EnglandSoccerCup\Http\EnglandSoccerCupHomeController;
use EnglandSoccerCup\Repositories\Results\ResultsContract;
use EnglandSoccerCup\Repositories\Divisions\DivisionsContract;
use EnglandSoccerCup\Services\Generator\GeneratorInterface;

/**
 * Class EnglandSoccerCupActions
 * @package EnglandSoccerCup\Http\Controllers\Frontend
 */
class EnglandSoccerCupActions extends EnglandSoccerCupHomeController
{
    /**
     * @var GeneratorInterface $generator
     */
    private $generator;
    /**
     * @var ResultsContract $resultsContacts
     */
    private $resultsContacts;
    /**
     * @var DivisionsContract|null $divisionsContract
     */
    private $divisionsContract;

    /**
     * EnglandSoccerCupActions constructor.
     * @param ResultsContract|null $resultsContact
     * @param DivisionsContract|null $divisionsContract
     * @param GeneratorInterface|null $generator
     */
    public function __construct(
        ?ResultsContract $resultsContact,
        ?DivisionsContract $divisionsContract,
        ?GeneratorInterface $generator
    )
    {
        $this->generator = $generator;
        $this->resultsContacts = $resultsContact;
        $this->divisionsContract = $divisionsContract;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|
     * \Illuminate\Contracts\View\View
     */
    public function get()
    {
        $divisions = $this->divisionsContract->getAll();
        $result = $this->resultsContacts->getAll();
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
                'alert' => false,
                'buttonPlayOff' => $result->whereIn('tour','group')->toArray()
            ]
        );
    }
}
