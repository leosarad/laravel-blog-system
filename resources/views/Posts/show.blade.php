@extends('layout.layout')

@section('body')
<div class="myContainer">
    @if(!$post==null)
        <div class="post-container">
            <h3 class="title">{{$post->title}} </h3>
            <div class="details"><span class="author">b/{{$post->user->name}} </span><span class="date"> | {{$post->created_at}}</span> 
                @if(!Auth::guest())
                    @if(Auth::user()->id==$post->user_id)
                    <span><a href="/posts/{{$post->id}}/edit">edit</a></span><span><a href="/posts/{{$post->id}}/delete">delete</a></span>
                @endif
                @endif
            </div>
            <div class="post-thumbnail" style="background-image:url('{{asset('storage/images/')}}/{{$post->thumbnail}}')">

            </div>
            <div class="card-text">{!!$post->body!!}</div>
            <div class="actions" post=''>
                @if(!auth()->guest())
                    @if($post->likes->where('user_id',auth()->user()->id)->first()!==null)
                        <span><i class="fa fa-heart-o active" aria-hidden="true"></i> <span> {{$post->total_likes}} </span></span>
                    @else
                    <span><i class="fa fa-heart-o like" aria-hidden="true" onclick="postLike({{$post->id}},this)"></i> <span> {{$post->total_likes}} </span></span>
                    @endif
                @else
                    <span><i class="fa fa-heart-o like" aria-hidden="true" ></i> <span> {{$post->total_likes}} </span></span>
                @endif
                <span><i data='views' class="fa fa-eye" aria-hidden="true"></i> <span> {{$post->total_views}} </span> </span>
                <span><i data='comments' class="fa fa-comment" aria-hidden="true" onclick="postComment({{$post->id}},this)"></i> <span> {{$post->total_comments}} </span> </span>
            </div>
            <div class="commentBox">
                    <form id="commentForm">
                        @csrf
                        <input type="text" name="comment" id="comments">
                        <input type="submit" class='btn btn-primary' value="Comment">
                    </form>
                    <div>
                    @foreach($post->comments as $comment)
                        <div class='comments'>
                            <div>b/{{$comment->user->name}}</div>
                            <div>> {{$comment->comment}}</div>
                        </div>
                    @endforeach
                    </div>
            </div>
    @else
        <p class='post-item'>No Blog Found {{$id}}</p>
    @endif
</div>
@endsection