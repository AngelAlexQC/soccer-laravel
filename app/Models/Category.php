<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'min_age',
        'max_age',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function categoryClubs()
    {
        return $this->hasMany(Club::class, 'category_id', 'id');
    }

    public function categoryChampionships()
    {
        return $this->hasMany(Championship::class, 'category_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
