<?php declare(strict_types=1);


namespace EnglandSoccerCup\Repositories\Results;

use EnglandSoccerCup\Models\Results;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ResultsContract
 * @package EnglandSoccerCup\Repositories\Results
 */
interface ResultsContract
{
    /**
     * @return Builder
     */
    public function truncate(): Builder;

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
     * @return Collection
     */
    public function resultByTour(string $tour): Collection;

    /**
     * @return Collection
     */
    public function getAll(): Collection;
}
