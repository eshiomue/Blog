<x-main-layout>

	<div class="container">
		<table class="table table-striped" cellpadding="10">
			<tr style="font-weight: bold;">
				<td> SN </td>
				<td> Title </td>
				<td> Description </td>
				<td colspan="2">Manage</td>	
			</tr>
			<?php $count = 0; ?>
			@foreach($categories as $item)
				<?php $count++; ?>
				<tr>
					<td>{{$count}}</td>
					<td>
						<a href="/category/blogs/<?php echo($item->id);?>"> {{$item->title}} </a> 
					</td>
					<td> {{$item->description}} </td>
						<td><a href="/blog-categories/<?php echo($item->id);?>" class="btn btn-primary">Edit</a></td>
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
				window.location = '/delete-category/' + id;
			}
		}
	</script>




<div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="property-item rounded overflow-hidden">
                                <div class="position-relative overflow-hidden">
                                    <a href=""><img class="img-fluid" src="img/property-1.jpg" style="height: 500px; width: 100%; object-fit: cover;" alt=""></a>
                                        <div class="position-absolute bottom-0 start-0 p-3 text-white">
                                            <small class="me-2" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8); letter-spacing: 1px;">
                                                <span><i class="bi bi-person"></i> Emma Davis</span>
                                            </small>
                                            <small class="me-2" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8); letter-spacing: 1px;">
                                               <span><i class="bi bi-clock"></i> Jan 27, 2025</span>
                                            </small>
                                            <h7 class="mb-0 text-white" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">
                                                <span><i class="bi bi-chat-dots"></i> 6 Comments</span>
                                            </h7>
                                            <h5 class="mb-0 text-white" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">
                                                Beautiful House
                                            </h5>
                                        </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="property-item rounded overflow-hidden">
                                <div class="position-relative overflow-hidden">
                                    <a href=""><img class="img-fluid" src="img/property-2.jpg" style="height: 500px; width: 100%; object-fit: cover;" alt=""></a>
                                    <div class="position-absolute bottom-0 start-0 p-3 text-white">
                                            <small class="me-2" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8); letter-spacing: 1px;">
                                                <span><i class="bi bi-person"></i> Emma Davis</span>
                                            </small>
                                            <small class="me-2" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8); letter-spacing: 1px;">
                                               <span><i class="bi bi-clock"></i> Jan 27, 2025</span>
                                            </small>
                                            <h7 class="mb-0 text-white" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">
                                                <span><i class="bi bi-chat-dots"></i> 6 Comments</span>
                                            </h7>
                                            <h5 class="mb-0 text-white" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">
                                                Beautiful House
                                            </h5>
                                        </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                            <div class="property-item rounded overflow-hidden">
                                <div class="position-relative overflow-hidden">
                                    <a href=""><img class="img-fluid" src="img/property-3.jpg" style="height: 500px; width: 100%; object-fit: cover;" alt=""></a>
                                    <div class="position-absolute bottom-0 start-0 p-3 text-white">
                                            <small class="me-2" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8); letter-spacing: 1px;">
                                                <span><i class="bi bi-person"></i> Emma Davis</span>
                                            </small>
                                            <small class="me-2" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8); letter-spacing: 1px;">
                                                <span><i class="bi bi-clock"></i> Jan 27, 2025</span>
                                            </small>
                                            <h7 class="mb-0 text-white" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">
                                                <span><i class="bi bi-chat-dots"></i> 6 Comments</span>
                                            </h7>
                                            <h5 class="mb-0 text-white" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">
                                                Beautiful House
                                            </h5>
                                        </div>      
                                </div>     
                            </div>
                    </div>

</x-main-layout>