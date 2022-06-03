@extends('layouts.app')   
    
@section('content')
   
   

 
@if(count($errors->all())>0)
<div class="alert alert-danger">
 <ul>
   @foreach($errors->all() as $e)
     <li>{{$e}}</li>
   @endforeach
 </ul>
</div>
@endif
 

@if(Session()->get('success')) 
<div class='alert alert-success'> {{$message}} </div>
@endif
 


 <div class="container">

    <div class="row">
        <div class="offset-md-3 col-6">
 
            <div class="title">
               <h3> profile data </h3>
            </div>
 
<form method="post" action="{{ route('profile.update') }}">
             
     {{ csrf_field() }}  @method('PUT')

     <div class="form-group">
        <input class="form-control" type="text" name="name" placeholder="name" value="{{$user->name}}">
     </div>

     <div class="form-group">
        <input class="form-control" type="password" name="password" placeholder="password">
     </div>

     <div class="form-group">
        <input class="form-control" type="password" name="confirm_password" placeholder="confirm password">
     </div>
            <div class="form-group">
               <select name="gender" class="form-control">
                   <option value="">Gender</option>
                   <option value="Male" {{ ($user->profile->gender == "Male") ? 'selected':'' }}>Male</option>
                   <option value="Female" {{ ($user->profile->gender == "Female") ? 'selected':'' }}>Female</option>
               </select>
            </div>

            <div class="form-group">
               <input class="form-control" type="text" name="facebook" placeholder="Facebook" value="{{ $user->profile->facebook }}">
            </div>

            <div class="form-group">
                <textarea class="form-control" name='bio' placeholder="Bio">{!! $user->profile->bio !!}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>
    </div>
    
 </div>

@endsection