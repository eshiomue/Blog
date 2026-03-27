<x-main-layout>
	<div class="container">
		<div class="row" style="margin-top: 50px">
			<h1>{{$post->title}}</h1>
			@if($post->picture != '')
				<img src="{{asset($post->picture)}}" style="height:300px; width: 200px;">
			@endif
			<p>{{$post->content}}</p>	

			<span style="font-weight:bold; font-style: italic;"> Created by: 
			<?php
			$user = App\Models\User::where('id', $post->posted_by)->first();
			echo($user->name);
			?>		
			</span> 

			<span style="font-weight:bold; font-style: italic;">
				{{$post->created_at->diffForHumans()}}
			</span>

		</div>

		<?php $comments = $post->comment ?>
		@foreach($comments as $reply)
			<div class="row" style="border:1px; margin-top: 20px;">
				<h4>Re:{{$post->title}}</h4>
				<p>
					<b>{{$reply->user->name}}</b>:- {{$reply->comment}}
					<br>
					
				</p>
			</div>
		@endforeach
	
		<div class="comment-section" style="margin-top: 50px">
        <h6>Leave a Comment</h6>
			<form action="/posts/comments" method="post">
				@csrf
				<input type="hidden" name="id" value="{{$post->id}}">
			    <textarea name="comment" rows="5" cols="40" placeholder="Write something..." required></textarea><br><br>
			    <input class="btn btn-primary" type="submit" value="Post Comment">
		    </form>

        </div>
			
	</div>
</x-main-layout>
