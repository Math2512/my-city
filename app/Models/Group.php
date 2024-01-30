<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Group extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'description', 'activity', 'client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }



    public function picture(): MorphOne
    {
        return $this->morphOne(Picture::class, 'imageable');
    }
}
