@extends('layouts.app')   
    
@section('content')
   
   <div class="container">
    <div class="row">
     <div class="col-12">
        <a href="{{ route('posts.create') }}" class='btn btn-success pull-right'>Create Post</a>
        <a href="{{ route('posts.trashed') }}" class='btn btn-danger'>Trashed</a>
        <h1>All Posts</h1>
        @if($posts->count() > 0)
          <table class="table table-responsive  table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>User</th><th>Date</th>
                    <th>Actions</th> 
                <tr>
            </thead>
            <tbody>
                @php
                    $i = 1; 
                @endphp
                @foreach($posts as $post) 
                   
                    <tr><td>{{ $i++ }} </td>
                        <td>{{ $post->title }}</td> 
                        <td>{{ $post->content }}</td>
                        <td>{{ $post->status }}</td>
                        <td><img src="{{ URL::asset('uploads/posts/'. $post->image) }}" alt="{{$post->title}}" with="100" height="100" class=""></td>
                        <td>{{ $post->user->name }}</td><td>{{ $post->created_at }}</td>
                        <td>
                           <a href="{{ route('post.show', $post->slug) }}" class='btn btn-success'>Show</a>
                           @if ($post->user_id == Auth::id())
                            
                            <a href="{{ route('post.edit', $post->id) }}" class='btn btn-primary'>Edit</a>
                            <a href="{{ route('post.destroy', $post->id) }}" class='btn btn-danger'>Delete</a>
                        
                            @endif
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
          </table> {!! $posts->render() !!}
        @else
           <div class="alert alert-info">No Posts Exist Yet</div>
        @endif
   
        
     </div>
    </div>
   </div>
   
   
@endsection