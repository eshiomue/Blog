<x-admin-layout>

    <div class="container-xxl py-5" style="background-color: #ffffff;">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                        <h1 class="mb-3">Create blog post</h1>
                        <!-- <p>Success begins with knowledge. Prosper Blog brings you powerful content designed to inspire growth, creativity, and positive change.</p> -->
                            <p>At Prosper Blog, we share practical tips, fresh ideas, and valuable stories to help people learn, improve, and thrive every day.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(Session::has('message'))
                    <span style="margin-bottom: 20px; color: green;">{{Session::get('message')}}</span>
                @endif
                <form method="POST" action="/post/save" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                                <label for="title">Title</label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Enter Content" id="summernote" name="content"
                                style="min-height: 250px" required></textarea>
                                <label for="description">Content</label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="form-floating">
                                <select class="form-control" id="category_id" name="category_id" required>
                                    <option value="">Choose One</option>
                                    @foreach($blogCategories as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                                <label for="category_id">Category</label>
                            </div>
                        </div>

                        <div class="row" style="margin-top :20px">
                        <input type="file" name="picture" id="imageInput">
                        <!-- Imaage preview -->
                        <div class="col-12 col-lg-4">
                            <img id="preview" class="mt-3" style="max-width: 200px; display: block;">
                        </div>
                        </div>
                        <div class="row" style="margin-top :50px">
                            <button class="btn btn-primary w-100 py-3" type="submit">Save post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
