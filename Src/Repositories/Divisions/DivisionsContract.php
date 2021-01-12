<?php declare(strict_types=1);


namespace EnglandSoccerCup\Repositories\Divisions;

use EnglandSoccerCup\Models\Divisions;
use Illuminate\Database\Eloquent\Collection;

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
     * @return Collection
     */
    public function getByTeam(Divisions $team): Collection;

    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param string $league
     * @return Collection
     */
    public function teamsByLeague(string $league): Collection;
}
