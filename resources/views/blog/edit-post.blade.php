<x-main-layout>
	<div class="container" style="margin-top: 50px;">
		@if(Session::has('message'))
			<span style="margin-bottom: 20px; color: green;">{{Session::get('message')}}</span>
		@endif
		<form method="POST" action="/post/save">
			@csrf
		    <div class="row g-3">
		        <div class="col-md-6">
		            <div class="form-floating">
		            	<input type="hidden"  name="id" value="{{$blog->id}}">
		                <input type="text"  name="title" value="{{$blog->title}}">
		                <!-- <label for="title">Title</label> -->
		            </div>
		        </div>
		        <div class="col-12">
		            <div class="form-floating">
		                <textarea class="form-control"  id="content" name="content" style="height: 150px">{{$blog->content}}</textarea>
		                <!-- <label for="description">Content</label> -->
		            </div>
		        </div>
		        <div class="col-12">
		            <div class="form-floating">
		                <select class="form-control" id="category_id" name="category_id">
		                	<option value="">Choose One</option>
		                	@foreach($blogCategories as $item)
		                		@if($item->id == $blog->category_id)
		                			<option value="{{ $item->id }}" selected>{{ $item->title }}</option>
		                		@else
									<option value="{{ $item->id }}">{{ $item->title }}</option>
		                		@endif
		                	@endforeach
		                </select>
		                <label for="category_id">Category</label>
		            </div>
		        </div>
		        <div class="col-12" style="margin-top :50px">
		            <button class="btn btn-primary w-100 py-3" type="submit">Update post</button>
		        </div>
		    </div>
		</form>
	</div>


</x-main-layout>
