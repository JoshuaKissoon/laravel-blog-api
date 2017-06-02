<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    use Carbon\Carbon;
    
    class Post extends Model
    {

        public function comments()
        {
            return $this->hasMany(Comment::class);
        }

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function addComment($body)
        {
            $comment = new Comment;
            $comment->body = $body;
            $comment->post_id = $this->id;

            $comment->save();
        }

        public function scopeFilter($query, $filters)
        {

            if ($filters['month'])
            {
                $month = $filters['month'];
                $query->whereMonth('created_at', Carbon::parse($month)->month);
            }

            if ($filters['year'])
            {
                $year = $filters['year'];
                $query->whereYear('created_at', $year);
            }
        }

    }
    