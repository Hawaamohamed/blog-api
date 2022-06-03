<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Comment;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
   }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        if(Auth::user()->admin == 1)
        {

            $posts = Post::paginate(10);
        }else{

            $posts = Post::where('user_id', Auth::id())->latest()->paginate(10);
        }
         
        return view('posts.index')->with('posts', $posts);
    }

    public function postsTrashed()
    {
       
        $posts = Post::onlyTrashed()->where('user_id', Auth::id())->latest()->paginate();
        return view('posts.trashed')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $tags = Tag::all();
        if($tags->count() == 0){
          return view('tags.create');
        }else{ 
          return view('posts.create')->with('tags', $tags);
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'tags' => 'required',
            'image' => 'required|image',
          
        ]);

        $image = $request->image;
        $newimage = time().$image->getClientOriginalName();
        $image->move('uploads/posts', $newimage);

         
        if(Auth::user()->admin == 0 && Auth::user()->review = 0)
        {
            $status = "pending";
        }else{ $status = "active"; }

        $post = Post::create([

            'title' => $request->title,
            'content' => $request->content,
            'image' => $newimage,
            'slug' => str_slug($request->title),
            'user_id' => Auth::id(),
            'status' => $status,
        ]); 
        $post->tag()->attach($request->tags);

        if(Auth::user()->admin == 0 && Auth::user()->review = 0)
        {
                $token = "fSoLS71_Zk8:APA91bHBHLx6QyZIyd7BDt_vuhVTIhozKc_hckqEfxvlejJmewE8byUGwSEWska5UGe_pCqVvcjRDgy0Czm-76pXAAR-jvyqSy8I5LtCeRipTFeqh8oD5lWmNn61ywGpR4mU43ITleze";  
                $from = "AAAACqW2UT8:APA91bFxX1IRKMLr0vnuB52m6dvVqHfYVppPt7XpM4vxMxFcaW5NSiwhDgEKsgyv-_YUPjnMIVW3eRAe56IHVT_4MKI6cJ-gL1SY8bilUukU8_5PyrzAR3HRtcHdySPWmsvZAmtPHK_D";
                $msg = array
                    (
                        'body'  => "there is a new post Pending from " . Auth::user()->name,
                        'title' => "Hi",
                        'receiver' => Auth::user()->name,
                        'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                        'sound' => 'mySound'/*Default sound*/
                    );

                $fields = array
                        (
                            'to'        => $token,
                            'notification'  => $msg
                        );

                $headers = array
                        (
                            'Authorization: key=' . $from,
                            'Content-Type: application/json'
                        );
                //#Send Reponse To FireBase Server 
                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                $result = curl_exec($ch );
            // dd($result);
                curl_close( $ch );
         
         }

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      if(Auth::user()->admin == 1) {
        $post = Post::where('slug', $slug)->first();
      }else{
        $post = Post::where('slug', $slug)->where('user_id', Auth::id())->first();
      }
        $tags = Tag::all();
        if($post === null)
        {
             return redirect()->back();
        }
  
        $comments = Comment::where('post_id', $post->id)->get();

    
         return view('posts.show')->with('post', $post)->with('tags', $tags)->with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id()); 
        if($post === null)
        {
            return redirect()->back();
        }

        $tags = Tag::all();
        return view('posts.edit')->with('post', $post)->with('tags', $tags);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required', 
          
        ]);
 //dd($request->all());
        if($request->has('image')){
            $image = $request->image;
            $newimage = time().$image->getClientOriginalName();
            $image->move('uploads/posts', $newimage);
            $post->image = $newimage;
        }
        $post->title = $request->title;
        $post->content = $request->content;

        $post->tag()->sync($request->tags); //sync check if the tags checked are the same or changed and updated it
        $post->save();
        
        return redirect()->back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id);
        $post->delete();
        return redirect()->back();
         
    }
    public function hard_delete($id)
    {
        
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->forceDelete();
        return redirect()->back();
    }
    public function restore($id)
    {
        
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();
        return redirect()->back();
          
    }
}
