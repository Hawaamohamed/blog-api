<?php

namespace App\Http\Controllers\API;
 
use Illuminate\Http\Request;
use App\post;
use Validator;
use App\Http\Resources\postResource as postResource;
use App\Http\Controllers\API\baseController as baseController;
use Auth;

class postController extends baseController
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
       $posts = Post::all();
       return $this->sendResponse(postResource::collection($posts), 'All Posts send');
    }
    public function userPosts($id)
    {
       $posts = Post::where('user_id',$id)->get();
       return $this->sendResponse(postResource::collection($posts), 'All Posts send');
    }

      
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required', 
        ]);
        
        if($validator->fails()){
            return $this->sendError('Please validate error', $validator->errors());
        }   
        $user = Auth::user();
        $input['user_id'] = $user->id;
        $input['slug'] = $input['title'];
        $post = Post::create($input);

        return $this->sendResponse(new postResource($post), 'post created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if( is_null($post))
        {
            return $this->sendError('post not found');
        }
        
        return $this->sendResponse(new postResource($post), 'post Found successfully');

    }

     
    public function update(Request $request, Post $post)
    {
        
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required', 
        ]);
        
        if($validator->fails()){
            return $this->sendError('Please validate error', $validator->errors());
        }
        if($post->user_id != Auth::id)
        {
            return $this->sendError("You don't have permission for delete this post", $validator->errors());
        }
        $post->title = $request->title;
        $post->content = $request->content; 
        $post->slug = $request->title;
        $post->save();
        return $this->sendResponse(new postResource($post), 'post Updated successfully');

    }

     
    public function destroy(Post $post)
    {
        $errorMessage = [];

        if($post->user_id != Auth::id)
        {
            return $this->sendError("You don't have permission to delete this post", $errorMessage);
        }

        $post->delete();
        return $this->sendResponse(new postResource($post), 'post Deleted successfully');

    }
}
