<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivationLink extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'token', 'validated'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
