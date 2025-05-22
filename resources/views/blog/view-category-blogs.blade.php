<x-main-layout>
<div class="container">
	<h1>{{ $data->title }}</h1>
	<table class="table table-striped" cellpadding="10">
		<tr>
			<td> SN </td>
			<td>Photo</td>
			<td>Title</td>
			<td>Content</td>
			<td>Posted by</td>
			<td>Date</td>
		</tr>
		<?php $count = 0; ?>
		@foreach($data->blogs as $item)
			<?php $count++; ?>
			<tr>
				<td>{{$count}}</td>
				<td>
					@if($item->picture != '')
						<img alt="No picture" src="{{asset($item->picture)}}" style="width: 50px; height: 50px;">
					@endif
					</td>
				<td><a href="/post/view/{{$item->id}}"> {{$item->title}}</td>
				<td>{{$item->content}}</td>
				<td width="150px">{{$item->user->name}}</td>
				<td width="150px">{{date_format($item->created_at, 'D F j, Y')}}</td>
			</tr>
		@endforeach		
	</table>
	


</div>
</x-main-layout>