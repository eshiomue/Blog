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
                                        <p> {!! \Illuminate\Support\Str::limit($excerpt, 80, '...') !!} </p>
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
                                        <span>
                                            <a href="/admin/category/edit/{!! $item->id!!}" class="btn btn-warning btn-xs">Edit</a>
                                        </span>
                                        <span>
                                            <button class="btn btn-danger btn-sm delete"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmModal"
                                                data-id="{{$item->id}}">
                                                Delete
                                            </button>
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


    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    You are about to delete this category ?
                    <input type="hidden" id="deleteCategoryWithId">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="button" class="btn btn-primary delete-category">
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
                console.log('delete category with id ' + id);
                const btn = $('#delete-' + id);
                $('#deleteCategoryWithId').val(id);
                if (btn.prop('disabled')) return;
                btn.prop('disabled', true);
            });
        });

        document.querySelectorAll('.delete-category').forEach(btn => {
            btn.addEventListener('click', function (e) {
                const btn = $(this);
                if (btn.prop('disabled')) return;
                btn.prop('disabled', true);
                const id = $('#deleteCategoryWithId').val();
                console.log('Delete category with id ' + id);
                $.ajax({
                    type: 'GET',
                    url: '/admin/category/delete-ajax/'+id,
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
