@extends('layouts.app')   
    
@section('content')
   
   <div class="container">
    <div class="row">
     <div class="col-12">
         
        <h1>User Posts</h1>
        @if($user_posts->count() > 0)
          <table class="table table-responsive table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>User</th><th>Date</th> 
                <tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach($user_posts as $post) 
                   
                    <tr><td>{{ $i++ }} </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td><img src="{{ URL::asset('uploads/posts/'. $post->image) }}" alt="{{$post->title}}" with="100" height="100" class=""></td>
                        <td>{{ $post->user->name }}</td><td>{{ $post->created_at }}</td>
                         
                    </tr>
                    
                @endforeach
            </tbody>
          </table>
        @else
           <div class="alert alert-info">No Posts Exist Yet</div>
        @endif
   
        
     </div>
    </div>
   </div>
   
   
@endsection