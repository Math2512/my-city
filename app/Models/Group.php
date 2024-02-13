<?php

namespace App\Models;

use App\Models\Linkage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'activity', 'client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function picture(): MorphOne
    {
        return $this->morphOne(Picture::class, 'imageable');
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, Linkage::class, 'groupable_id', 'id','id', 'user_id');
    }

    public function linkages()
    {
        return $this->hasMany(Linkage::class, 'groupable_id');
    }
}
