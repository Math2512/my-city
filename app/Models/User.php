<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use App\Models\Group;
use App\Models\Linkage;
use App\Models\Picture;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'client_id',
        'role',
        'is_admin',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function picture(): MorphOne
    {
        return $this->morphOne(Picture::class, 'imageable');
    }

    public function groups()
    {
        if($this->is_admin)
        {
            return $this->hasMany(Group::class, 'client_id', 'client_id');
        }else{
            return $this->hasManyThrough(Group::class, Linkage::class, 'user_id', 'id','id', 'groupable_id')->where('groups.client_id', $this->client_id);
        }
    }

    public function linkages()
    {
        return $this->hasMany(Linkage::class, 'user_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function is_admin()
    {
        return $this->is_admin;
    }

    public function is_manager()
    {
        return $this->user_profil() != Linkage::STATUS_USER || Linkage::STATUS_REDACTOR;
    }

    public function user_profil()
    {
        if($this->is_admin()){
            return $this->admin;
        }
        elseif($this->linkages()->count() > 0){
            return $this->linkages()->first()->management_type;
        }
        else{
            return;
        }
    }
}
