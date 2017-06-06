<?php

    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;


    class PostsController extends Controller
    {

        public function __construct()
        {
            $this->middleware("auth:api")->except(["show"]);
        }

        public function index()
        {
            $posts = \App\Post::latest()
                    ->filter(request(['month', 'year']))
                    ->get();

            return $posts;
        }

        public function show(\App\Post $post)
        {
            return view("posts.show", compact("post"));
        }

        public function store()
        {            
            $this->validate(request(), [
                "title" => "required",
                "body" => "required",
            ]);
            $post = new \App\Post();

            $post->title = request('title');
            $post->body = request('body');
            $post->user_id = auth()->id();

            $post->save();
            
            return $post;
        }

    }
    