<x-admin-layout>
	<div class="container-xxl py-5" style="background-color: #ffffff;">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                        <h1 class="mb-3">
                            Pending Posts
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
                                <th>Date</th>
                                <th>Status</th>
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
                                    <td data-label="Date">
                                        {{ $item->created_at }}
                                    </td>
                                    <td data-label="">
                                        <select class='change-status' data-id="{{$item->id}}" autocomplete="off">
                                            <option value="pending" {{ $item->status == 'pending' ? 'selected' : ''}}>Pending</option>
                                            <option value="active" {{ $item->status == 'active' ? 'selected' : ''}}>Approve</option>
                                            <option value="rejected" {{ $item->status == 'rejected' ? 'selected' : ''}}>Reject</option>
                                        </select>
                                        <span id="changeStatus{{$item->id}}"></span>
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

		document.querySelectorAll('.change-status').forEach(item => {
            item.addEventListener('change', function (e) {
                e.preventDefault();
                const id = this.dataset.id;
                const state = this.value;
                console.log('Update status of post with id ' + id + ' to ' + state);
                const btn = $('#delete-' + id);
                $('#changeStatus' + id).html('Please wait');

                var fd = new FormData();
                fd.append('status', state);
                fd.append('postId', id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/admin/post/change-status',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        console.log(JSON.stringify(response));
                        $('#changeStatus' + id).html(response.message);
                    },
                    error:function(error){
                        console.log(error);
                        $('#changeStatus' + id).html(error.message);
                    }
                });



                $.ajax({
                    type: 'GET',
                    url: 'admin/post/change-status/'+id,
                    success: function (data) {
                        console.log(data);
                        if(data.isSuccess) window.location.reload();
                    }
                });
            });
        });

	</script>

</x-admin-layout>
