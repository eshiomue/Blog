<x-main-layout>
	<div class="container" style="margin-top: 50px;">
		@if(Session::has('message'))
			<span style="margin-bottom: 20px; color: green;">{{Session::get('message')}}</span>
		@endif
		<form method="POST" action="/post/save" enctype="multipart/form-data">
			@csrf
		    <div class="row">
		        <div class="col-md-6">
		            <div class="form-floating">
		                <input type="text" class="form-control" id="title" name="title" placeholder="Your Name">
		                <label for="title">Title</label>
		            </div>
		        </div>
		        <div class="row" style="margin-top: 20px;">
		            <div class="form-floating">
		                <textarea class="form-control" placeholder="Enter Content" id="content" name="content" style="height: 150px"></textarea>
		                <label for="description">Content</label>
		            </div>
		        </div>
		        <div class="row" style="margin-top: 20px;">
		            <div class="form-floating">
		                <select class="form-control" id="category_id" name="category_id">
		                	<option value="">Choose One</option>
		                	@foreach($blogCategories as $item)
		                		<option value="{{ $item->id }}">{{ $item->title }}</option>
		                	@endforeach
		                </select>
		                <label for="category_id">Category</label>
		            </div>
		        </div>

		        <div class="row" style="margin-top :20px">
		           <input type="file" name="picture">
		        </div>
		        <div class="row" style="margin-top :50px">
		            <button class="btn btn-primary w-100 py-3" type="submit">Save post</button>
		        </div>
		    </div>
		</form>
	</div>


</x-main-layout>