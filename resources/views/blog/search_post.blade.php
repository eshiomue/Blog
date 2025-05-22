<x-main-layout>
 <div class="container" style="margin-top:30px">
 	<form method="POST" action="/post/search">
 		@csrf
 		<div class="row">
 			<h4>Search</h4>
 			<input type="text" class="form-control" name="search" id="search" placeholder="">
		    <label for="search" style="margin-top:30px"></label>
 			<input class="btn btn-primary" type="submit" value="search">
 		</div>
 	</form>

 </div>

 @if(isset($blogs))
 	<div class="container" style="margin-top:30px">
 		<h2>Search result - {{$search}}</h2>
 		@foreach($blogs as $blog)
 			<div class="row" style="margin-bottom:20px">
 				<div class="col-md-4"> <a href="/post/view/{{$blog->id}}"> {{$blog->title}}</a></div>
 				<div class="col-md-8">{{$blog->content}}</div>

 			</div>
 		@endforeach
 	</div>

 @endif




</x-main-layout>