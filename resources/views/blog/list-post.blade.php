<x-main-layout>
    @auth
        <div class="container" style="margin-top: 15px;">
            <h3>My Post</h3>

            <div class="row">
                @if((!is_null($myPost)) && (count($myPost) > 0))
                    @foreach($myPost as $blog)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="property-item rounded overflow-hidden">
                                <div class="position-relative overflow-hidden">
                                    <a href="{{ url('/post/view', ['id'=>$blog->id]) }}">
                                        <img class="img-fluid" src="/{{ $blog->picture }}" alt="pic">
                                    </a>
                                </div>
                                <div class="p-4 pb-0">
                                    <!-- <h5 class="text-primary mb-3">$12,345</h5> -->
                                    <a class="d-block h5 mb-2" href="{{ url('/post/view', ['id'=>$blog->id]) }}">
                                        {{ $blog->title }} <span style="font-size: 0.8rem; color:brown">{{ $blog->category != null ? ' - ' . $blog->category->title : '' }}</span>
                                    </a>
                                    @php
                                        $excerpt = substr($blog->content, 0, 80);
                                        if (strlen($blog->content) > 80) {
                                            $excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . '...';
                                        }
                                    @endphp
                                    <p>{!!\Illuminate\Support\Str::limit($excerpt, 80, '...')!!}</p>
                                </div>
                                <div class="d-flex border-top">
                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-circle" aria-hidden="true"></i> {{ $blog->user != null ? 'By '. explode(' ', $blog->user->name)[0] : '' }}</small>
                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $blog->created_at->diffForHumans() }}</small>
                                    <small class="flex-fill text-center py-2"><i class="fa fa-comments" aria-hidden="true"></i> {{ $blog->comments != null ? count($blog->comments) : 0 }} Comments</small>
                                </div>
                                <!-- <div class="row"> -->
                                    <div class="d-flex gap-3" style="text-align: right; padding: 0.5rem;">
                                        <a href="{{ url('/post/view/'. $blog->id) }}"><button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                        <a href="{{ url('/post/edit/'. $blog->id) }}"><button class="btn btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
                                        <a href="{{ url('/post/delete/'. $blog->id) }}"><button class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                                    </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                        No posts in your profile
                    </div>
                @endif

                <div class="col-md-12">
                    {{ $myPost != null ? $myPost->links() : '' }}
                </div>
            </div>
        </div>
    @endauth

    <div class="container" style="margin-top: 25px;">
        @auth
            <h3>Other Post</h3>
        @else
            <h3>Post</h3>
        @endauth

        <div class="row">
            @if((!is_null($blogs)) && (count($blogs) > 0))
                @foreach($blogs as $blog)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <a href="{{ url('/post/view', ['id'=>$blog->id]) }}">
                                    <img class="img-fluid" src="/{{ $blog->picture }}" alt="pic">
                                </a>
                            </div>
                            <div class="p-4 pb-0">
                                <!-- <h5 class="text-primary mb-3">$12,345</h5> -->
                                <a class="d-block h5 mb-2" href="{{ url('/post/view', ['id'=>$blog->id]) }}">
                                    {{ $blog->title }} <span style="font-size: 0.8rem; color:brown">{{ $blog->category != null ? ' - ' . $blog->category->title : '' }}</span>
                                </a>
                                @php
                                    $excerpt = substr($blog->content, 0, 80);
                                    if (strlen($blog->content) > 80) {
                                        $excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . '...';
                                    }
                                @endphp
                                <p>{!!\Illuminate\Support\Str::limit($excerpt, 80, '...')!!}</p>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-circle" aria-hidden="true"></i> {{ $blog->user != null ? 'By '. explode(' ', $blog->user->name)[0] : '' }}</small>
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $blog->created_at->diffForHumans() }}</small>
                                <small class="flex-fill text-center py-2"><i class="fa fa-comments" aria-hidden="true"></i> {{ $blog->comments != null ? count($blog->comments) : 0 }} Comments</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                    No posts in the category
                </div>
            @endif

            <div class="col-md-12">
                {{ $blogs->links() }}
            </div>
        </div>

        <div class="row" style="margin-top: 20px;">
            <h3>Other Categories</h3>
            @if((!is_null($categories)) || (count($categories) > 0))
                <div class="row">
                    @foreach($categories as $item)
                        <div class="col-md-3 blog-category">
                            <a href="/category/{!!$item->id!!}/blogs">
                                {{$item->title}} - {{$item->blogs_count }} {{ $item->blogs_count > 1 ? 'posts' : 'post' }}
                            </a>
                            <p>{{ $item->description }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-main-layout>
