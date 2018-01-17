<?php

namespace App;

use App\Traits\RecordsActivity;
use App\Traits\Favoritable;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable, RecordsActivity;

    protected $guarded = [];

    protected $with = ['owner', 'favorites'];

    public function owner()
    {
      return $this->belongsTo(User::class,'user_id','id');
    }
}
