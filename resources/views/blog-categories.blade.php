<x-main-layout>

	<div class="container">
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
						<a href="/category/blogs/ {!! $item->id!!}"> {{$item->title}} </a>
					</td>
					<td> {{$item->description}} </td>
						<td><a href="/blog-categories/ {!! $item->id!!}" class="btn btn-primary">Edit</a></td>
						<td><button class="btn btn-danger" onClick ="askDeleteQuestion( {!! $item->id!!})">Delete</button></td>

				</tr>
			@endforeach
		</table>
	</div>

	<script type="text/javascript">

		function askDeleteQuestion(id){
			console.log(id);
			var answer = confirm('Are you sure you want to delete?');
			console.log(answer);
			if(answer==true){
				window.location = '/delete-category/' + id;
			}
		}
	</script>

</x-main-layout>
