<x-admin-layout>
	<div class="container-xxl py-5" style="background-color: #ffffff;">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                        <h1 class="mb-3">
                            Posts
                            <a href="{{ url('/post/add-post') }}"><i class="fa fa-plus"></i></a>
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
                                <th> Content </th>
                                <th> Posted by</th>
                                <th> Category </th>
                                <th> Photo</th>
                                <th>Comments</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $item)
                                <tr>
                                    <td data-label="#">{{ ($blogs->currentPage() - 1) * $blogs->perPage() + $loop->iteration }}</td>
                                    <td data-label="Title">  <a href="/post/view/{{$item->id}}"> {{$item->title}} </a></td>
                                    <td data-label="Content">
                                        @php
                                            $excerpt = substr($item->content, 0, 80);
                                            if (strlen($item->content) > 80) {
                                                $excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . '...';
                                            }
                                        @endphp
                                        <p> {!!  \Illuminate\Support\Str::limit($excerpt, 80, '...') !!} </p>
                                    </td>
                                    <td data-label="Posted By">
                                        {{ $item->user != null ? $item->user->name : "-" }}
                                    </td>
                                    <td data-label="Category">
                                        {{ $item->category != null ? $item->category->title : ""  }}
                                    </td>
                                    <td data-label="Avatar">
                                        <img src=" {!! '/' . $item->picture !!}" width="50" height="50">
                                    </td>
                                    <td data-label="Comments">
                                        {{ $item->comments != null ? count($item->comments) : 0 }}
                                    </td>
                                    <td data-label="">
                                        <a href="/post/view/{!! $item->id !!}" class="btn btn-primary btn-sm">View</a>
                                        <a href="/post/edit/{!! $item->id !!}" class="btn btn-warning btn-sm">Edit</a>
                                        <a class="btn btn-danger btn-sm" onClick ="askDeleteQuestion( {!! $item->id!!})">Delete</a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-12">{{ $blogs->links() }}</div>
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
