<x-main-layout>
 <div class="container" style="margin-top:30px">
 	<form action="{{url('/post/search')}}" method="post">
 		@csrf
 		<div class="row">
 			 <div class="col-md-6">
                <h4>Search</h4>
                    <input type="text" class="form-control" name="search" id="search" placeholder="">
                    <label for="search" style="margin-top:30px"></label>
                    <input class="btn btn-primary" type="submit" value="search">
                </form>
            </div>
 		</div>
 	</form>
 </div>

 @if(isset($blogs))
 	<div class="container" style="margin-top:30px">
 		<h2>Search result - {{$search}}</h2>
 		@foreach($blogs as $blog)
 			<div class="row" style="margin-bottom:20px">
 				<div class="col-md-4">
                    <a href="/post/view/{{$blog->id}}?search={{$search}}">
                        {!! str_ireplace($search, "<mark>$search</mark>", $blog->title) !!}
                    </a>
                </div>
 				<div class="col-md-8">
                    @php
                        $lowerText = mb_strtolower($blog->content);
                        $lowerKeyword = mb_strtolower($search);
                        $position = mb_stripos($lowerText, $search);
                        $excerpt = substr($lowerText, $position, 300);
                        if (strlen($lowerText) > 300) {
                            $excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . '...';
                        }
                    @endphp
                    ...{!! str_ireplace($search, "<mark>$search</mark>", $excerpt) !!}...
                </div>
 			</div>
 		@endforeach
 	</div>

 @endif
</x-main-layout>
