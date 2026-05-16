<x-admin-layout>
	<div class="container-xxl py-5" style="background-color: #ffffff;">
        <div class="container">
            <div class="row" style="margin-top: 50px; margin-bottom: 20px;">
                <div class="col-md-12">
                    <h4>Create Blog Category</h4>
                </div>

            </div>
            @if(Session::has('message'))
                <span style="margin-bottom: 20px; color: green;">{{Session::get('message')}}</span>
            @endif
            <form method="POST" action="/admin/category/add">
                {{csrf_field()}}
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Your Name">
                            <label for="title">Title</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Enter Description" id="description" name="description" style="height: 150px"></textarea>
                            <label for="description">Description</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">Save category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</x-admin-layout>
