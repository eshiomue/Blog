<x-main-layout>
	<div class="container-xxl py-5">
        <div class="container" style="background-color:#ffffff">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                        <h1 class="mb-3">Posts</h1>
                    </div>
                </div>
            </div>
            <div class="row">
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
                        <td colspan="3"></td>

                    </tr>
                    <?php $count = 0!!}
                    @foreach($blogs as $item)
                        <?php $count++!!}
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
                                <img src=" {!! '/' . $item->picture !!}" width="50" height="50">
                            </td>
                            <td>
                                {{ $item->comments != null ? count($item->comments) : 0 }}
                            </td>
                            <td>
                                <a href="/post/view/ {!! $item->id!!}" class="btn btn-primary btn-sm">View</a>
                            </td>
                            <td>
                                <a href="/post/edit/ {!! $item->id!!}" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                            <td>
                                <a class="btn btn-danger btn-sm" onClick ="askDeleteQuestion( {!! $item->id!!})">Delete</a>
                            </td>

                        </tr>
                    @endforeach
                </table>
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

</x-main-layout>
