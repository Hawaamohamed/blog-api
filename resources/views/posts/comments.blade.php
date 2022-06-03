 
  
        @if ($comments->count() > 0)  
            
            @foreach ($comments as $comment)
                <div class="col-sm-12">
                    <div @if($comment->parent_id != null) style='margin-left: 60px;' @endif>
                        <strong>{{ $comment->user->name}}</strong>
                        <p>{{ $comment->content }}</p>
                        <form method="post" action="{{route('comments.store')}}">
                            @csrf
                            <input type="text" name="content" placeholder="Content">
                            <input type="hidden" name="post_id" value="{{$post_id}}">
                            <input type="hidden" name="parent_id" value="{{$comment->id}}">
                            <button type="submit" class="btn btn-success">Reply</button>
                        </form>
                        @include('posts.comments', ['comments'=>$comment->replies])
                    </div>
                </div>
                
            @endforeach
          
        @else
            <h4>No comments exist</h4>
        @endif
        
  </div>

</div>
 