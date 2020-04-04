<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Post;
use App\Comment;
class PostActionsController extends Controller
{
    public function comment($id,Request $request){
        if(!auth()->guest()){
            $comment = new Comment();
            $comment->comment = $request->comment;
            $comment->user_id = auth()->user()->id;
            $comment->post_id = $id;
            $result = $comment->save();
            if($result){
                $post = Post::find($id);
                $post->total_comments++;
                $post->save();
                $data = [auth()->user()->name,$comment->comment];
                echo json_encode($data);
            } else {
                echo json_encode(null);
            }
        } else {
            echo json_encode(null);
        }
    } 
    public function like($id){
        $post = Post::find($id);
        if(!auth()->guest()){
            if($post->likes->where('user_id',auth()->user()->id)->first()==null){
                $like = new Like();
                $like->user_id = auth()->user()->id;
                $like->post_id = $id;
                $like->save();
                
                $post->total_likes=$post->total_likes+1;
                $post->save();
                echo json_encode(200);
            } else {
                echo json_encode(400);
            }
        } else {
            echo json_encode("GUest");
        }
    }
}
