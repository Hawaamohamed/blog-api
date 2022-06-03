<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use App\Comment;
use Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
   }


    
    public function index()
    {
        $categorys = Category::where('user_id', Auth::id())->latest()->paginate();
        return view('category.index')->with('categorys', $categorys);
    }
 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $categorys = Category::all();
         
        return view('category.create')->with('categorys', $categorys);
       
    }

     
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required', 
            'image' => 'required|image',
          
        ]);

        $image = $request->image;
        $newimage = time().$image->getClientOriginalName();
        $image->move('uploads/categorys', $newimage);

        $category = Category::create([

            'name' => $request->name,
            'status' => $request->status,
            'image' => $newimage,
            'slug' => str_slug($request->name),
            'user_id' => Auth::id(),

        ]); 
        
        return redirect()->back();

    }

     
      
    public function edit($id)
    {
        $category = Category::where('id', $id)->get(); 
        if($category === null)
        {
            return redirect()->back();
        }
         
        return view('category.edit')->with('category', $category);
        
    }

    
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required', 
           
        ]);
 //dd($request->all());
        if($request->has('image')){
            $image = $request->image;
            $newimage = time().$image->getClientOriginalName();
            $image->move('uploads/categorys', $newimage);
            $category->image = $newimage;
        }
        $category->name = $request->name;
        $category->status = $request->status;

        
        $category->save();
        
        return redirect()->back();
        
    }

     
    public function destroy($id)
    {
        $category = Category::where('id', $id)->where('user_id', Auth::id());
        $category->delete();
        return redirect()->back();
         
    }
     
    
}
