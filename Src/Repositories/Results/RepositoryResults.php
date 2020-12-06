<?php declare(strict_types=1);


namespace EnglandSoccerCup\Repositories\Results;

use EnglandSoccerCup\Models\Results;
use EnglandSoccerCup\Models\Divisions;

/**
 * Class RepositoryResults
 * @package EnglandSoccerCup\Repositories\Results
 */
final class RepositoryResults implements ResultsContract
{
    /**
     * @var Results|null $results
     */
    private $results;

    /**
     * RepositoryResults constructor.
     *
     * @param Results|null $results
     */
    public function __construct(?Results $results)
    {
        $this->results = $results;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function truncate(): \Illuminate\Database\Eloquent\Builder
    {
        return $this->results::truncate();
    }

    /**
     * @param Results $result
     *
     * @param array $updateData
     *
     * @return Results
     */
    public function updateResult(Results $result, array $updateData): Results
    {
        return $this->results::where('id', $result->id)->update($updateData);
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function store(array $data): bool
    {
        return $this->results::insert($data);
    }

    /**
     * @param string $tour
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function resultByTour(string $tour): \Illuminate\Database\Eloquent\Collection
    {
        return $this->results::where('tour', $tour)->get();
    }

    /**
     * @return Results
     */
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->results::all();
    }
}
