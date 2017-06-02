<?php

    namespace App\Http\Controllers;


    class PostsController extends Controller
    {

        public function __construct()
        {
            $this->middleware("auth")->except(["index", "show"]);
        }

        public function index()
        {
            $posts = \App\Post::latest()
                    ->filter(request(['month', 'year']))
                    ->get();

            $archives = \App\Post::selectRaw('year(created_at) as year, monthname(created_at) as month, count(*) as published')
                    ->groupBy('year', 'month')
                    ->orderByRaw('MIN(created_at) DESC')
                    ->get()
                    ->toArray();

            return view("posts.index", compact('posts', 'archives'));
        }

        public function show(\App\Post $post)
        {
            return view("posts.show", compact("post"));
        }

        public function create()
        {
            return view('posts.create');
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


            return redirect("/");
        }

    }
    