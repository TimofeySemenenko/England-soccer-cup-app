<?php declare(strict_types=1);


namespace EnglandSoccerCup\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Results
 * @package EnglandSoccerCup\Models
 */
class Results extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string $table
     */
    protected $table = 'result';
    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'id',
        'team_first',
        'team_second',
        'tour',
        'scored_team_first',
        'scored_team_second',
        'winner',
        'updated_at',
        'created_at'
    ];
    /**
     * @var mixed
     */
    private $id;
}
