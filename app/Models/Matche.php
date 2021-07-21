<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matche extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'matches';

    protected $dates = [
        'start_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'championship_id',
        'local_id',
        'round',
        'away_id',
        'start_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $appends = ['goals_local', 'goals_away', 'winner'];

    public function getGoalsLocalAttribute()
    {
        return Event::where('type', 'goal')->where('match_id', $this->id)
            ->where('club_id', $this->local->id)->get();
    }
    public function getGoalsAwayAttribute()
    {
        return Event::where('type', 'goal')->where('match_id', $this->id)
            ->where('club_id', $this->away->id)->get();
    }
    public function getWinnerAttribute()
    {
        $winner = null;
        if (count($this->goals_local) > count($this->goals_away)) {
            $winner = $this->local;
        }
        if (count($this->goals_local) < count($this->goals_away)) {
            $winner = $this->away;
        }
        return $winner;
    }


    public function getNameAttribute()
    {
        return $this->local->name . " VS. " . $this->away->name;
    }

    public function matchEvents()
    {
        return $this->hasMany(Event::class, 'match_id', 'id');
    }

    public function local()
    {
        return $this->belongsTo(Enrollment::class, 'local_id');
    }

    public function away()
    {
        return $this->belongsTo(Enrollment::class, 'away_id');
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
