<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Picture extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['url', 'tag', 'path', 'imageable_id', 'imageable_type'];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
