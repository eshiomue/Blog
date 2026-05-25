<x-admin-layout>
	<div class="container-xxl py-5" style="background-color: #ffffff;">
        <div class="container" style="margin-top: 50px;">
            @if(Session::has('message'))
                <span style="margin-bottom: 20px; color: green;">{{Session::get('message')}}</span>
            @endif
            <form method="POST" action="/post/update" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    @if(Session::has('success'))
                        <span style="margin-bottom: 20px; color: green;">{{Session::get('success')}}</span>
                    @endif
                    @if(Session::has('error'))
                        <span style="margin-bottom: 20px; color: red;">{{Session::get('error')}}</span>
                    @endif
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="hidden"  name="blogId" value="{{$blog->id}}">
                            <input type="hidden" id="imgUrl" value="{{$blog->picture}}">
                            <input type="text" class="form-control"  name="title" value="{{$blog->title}}">
                            <!-- <label for="title">Title</label> -->
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control"  id="summernote" name="content" style="height: 150px">{{$blog->content}}</textarea>
                            <!-- <label for="description">Content</label> -->
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="">Choose One</option>
                                @foreach($blogCategories as $item)
                                    @if($item->id == $blog->category_id)
                                        <option value="{{ $item->id }}" selected>{{ $item->title }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="category_id">Category</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <!-- <img src="{{url($blog->picture)}}" style="width: 200px; height: auto; border-radius: 5px;"> -->
                            Change Picture <input type="file" name="picture" id="imageInput">
                             <!-- Imaage preview -->
                            <div class="col-12 col-lg-4">
                                <img id="preview" class="mt-3" style="max-width: 200px; display: block;">
                            </div>
                        </div>
                    </div>

                    <div class="col-12" style="margin-top :50px">
                        <button class="btn btn-primary w-100 py-3" type="submit">Update post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
