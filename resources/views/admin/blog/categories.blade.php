<x-admin-layout>
	<div class="container-xxl py-5" style="background-color: #ffffff;">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                        <h1 class="mb-3">
                            Blog Categories
                            <a href="{{ url('/admin/category/add') }}"><i class="fa fa-plus"></i></a>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(Session::has('error'))
                    <span style="margin-bottom: 20px; color: green;">{{Session::get('error')}}</span>
                @endif
                <div class="table-responsive">
                    <table class="responsive-table table-striped" cellpadding="10">
                        <thead>
                            <tr style="font-weight: bold;">
                                <th> SN </th>
                                <th> Title </th>
                                <th> Description </th>
                                <th> Date Created</th>
                                <th> Posts </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $item)
                                <tr>
                                    <td data-label="#">{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                                    <td data-label="Title">  <a href="/category/blogs/{{$item->id}}"> {{$item->title}} </a></td>
                                    <td data-label="Description">
                                        @php
                                            $excerpt = substr($item->description, 0, 80);
                                            if (strlen($item->description) > 80) {
                                                $excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . '...';
                                            }
                                        @endphp
                                        <p><?php echo(\Illuminate\Support\Str::limit($excerpt, 80, '...')); ?> </p>
                                    </td>
                                    <td data-label="Date Created">
                                        {{ $item->created_at }}
                                    </td>
                                    <td data-label="Posts">
                                        <a href="{{ url('/category/' . $item->id . '/blogs') }}">
                                            <span class="badge bg-warning">{{ count($item->blogs)  }}</span>
                                        </a>
                                    </td>

                                    <td data-label="">
                                        <!-- <span>
                                            <a href="/post/view/<?php echo($item->id);?>" class="btn btn-primary btn-xs">View</a>
                                        </span> -->
                                        <span>
                                            <a href="/post/edit/<?php echo($item->id);?>" class="btn btn-warning btn-xs">Edit</a>
                                        </span>
                                        <span>
                                            <a class="btn btn-danger btn-xs" onClick ="askDeleteQuestion(<?php echo($item->id);?>)">Delete</a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-12">{{ $categories->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
	</div>



	<script type="text/javascript">

		function askDeleteQuestion(id){
			console.log(id);
			var answer = confirm('Are you sure you want to delete?');
			console.log(answer);
			if(answer==true){
				window.location = '/post/delete/' + id;
			}
		}
	</script>

</x-admin-layout>
