<x-main-layout>

	<div class="container" style="margin-top: 15px;">
        <div class="row">
            <div class="col-md-6">
                <h4>Blog Categories</h4>
            </div>
            <div class="col-md-6" style="text-align: right;">
                <a href="{{ url('admin/category/add') }}" class="btn btn-success btn-sm">Create Category</a>
            </div>
        </div>
        @if((is_null($categories)) || (count($categories) == 0))
            <div class="row" style="margin-top:10px; text-align: center;">
                <p>No categories found</p>
            </div>
        @else

            <div class="row">
                @foreach($categories as $item)
                    <div class="col-md-3 blog-category">
                        <a href="/category/<?php echo($item->id);?>/blogs">
                            {{$item->title}} - {{$item->blogs_count }} {{ $item->blogs_count > 1 ? 'posts' : 'post' }}
                        </a>
                        <p>{{ $item->description }}</p>
                    </div>
                @endforeach
            </div>
        @endif
	</div>

	<script type="text/javascript">

		function askDeleteQuestion(id){
			console.log(id);
			var answer = confirm('Are you sure you want to delete?');
			console.log(answer);
			if(answer==true){
				window.location = '/category/delete/' + id;
			}
		}
	</script>

</x-main-layout>
