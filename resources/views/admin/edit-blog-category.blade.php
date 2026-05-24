<x-admin-layout>
	<div class="container" style="margin-top: 50px;">
		@if(Session::has('message'))
			<span style="margin-bottom: 20px; color: green;">{{Session::get('message')}}</span>
		@endif
		<form method="POST" action="/admin/category/update">
			@csrf
		    <div class="row g-3">
		        <div class="col-md-6">
		            <div class="form-floating">
		            	<input type="hidden" name="recId" value="{{$blogCategory->id}}">
		                <input type="text" class="form-control" id="title" name="title" value="{{$blogCategory->title}}">
		                <label for="title">Title</label>
		            </div>
		        </div>
		        <div class="col-12">
		            <div class="form-floating">
		                <textarea class="form-control" placeholder="Enter Description" id="description" name="description" style="height: 150px">{{$blogCategory->description}}</textarea>
		                <label for="description">Description</label>
		            </div>
		        </div>
		        <div class="col-12">
		            <button class="btn btn-primary w-100 py-3" type="submit">Save category</button>
		        </div>
		    </div>
		</form>
	</div>


</x-admin-layout>
