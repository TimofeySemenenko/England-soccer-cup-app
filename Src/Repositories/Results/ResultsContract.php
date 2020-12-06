<?php declare(strict_types=1);


namespace EnglandSoccerCup\Repositories\Results;

use EnglandSoccerCup\Models\Results;
use EnglandSoccerCup\Models\Divisions;

/**
 * Interface ResultsContract
 * @package EnglandSoccerCup\Repositories\Results
 */
interface ResultsContract
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function truncate(): \Illuminate\Database\Eloquent\Builder;

    /**
     * @param Results $result
     * @param array $updateData
     *
     * @return Results
     */
    public function updateResult(Results $result, array $updateData): Results;

    /**
     * @param array $data
     *
     * @return bool
     */
    public function store(array $data): bool;

    /**
     * @param string $tour
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function resultByTour(string $tour): \Illuminate\Database\Eloquent\Collection;

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): \Illuminate\Database\Eloquent\Collection;
}
