@extends('layouts.app')   
    
@section('content')
   
   <div class="container">
    <div class="row">
     <div class="col-12">
        <a href="{{ route('tag.create') }}" class='btn btn-success pull-right'>Create Tag</a> 
        <h1>All Tags</h1>
        @if($tags->count() > 0)
          <table>
            <thead>
                <tr>
                    <td>#</td>
                    <td>Tag</td> 
                    <th>Date</th>
                    <td>Actions</td>
                <tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach($tags as $tag) 
                   
                    <tr><td>{{ $i++ }} </td>
                        <td>{{ $tag->tag }}</td>
                        <td>{{ $tag->created_at }}</td>
                        <td> 
                            <a href="{{ route('tag.edit', $tag->id) }}" class='btn btn-primary'>Edit</a>
                            <a href="{{ route('tag.destroy', $tag->id) }}" class='btn btn-danger'>Delete</a>
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
          </table>
        @else
           <div class="alert alert-info">No Tags Exist Yet</div>
        @endif
   
        
     </div>
    </div>
   </div>
   
   
@endsection