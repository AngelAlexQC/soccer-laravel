<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const TYPE_RADIO = [
        'red_card'    => 'Tarjeta Roja',
        'yellow_card' => 'Tarjeta Amarilla',
        'change'      => 'Cambio',
        'goal'        => 'Gol',
    ];

    public $table = 'events';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'minute',
        'description',
        'match_id',
        'club_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function match()
    {
        return $this->belongsTo(Matche::class, 'match_id');
    }

    public function club()
    {
        return $this->belongsTo(Enrollment::class, 'club_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
