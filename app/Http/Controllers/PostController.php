<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostController extends Controller
{


    /**
     * @return mixed
     */
    public function index()
    {
        $post = Post::all();
      return response()->json([
          'success'=>true,
          'data'=>$post
      ],200);
    }
    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post with id ' . $id . ' not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $post->toArray()
        ], 200);


    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {

       $this->validate($request, [
            'title' => 'required',
            'description' => 'required|string|min:10|max:255',
            'category' => 'required|string|min:10|max:255'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category = $request->category;

        if (auth()->user()->post()->save($post))
            return response()->json([
                'success' => true,
                'data' => $post->toArray()
            ],200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post could not be added'
            ], 500);
    }

    /**
     * @param Request $request
     * @param Post $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {

        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, post with id ' . $id . ' cannot be found.'
            ], 400);
        }

        $post->fill($request->all())->save();


        if ($post) {
            return response()->json([
                'success' => true
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, post could not be updated.'
            ], 500);
        }
    }


    /**
     * @param Post $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $post =Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post with id ' . $id . ' not found'
            ], 400);
        }

        if ($post->delete()) {
            return response()->json([
                'success' => true
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post could not be deleted'
            ], 500);
        }
    }
}
