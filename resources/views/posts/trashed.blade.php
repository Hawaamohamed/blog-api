@extends('layouts.app')   
    
@section('content')
   
   <div class="container">
    <div class="row">
     <div class="col-12">
        <a href="{{ route('posts') }}" class='btn btn-success pull-right'>All Posts</a> 
        <h1>All Trashed Posts</h1>
        @if($posts->count() > 0)
          <table>
            <thead>
                <tr>
                    <td>#</td>
                    <td>Title</td>
                    <td>Content</td>
                    <td>Image</td>
                    <td>User</td><th>Date</th>
                    <td>Actions</td>
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
                        <td><img src="{{ URL::asset('uploads/posts/'. $post->image) }}" alt="{{$post->title}}" with="100" height="100" class=""></td>
                        <td>{{ $post->user->name }}</td><td>{{ $post->created_at }}</td>
                        <td>
                            
                            <a href="{{ route('post.restore', $post->id) }}" class='btn btn-primary'>Restore</a>
                            <a href="{{ route('post.hard_delete', $post->id) }}" class='btn btn-danger'>Delete</a>
                        </td>
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