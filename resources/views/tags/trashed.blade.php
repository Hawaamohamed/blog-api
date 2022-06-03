@extends('layouts.app')   
    
@section('content')
   
   <div class="container">
    <div class="row">
     <div class="col-12">
        <a href="{{ route('tags') }}" class='btn btn-success pull-right'>All Posts</a> 
        <h1>All Trashed Posts</h1>
        @if($tags->count() > 0)
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
                @foreach($tags as $tag) 
                   
                    <tr><td>{{ $i++ }} </td>
                        <td>{{ $tag->title }}</td>
                        <td>{{ $tag->content }}</td>
                        <td><img src="{{ URL::asset('uploads/tags/'. $tag->image) }}" alt="{{$tag->title}}" with="100" height="100" class=""></td>
                        <td>{{ $tag->user->name }}</td><td>{{ $tag->created_at }}</td>
                        <td>
                            
                            <a href="{{ route('tag.restore', $tag->id) }}" class='btn btn-primary'>Restore</a>
                            <a href="{{ route('tag.hard_delete', $tag->id) }}" class='btn btn-danger'>Delete</a>
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