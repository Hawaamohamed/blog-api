@extends('layouts.app')   
    
@section('content')
   
   

<a href="{{ route('category') }}" class='btn btn-success pull-right'>All category</a>
 
@if(count($errors->all())>0)
<div class="alert alert-danger">
 <ul>
   @foreach($errors->all() as $e)
     <li>{{$e}}</li>
   @endforeach
 </ul>
</div>
@endif
 

@if($message = Session()->get('success')) 
<div class='alert alert-success'> {{$message}} </div>
@endif
 


 <div class="container">

    <div class="row">
        <div class="offset-md-3 col-6">
 
            <div class="title">
               <h3> Edit category</h3>
            </div>
  
  
  
  
  
  
  
  
  
        <form method="post" action="{{ route('category.update', $category[0]->id) }}" enctype="multipart/form-data">
                    
            {{ csrf_field() }}  @method('POST')
 

            <div class="form-group">
               <input class="form-control" type="text" name="name" placeholder="name" value="{{ $category[0]->name }}">
            </div>
 

            <div class="form-group">
              <input class="form-control" type="text" name="status" placeholder="name" value="{{ $category[0]->status }}">
           </div>

 
            <div class="form-group">
               <input class="form-control" type="file" name="image" placeholder="image">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
    
        </form>
      </div>
    </div>
    
 </div>

@endsection