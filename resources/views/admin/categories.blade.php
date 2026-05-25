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
            <table class="table table-striped" cellpadding="10">
                <tr style="font-weight: bold;">
                    <td> SN </td>
                    <td> Title </td>
                    <td> Description </td>
                    <td colspan="2">Manage</td>
                </tr>
                <?php $count = 0!!}
                    @foreach($categories as $item)
                        <?php $count++!!}
                        <tr>
                            <td>{{$count}}</td>
                            <td>
                                <a href="/category/ {!! $item->id!!}/blogs"> {{$item->title}} </a>
                            </td>
                            <td> {{$item->description}} </td>
                                <td><a href="/categories/ {!! $item->id!!}" class="btn btn-primary">Edit</a></td>
                                <td><button class="btn btn-danger" onClick ="askDeleteQuestion( {!! $item->id!!})">Delete</button></td>

                        </tr>
                    @endforeach
            </table>
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
