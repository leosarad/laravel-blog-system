@extends('layout.layout')

@section('body')
<div class=" myContainer">
            <div class="card post-item justify-content-center">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @guest 
                    <div>You are not logged in to enter dashboard.</div>
                    <div><a href="{{ route('login') }}">{{ __('Login') }}</a></div>
                    @if (Route::has('register'))
                    <div> Dont have an account, <a href="{{ route('register') }}">{{ __('Register') }}</a></div>
                    @endif
                    @else
                    <div>
                        Welcome to dahboard. Manage your Content here
                    </div>
                    <div>
                        <div class="card post-item">
                            <div class="card-header">
                                    My Blog Posts 
                                        <a class='btn btn-primary' href="posts/create">Create New Post</a>
                            </div>
                            <div class="card-body">
                                @if(count($posts)>0)
                                    <table>
                                    <tr>
                                        <th style="width:75%">Title</th>
                                        <th colspan=2>Actions</th>
                                    </tr>
                                    @foreach($posts as $post )
                                    
                                    <tr>
                                        <td>{{$post->title}}</td>
                                        <td><a href="/posts/{{$post->id}}/edit"> Edit</a> | </td>
                                        <td><a href="/posts/{{$post->id}}/delete">  Delete</a></td>
                                    </tr>

                                    @endforeach
                                </table>
                                @else
                                <div>No Posts yet</div>
                                @endif
                            </div>
                        </div>

                    </div>
                    @endguest
                </div>
            </div>
    </div>
</div>
@endsection
