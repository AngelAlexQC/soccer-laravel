<?php

namespace App\Models;

use \DateTimeInterface;
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

    public function getNameAttribute($value){
        return $this->club->slug ." - ".$this->championship->name;
    }

    public function localMatches()
    {
        return $this->hasMany(Match::class, 'local_id', 'id');
    }

    public function awayMatches()
    {
        return $this->hasMany(Match::class, 'away_id', 'id');
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
