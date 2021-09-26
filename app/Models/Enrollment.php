<?php

namespace App\Models;

use App\Models\Matche as Matche;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'enrollments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'championship_id',
        'club_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $appends = [
        'points',
        'goals_difference'
    ];

    public function getNameAttribute($value)
    {
        return $this->club->name . ': ' . $this->championship->name;
    }

    public function localMatches()
    {
        return $this->hasMany(Matche::class, 'local_id', 'id');
    }

    public function awayMatches()
    {
        return $this->hasMany(Matche::class, 'away_id', 'id');
    }

    public function matches_played()
    {
        return $this->localMatches()->where('start_date', '!=', null)->count() + $this->awayMatches()->where('start_date', '!=', null)->count();
    }

    public function matches_won()
    {
        $matches_won = 0;
        foreach ($this->localMatches()->where('start_date', '!=', null)->get() as $match) {

            if (count($match->goals_local) > count($match->goals_away)) {
                $matches_won++;
            }
        }

        foreach ($this->awayMatches()->where('start_date', '!=', null)->get() as $match) {
            if (count($match->goals_away) > count($match->goals_local)) {
                $matches_won++;
            }
        }

        return $matches_won;
    }

    public function matches_lost()
    {
        $matches_lost = 0;
        foreach ($this->localMatches()->where('start_date', '!=', null)->get() as $match) {
            if (count($match->goals_local) < count($match->goals_away)) {
                $matches_lost++;
            }
        }

        foreach ($this->awayMatches()->where('start_date', '!=', null)->get() as $match) {
            if (count($match->goals_away) < count($match->goals_local)) {
                $matches_lost++;
            }
        }

        return $matches_lost;
    }

    public function matches_draw()
    {
        $matches_draw = 0;
        foreach ($this->localMatches()->where('start_date', '!=', null)->get() as $match) {
            if ($match->winner == null) {
                $matches_draw++;
            }
        }

        foreach ($this->awayMatches()->where('start_date', '!=', null)->get() as $match) {
            if ($match->winner == null) {
                $matches_draw++;
            }
        }

        return $matches_draw;
    }

    public function getPointsAttribute()
    {
        $points = 0;
        $matches = Matche::where('championship_id', $this->championship->id)
            ->where('local_id', $this->id)
            ->orWhere('away_id', $this->id)->get();
        foreach ($matches as $match) {
            if ($match->start_date != null) {
                if ($match->winner) {
                    if ($match->winner->id == $this->id) {
                        $points += 3;
                    }
                } else {
                    $points += 1;
                }
            }
        }

        return $points;
    }

    // Goals for
    public function goals_for()
    {
        $goals_for = 0;
        $matches = Matche::where('championship_id', $this->championship->id)
            ->where('local_id', $this->id)->get();
        foreach ($matches as $match) {
            if ($match->start_date != null) {
                $goals_for += count($match->goals_local);
            }
        }

        $matches = Matche::where('championship_id', $this->championship->id)
            ->where('away_id', $this->id)->get();
        foreach ($matches as $match) {
            if ($match->start_date != null) {
                $goals_for += count($match->goals_away);
            }
        }

        return $goals_for;
    }

    // Goals against
    public function goals_against()
    {
        $goals_against = 0;

        $matches = Matche::where('championship_id', $this->championship->id)
            ->where('local_id', $this->id)->get();
        foreach ($matches as $match) {
            if ($match->start_date != null) {
                $goals_against += count($match->goals_away);
            }
        }

        $matches = Matche::where('championship_id', $this->championship->id)
            ->where('away_id', $this->id)->get();
        foreach ($matches as $match) {
            if ($match->start_date != null) {
                $goals_against += count($match->goals_local);
            }
        }

        return $goals_against;
    }
    // Goals Difference
    public function goals_difference()
    {
        return $this->goals_for() - $this->goals_against();
    }

    public function championship()
    {
        return $this->belongsTo(Championship::class, 'championship_id');
    }

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function players()
    {
        return $this->belongsToMany(User::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
