<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(3);
        return view('Posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'thumbnail' => 'image|nullable|max:1999'
        ]);
        
        // Handle Thumbnail
        if($request->hasFile('thumbnail')){
            $filenameWithExt = $request->file('thumbnail')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);        
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().".".$extension;

            //upload Image
            $path = $request->file('thumbnail')->storeAs('public/images',$filenameToStore);

        } else {
            $filenameToStore = 'thumbnail.png';
        }

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;
        $post->thumbnail=$filenameToStore;
        $post->total_likes = $post->total_views = $post->total_comments = 0;
        $response = $post->save();

        echo json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->view($id);
        $post = Post::find($id);
        return view('posts.show')->with(["post"=>$post,'id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id!==$post->user_id){
            return redirect('/posts')->with('Error','Not Authorized');
        }
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
        {   $this->validate($request,[
            'title' => 'required',
            'body' => 'required'
        ]);
        
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $response=$post->save();


        echo json_encode($response);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id!==$post->user_id){
            return redirect('/posts')->with('Error','Not Authorized');
        }
        $post->delete();

        return redirect('/posts')->with('success','Post Deleted');
    }

    private function view($id){
        $post = Post::find($id);
        if(!auth()->guest()){
            if(auth()->user()->id!==$post->user_id){
                $post->total_views++;
                $post->save();
            } 
        }
    }
}