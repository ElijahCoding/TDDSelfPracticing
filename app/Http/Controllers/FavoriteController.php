<?php

namespace App\Http\Controllers;

use DB;
use App\Reply;
use App\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct()
    {
      $this->middleware(['auth']);
    }

    public function store(Reply $reply)
    {
      return $reply->favorite();
      //  DB::table('favorites')->insert([
      //   'user_id' => auth()->user()->id,
      //   'favorited_id' => $reply->id,
      //   'favorited_type' => get_class($reply)
      // ]);
    }
}
