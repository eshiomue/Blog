<x-main-layout>
	<div class="container">
		@if(Session::has('error'))
			<span style="margin-bottom: 20px; color: green;">{{Session::get('error')}}</span>
		@endif
		<table class="table table-striped" cellpadding="10">
			<tr style="font-weight: bold;">
				<td> SN </td>
				<td> Title </td>
				<td> Content </td>
				<td> Posted_by</td>
				<td> Category </td>
				<td> Photo</td>
				<td>Comments</td>
				<td colspan="2">Manage</td>
				
			</tr>
			<?php $count = 0; ?>
			@foreach($blogs as $item)
				<?php $count++; ?>
				<tr>
					<td>{{$count}}</td>
					<td>  <a href="/post/view/{{$item->id}}"> {{$item->title}} </a></td>
					<td> {{ substr($item->content, 0,100) }}... </td>
					<td> 
						{{ $item->user != null ? $item->user->name : "-" }}
					</td>
					<td> 
						{{ $item->category != null ? $item->category->title : ""  }}						
					</td>
					<td>
						<img src="<?php echo('/' . $item->picture); ?>" width="50" height="50">
					</td>
					<td>
						{{ $item->comments != null ? count($item->comments) : 0 }}
					</td>
						<td><a href="/edit-post/<?php echo($item->id);?>" class="btn btn-primary">Edit</a></td>
						<td><button class="btn btn-danger" onClick ="askDeleteQuestion(<?php echo($item->id);?>)">Delete</button></td>

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
				window.location = '/delete-post/' + id;
			}
		}
	</script>

</x-main-layout>