<?php declare(strict_types=1);


namespace EnglandSoccerCup\Repositories\Divisions;

use EnglandSoccerCup\Models\Divisions;

/**
 * Interface DivisionsContract
 * @package EnglandSoccerCup\Repositories\Divisions
 */
interface DivisionsContract
{
    public function updateResult(Divisions $division, array $arUpdate): Divisions;

    /**
     * @param array $data
     *
     * @return bool
     */
    public function store(array $data): bool;

    /**
     * @param Divisions $team
     *
     * @return Divisions
     */
    public function getByTeam(Divisions $team): \Illuminate\Database\Eloquent\Collection;

    /**
     * @return Divisions
     */
    public function getAll(): \Illuminate\Database\Eloquent\Collection;

    /**
     * @param string $league
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function teamsByLeague(string $league): \Illuminate\Database\Eloquent\Collection;
}
