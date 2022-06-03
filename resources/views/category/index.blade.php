@extends('layouts.app')   
    
@section('content')
   
   <div class="container">
    <div class="row">
     <div class="col-12">
        <a href="{{ route('category.create') }}" class='btn btn-success pull-right'>Create category</a>  
        <h1>All Category</h1>
        @if($categorys->count() > 0)
          <table class="table table-responsive table-bordered">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Status</td>
                    <td>Image</td>
                    <td>User</td><th>Date</th>
                    <td>Actions</td>
                <tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach($categorys as $category) 
                   
                    <tr><td>{{ $i++ }} </td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->status }}</td>
                        <td><img src="{{ URL::asset('uploads/categorys/'. $category->image) }}" alt="{{$category->name}}" with="100" height="100" class=""></td>
                        <td>{{ $category->user->name }}</td><td>{{ $category->created_at }}</td>
                        <td> 
                            <a href="{{ route('category.edit', $category->id) }}" class='btn btn-primary'>Edit</a>
                            <a href="{{ route('category.destroy', $category->id) }}" class='btn btn-danger'>Delete</a>
                         
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
          </table>
        @else
           <div class="alert alert-info">No categorys Exist Yet</div>
        @endif
   
        
     </div>
    </div>
   </div>
   
   
@endsection