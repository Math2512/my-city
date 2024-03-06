<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\User;
use App\Models\Group;
use App\Models\Client;
use App\Models\Survey;
use App\Models\Linkage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'client_id',
        'group_id',
        'author_linkage_id',
        'scheduled_at',
        'sponsored',
        'post_timeframe',
        'end_date',
        'content',
        'survey'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'end_date' => 'datetime',
        'sponsored' => 'boolean',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function authorLinkage()
    {
        return $this->belongsTo(Linkage::class, 'author_linkage_id');
    }


    public function pictures(): MorphMany
    {
        return $this->morphMany(Picture::class, 'imageable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function formatted_created_at()
    {
        return Carbon::parse($this->created_at)->locale('fr_FR')->isoFormat('dddd D MMMM [à] HH[h]mm');
    }

    public function signature()
    {
        return 'Créé par '.$this->user->name.' '.$this->user->role.' - Le '.$this->formatted_created_at();
    }

    public function survey()
    {
        return $this->hasOne(Survey::class);
    }
}
