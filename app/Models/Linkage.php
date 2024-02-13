<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Linkage extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS_MANAGER = "manager";
    const STATUS_REDACTOR = "redactor";
    const STATUS_USER = "user";
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'groupable_id', 'groupable_type', 'management_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function groupable()
    {
        return $this->morphTo();
    }
}
