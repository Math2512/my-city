<?php

namespace App\Models;

use App\Models\User;
use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'address', 'zip_code', 'city', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Client::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Client::class, 'parent_id');
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
