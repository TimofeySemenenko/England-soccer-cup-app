<?php declare(strict_types=1);


namespace EnglandSoccerCup\Repositories\Divisions;

use EnglandSoccerCup\Models\Divisions;

/**
 * Class RepositoryDivisions
 * @package EnglandSoccerCup\Repositories\Divisions
 */
final class RepositoryDivisions implements DivisionsContract
{
    /**
     * @var Divisions|null $divisions
     */
    private $divisions;

    /**
     * RepositoryDivisions constructor.
     * @param ?Divisions $divisions
     */
    public function __construct(?Divisions $divisions)
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
     * @return Divisions
     */
    public function getByTeam(Divisions $team): \Illuminate\Database\Eloquent\Collection
    {
        return $this->divisions::where('id', $team->id)->get();
    }

    /**
     * @return Divisions
     */
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->divisions::all();
    }

    /**
     * @param string $league
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function teamsByLeague(string $league): \Illuminate\Database\Eloquent\Collection
    {
        return $this->divisions::where('league_name', $league)->get();
    }
}
