@extends('layouts.app')

@section('content') <style>body{ background: #3067c9; } </style>
<div class="container">
    <div class="row justify-content-center">
         @if (Auth::user()->admin == 1)
       <div class="col-sm-12">
         <a class="btn btn-success" href="{{ route('profile') }}" style="margin-bottom: 30px">Edit Profile </a>
       </div>
         <div class="col-3">    
         <div class="card">
          <div class="card-header">{{ __('No of users') }}</div>

           <div class="card-body">
               
                 {{ $all_users->count() }}
           </div>
       </div>
      </div>  
        <div class="col-3">    
            <div class="card">
              <div class="card-header">{{ __('No of Categories') }}</div>

              <div class="card-body">
                  
                    {{ $category->count() }}
              </div>
          </div>
        </div>  
       <div class="col-3">   
         <div class="card">
          <div class="card-header">{{ __('No of Posts') }}</div>

           <div class="card-body">
               
                 {{ $posts->count() }}
           </div>
       </div>
             
      </div>
      <div class="col-3">      
       <div class="card">
        <div class="card-header">{{ __('No of Tags') }}</div>

         <div class="card-body">
             
               {{ $tags->count() }}
         </div>
     </div>
          
      </div>       
        <br><br>
      <div class="col-md-12">          
             <h2 style="margin-top: 25px; color: #fff">All Users</h2>  
             <table class="table table-responsive table-bordered" style="background: #fff">
                <thead>
                  <tr>
                    <th>#</th> 
                    <th>Name</th>
                    <th>Email</th>
                    <th>Review Data</th>
                    <th>Created at</th>
                    <th>Posts</th> 
                  </tr>
                </thead>
                <tbody> 
                @php
                $i = 1;
                @endphp
                @foreach($users as $user)   
                   @php
                   if($user->review == 1){ $review = 'Yes'; }else{$review = 'No';}
                   @endphp
                   
                 <tr>
                    <td>{{ $i++ }} </td> 
                    <td>{{ $user->name }}</td> 
                    <td>{{ $user->email }}</td>  
                    <td>{{ $review }}</td>
                    <td>{{ $user->created_at }}</td>  
                    <td> 
                         
                          <a href="{{ route('user_posts', $user->id) }}">  show   </a>
                         
                    </td> 
                 <tr>
                @endforeach
              </tbody>
            </table>
          @else  
            <div class="card">
               <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            
          @endif         
        </div>
    </div>
</div>

@endsection
