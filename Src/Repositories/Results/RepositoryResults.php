<?php declare(strict_types=1);


namespace EnglandSoccerCup\Repositories\Results;

use EnglandSoccerCup\Models\Results;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

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
     * @return Builder
     */
    public function truncate(): Builder
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
     * @return Collection
     */
    public function resultByTour(string $tour): Collection
    {
        return $this->results::where('tour', $tour)->get();
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->results::all();
    }
}
