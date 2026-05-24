<x-admin-layout>
	<div class="container-xxl py-5" style="background-color: #ffffff;">

        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                        <h3 class="mb-3">Trashed Post Categories</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(Session::has('error'))
                    <span style="margin-bottom: 20px; color: green;">{{Session::get('error')}}</span>
                @endif
                <div class="table-responsive">
                    @if ((!is_null($data['trashedCategories'])) && (count($data['trashedCategories'] ) > 0))

                        <table class="responsive-table table-striped" cellpadding="10">
                            <thead>
                                <tr style="font-weight: bold;">
                                    <th> SN </th>
                                    <th> Title </th>
                                     <th> Description </th>
                                    <th> Date Created </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                    @php
                                    $count = 0;
                                    @endphp
                                    @foreach($data['trashedCategories'] as $category)
                                        @php
                                        $count++;
                                        @endphp
                                        <tr>
                                            <td data-label="#">{{ $count }}</td>
                                            <td data-label="Title">
                                                <a href="/admin/post/view/{{$category->id}}"> {{$category->title}} </a>
                                            </td>
                                            <td data-label="Description">
                                                @php
                                                    $excerpt = substr($category->description, 0, 50);
                                                    if (strlen($category->description) > 50) {
                                                        $excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . '...';
                                                    }
                                                @endphp
                                            </td>

                                            <td data-label="Date created">
                                                {{ date_format($category->created_at, 'l d M, Y') }}
                                            </td>

                                            <td data-label="">
                                                <a href="/admin/restore/category/{!! $category->id !!}" class="btn btn-success btn-xs">Restored</a>
                                                <a href="/admin/destroy/category/{!! $category->id !!}" class="btn btn-danger btn-xs">Destroy</a>
                                            </td>

                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-md-12">More</div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12">No categories in trash</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                        <h3 class="mb-3">Trashed Post List</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(Session::has('error'))
                    <span style="margin-bottom: 20px; color: green;">{{Session::get('error')}}</span>
                @endif
                <div class="table-responsive">
                    @if ((!is_null($data['trashedPosts'])) && (count($data['trashedPosts'] ) > 0))
                        <table class="responsive-table table-striped" cellpadding="10">
                            <thead>
                                <tr style="font-weight: bold;">
                                    <th> SN </th>
                                    <th> avatar </th>
                                    <th> Owner </th>
                                    <th> Title </th>
                                    <th> Content </th>
                                    <th> Date Created </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach($data['trashedPosts'] as $post)
                                    @php
                                        $count++;
                                    @endphp
                                    <tr>
                                        <td data-label="#">{{ $count }}</td>
                                        <td data-label="Avatar">
                                            <img src="{{url($post->picture)}}" style="width: 75px; height: auto;">
                                        </td>
                                        <td data-label="Owner">
                                            {{ $post->user->name }}
                                        </td>
                                        <td data-label="Title">
                                            <a href="/admin/post/view/{{$post->id}}"> {{$post->title}} </a>
                                        </td>
                                        <td data-label="Content">
                                            @php
                                                $excerpt = substr($post->content, 0, 50);
                                                if (strlen($post->content) > 50) {
                                                    $excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . '...';
                                                }
                                            @endphp
                                        </td>

                                        <td data-label="Date created">
                                            {{ date_format($post->created_at, 'l d M, Y') }}
                                        </td>

                                        <td data-label="">
                                            <a href="/admin/restore/post/{!! $post->id !!}" class="btn btn-success btn-xs">Restored</a>
                                            <a href="/admin/destroy/post/{!! $post->id !!}" class="btn btn-danger btn-xs">Destroy</a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-md-12">More</div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12">No post in trash</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>


         <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                        <h3 class="mb-3">Trashed User List</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(Session::has('error'))
                    <span style="margin-bottom: 20px; color: green;">{{Session::get('error')}}</span>
                @endif
                <div class="table-responsive">
                    @if ((!is_null($data['trashedUsers'])) && (count($data['trashedUsers'] ) > 0))
                        <table class="responsive-table table-striped" cellpadding="10">
                            <thead>
                                <tr style="font-weight: bold;">
                                    <th> SN </th>
                                    <th> Name </th>
                                    <th> User Type </th>
                                    <th> Email</th>
                                    <th> Date Registered </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach($data['trashedUsers'] as $user)
                                    @php
                                        $count++;
                                    @endphp
                                    <tr>
                                        <td data-label="#">{{ $count }}</td>
                                        <td data-label="Name">  <a href="/admin/user/view/{{$user->id}}"> {{$user->name}} </a></td>
                                        <td data-label="User Type">
                                            {{ $user->user_type }}
                                        </td>
                                        <td data-label="Email">
                                            {{ $user->email }}
                                        </td>
                                        <td data-label="Date Registered">
                                            {{ $user->created_at  }}
                                        </td>

                                        <td data-label="">
                                            <a href="/admin/restore/user/{!! $user->id !!}" class="btn btn-success btn-xs">Restored</a>
                                            <a href="/admin/destroy/user/{!! $user->id !!}" class="btn btn-danger btn-xs">Destroy</a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-md-12">More</div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12">No users in trash</div>
                        </div>
                    @endif


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
