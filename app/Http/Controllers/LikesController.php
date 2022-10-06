<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class LikesController extends Controller
{
    public function index(Post $post, Request $request){

       
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();
        
    }

    public function destroy(Post $post, Request $request){
      $post>delete();
      return back();
    }
}
