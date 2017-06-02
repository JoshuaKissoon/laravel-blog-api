@extends('layouts.master')

@section('content')
<section class="col-sm-8">
    <h2>Publish a Post</h2>

    <hr />

    <form method="POST" action="/posts">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="form-group">
            <label for="body">Body</label>
            <textarea id="body" name="body" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
        
        @include('layouts.errors')

    </form>


</section>
@endsection