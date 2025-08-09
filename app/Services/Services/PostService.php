<?php

namespace App\Services\Services;

use App\Http\Resources\V1\PostResource;
use App\Models\Post;

class PostService
{
    public function index()
    {
        $query = Post::with('user:id,username')
            ->orderByDesc('created_at');

        if (auth()->check()) {
            $query->where('user_id', '!=', auth('api')->id());
        }

        $posts = $query->paginate(10);

        $posts = [
            'posts' => PostResource::collection($posts),
            'meta' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
                'next_page_url' => $posts->nextPageUrl(),
            ],
        ];

        return $posts;
    }

    public function store(array $data)
    {
        $post = Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'contact_phone' => $data['contact_phone'],
            'user_id' => auth('api')->user()->id,
        ]);

        return PostResource::make($post);
    }
}
