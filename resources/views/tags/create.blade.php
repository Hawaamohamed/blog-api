@extends('layouts.app')   
    
@section('content')
   
   

<a href="{{ route('tags') }}" class='btn btn-success pull-right'>All Tags</a>
 
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
               <h3> create tag</h3>
            </div>
 
        <form method="post" action="{{ route('tag.store') }}" enctype="multipart/form-data">
                    
            {{ csrf_field() }}  @method('POST')
 

            <div class="form-group">
               <input class="form-control" type="text" name="tag" placeholder="tag">
            </div>
 
            <div class="form-group">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
    
          </form>
        </div>
    </div>
    
 </div>

@endsection