<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\Post\StorePostRequest;
use App\Services\Services\PostService;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->index();

        return apiSuccess(
            data: $posts,
            message: 'Successfully fetched posts',
            code: Response::HTTP_OK
        );
    }

    public function store(StorePostRequest $request)
    {
        $post = $this->postService->store($request->validated());

        return apiSuccess(
            data: $post,
            message: 'Successfully created post',
            code: Response::HTTP_CREATED
        );
    }
}
