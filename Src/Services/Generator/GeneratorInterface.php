<?php declare(strict_types=1);


namespace EnglandSoccerCup\Services\Generator;

use \Illuminate\Database\Eloquent\Collection;

/**
 * Interface GeneratorInterface
 * @package EnglandSoccerCup\Providers
 */
interface GeneratorInterface
{
    /**
     * @param Collection $divisions
     *
     * @return array
     */
    public function generateGroup(Collection $divisions): array;

    /**
     * @param Collection $divisions
     *
     * @return array
     */
    public function generateQuarterFinal(Collection $divisions): array;

    /**
     * @param Collection $results
     * @param Collection $division
     *
     * @return array
     */
    public function semiFinal(Collection $results, Collection $division): array;

    /**
     * @param Collection $results
     * @param Collection $division
     *
     * @return array
     */
    public function final(Collection $results, Collection $division): array;

    /**
     * @param Collection $results
     * @param Collection $division
     *
     * @return void
     */
    public function calculate(Collection $results, Collection $division): void;

    /**
     * @param array $data
     * @param Collection $divisions
     * @param string $league
     *
     * @return array
     */
    public function map(array $data, Collection $divisions, string $league): array;
}
