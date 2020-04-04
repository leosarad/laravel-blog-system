@extends('layout.layout')

@section('body')
<div class="myContainer">
    @if(count($posts)>0)
        @foreach($posts as $post)
            <div class="post-item">
                <div class="card-body">
                <h5 class="card-title"><a href="/posts/{{$post->id}}">{{$post->title}}</a></h5>
                <div class="author">
                    <a><span>b/{{$post->user->name}} |</span></a><span> {{$post->updated_at}}</span>
                </div>
                <div class='post' post=''>
                    <div class="content">
                            <div class="card-text">{!!\Illuminate\Support\Str::words($post->body,50,"...")!!}</div>
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
                    </div>
                    <div class="thumbnail" style="background-image:url('{{asset('storage/images/')}}/{{$post->thumbnail}}')"></div>
                </div>               
                </div>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p class='msg '>Be the first to create blog. <br> <a href="posts/create">Create Post</a></p>
    @endif
</div>
@endsection