@extends('layouts.app')   
    
@section('content')
   
   <div class="container">
    <div class="row">
     <div class="col-12">
        <a href="{{ route('user.create') }}" class='btn btn-success pull-right'>Create user</a>
         
        <h1>All users</h1> 
        @if($users->count() > 0)
          <table class="table table-responsive  table-bordered">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Email</td> 
                    <th>ٌReview data</th>
                    <th>Date</th> 
                    <td>Actions</td>
                <tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach($users as $user) 
                   @php
                       if($user->review == 1){ $review = 'Yes'; }else{$review = 'No';}
                   @endphp
                    <tr><td>{{ $i++ }} </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $review }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                           
                           @if (Auth::user()->admin == 1)   
                             <a href="{{ route('user.destroy', $user->id) }}" class='btn btn-danger'>Delete</a> 
                         
                            @if($user->review == 0) 
                             
                             <a href="{{ route('user.active', $user->id) }}" class='btn btn-success'>Active</a> 
                            @else
                             <a href="{{ route('user.disactive', $user->id) }}" class='btn btn-primary'>Disactive</a> 
                            @endif
                          @endif
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
          </table>
        @else
           <div class="alert alert-info">No users Exist Yet</div>
        @endif
   
        
     </div>
    </div>
   </div>
   
   
@endsection