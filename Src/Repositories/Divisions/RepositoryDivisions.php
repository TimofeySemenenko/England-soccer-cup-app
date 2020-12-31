<?php declare(strict_types=1);


namespace EnglandSoccerCup\Repositories\Divisions;

use EnglandSoccerCup\Models\Divisions;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RepositoryDivisions
 * @package EnglandSoccerCup\Repositories\Divisions
 */
final class RepositoryDivisions implements DivisionsContract
{
    /**
     * @var Divisions $divisions
     */
    private $divisions;

    /**
     * RepositoryDivisions constructor.
     * @param Divisions $divisions
     */
    public function __construct(Divisions $divisions)
    {
        $this->divisions = $divisions;
    }

    /**
     * @param Divisions $division
     * @param array $arUpdate
     *
     * @return Divisions
     */
    public function updateResult(Divisions $division, array $arUpdate): Divisions
    {
        return $this->divisions::where('id', $division->id)->update($arUpdate);
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function store(array $data): bool
    {
        return $this->divisions::insert($data);
    }

    /**
     * @param Divisions $team
     * @return Collection
     */
    public function getByTeam(Divisions $team): Collection
    {
        return $this->divisions::where('id', $team->id)->get();
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->divisions::all();
    }

    /**
     * @param string $league
     * @return Collection
     */
    public function teamsByLeague(string $league): Collection
    {
        return $this->divisions::where('league_name', $league)->get();
    }
}
