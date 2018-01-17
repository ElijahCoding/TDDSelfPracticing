<?php

namespace App;

use App\Activity;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['creator', 'channel'];


    protected static function boot()
    {
      parent::boot();

      static::addGlobalScope('replyCount', function($builder) {
        $builder->withCount('replies');
      });

      static::deleting(function($thread) {
        $thread->replies()->delete();
      });

      // static::created(function($thread) {
      //   $thread->recordActivity('created');
      // }); check RecordsActivity Trait

      // static::addGlobalScope('creator', function($builder) {
      //   $builder->with('creator');
      // });  Like protected $with = ['creator']
    }

    public function path()
    {
      return '/threads/' . $this->channel->slug . '/' . $this->id;
    }

    public function replies()
    {
      return $this->hasMany(Reply::class);

      // ->withCount('favorites')
      // ->with('owner')
    }

    public function creator()
    {
      return $this->belongsTo(User::class,'user_id','id');
    }

    public function addReply($reply)
    {
      $this->replies()->create($reply);
    }

    public function channel()
    {
      return $this->belongsTo(Channel::class);
    }

    public function scopeFilter($query, $filters)
    {
      return $filters->apply($query);
    }
}
