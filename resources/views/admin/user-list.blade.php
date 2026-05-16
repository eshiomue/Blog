<x-admin-layout>
	<div class="container-xxl py-5" style="background-color: #ffffff;">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                        <h1 class="mb-3">User List</h1>
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
                                <th> Name </th>
                                <th> User Type </th>
                                <th> Email</th>
                                <th> Date Registered </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td data-label="#">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
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
                                        <a href="/user/view/<?php echo($user->id);?>" class="btn btn-primary btn-xs">View</a>
                                        <a href="/user/edit/<?php echo($user->id);?>" class="btn btn-warning btn-xs">Edit</a>
                                        <a class="btn btn-danger btn-xs" onClick ="askDeleteQuestion(<?php echo($user->id);?>)">Delete</a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-12">{{ $users->links() }}</div>
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
