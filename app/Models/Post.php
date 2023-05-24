<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'meaning',
        'count',
    ];

    public function getPaginateByLimit(int $limit_count = 20)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('count')->paginate($limit_count);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
