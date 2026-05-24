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

                                        <button class="btn btn-danger btn-sm delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#confirmModal"
                                            data-id="{{$item->id}}">
                                            Delete
                                        </button>
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


    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    You are about to delete this post ?
                    <input type="hidden" id="deletePostWithId">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="button" class="btn btn-primary delete-post">
                        Delete
                    </button>
                </div>

            </div>
        </div>
    </div>


	<script type="text/javascript">

		document.querySelectorAll('.delete').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const id = this.dataset.id;
                console.log('delete post with id ' + id);
                const btn = $('#delete-' + id);
                $('#deletePostWithId').val(id);
                if (btn.prop('disabled')) return;
                btn.prop('disabled', true);
            });
        });

        document.querySelectorAll('.delete-post').forEach(btn => {
            btn.addEventListener('click', function (e) {
                const btn = $(this);
                if (btn.prop('disabled')) return;
                btn.prop('disabled', true);
                const id = $('#deletePostWithId').val();
                console.log('Delete post with id ' + id);
                $.ajax({
                    type: 'GET',
                    url: '/post/delete-ajax/'+id,
                    success: function (data) {
                        console.log(data);
                        if(data.isSuccess) window.location.reload();
                    }
                });
                $('#confirmModal').modal('hide');
            })
        });

	</script>

</x-admin-layout>
