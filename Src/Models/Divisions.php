<?php declare(strict_types=1);


namespace EnglandSoccerCup\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Divisions
 * @package EnglandSoccerCup\Models
 */
class Divisions extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string $table
     */
    protected $table = 'division';
    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'id',
        'team_name',
        'league_name',
        'total',
        'updated_at',
        'created_at'
    ];

}
