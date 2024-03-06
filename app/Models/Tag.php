<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Group;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'group_id'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = '#' . ltrim($value, '#'); // Ajoute "#" au début du nom
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
