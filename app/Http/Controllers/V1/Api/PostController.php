<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\Post\StorePostRequest;
use App\Http\Resources\V1\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $query = Post::with('user:id,username')
            ->orderByDesc('created_at');

        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }

        $posts = $query->paginate(10);

        return apiSuccess(
            data: [
                'posts' => PostResource::collection($posts),
                'meta' => [
                    'current_page' => $posts->currentPage(),
                    'last_page' => $posts->lastPage(),
                    'per_page' => $posts->perPage(),
                    'total' => $posts->total(),
                    'next_page_url' => $posts->nextPageUrl(),
                ],
            ],
            message: 'Successfully fetched posts',
            code: 200
        );
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'contact_phone' => $request->validated('contact_phone'),
            'user_id' => auth()->user()->id,
        ]);

        return apiSuccess(
            data: [
                'post' => PostResource::make($post),
            ],
            message: 'Successfully created post',
            code: 201);
    }
}
