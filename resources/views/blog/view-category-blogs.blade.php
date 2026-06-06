<x-main-layout>
<div class="container" style="margin-top: 15px;">
	<h1>{{ $data != null ? $data['title'] : ''}}</h1>

    <div class="row">
        @if((!is_null($data['blogs'])) && (count($data['blogs']) > 0))
            @foreach($data['blogs'] as $blog)
                @if ($blog->status == 'active')
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <a href="{{ url('/post/view', ['id'=>$blog->id]) }}">
                                    <img class="img-fluid" src="/{{ $blog->picture }}" alt="pic">
                                </a>
                            </div>
                            <div class="p-4 pb-0">
                                <!-- <h5 class="text-primary mb-3">$12,345</h5> -->
                                <a class="d-block h5 mb-2" href="{{ url('/post/view', ['id'=>$blog->id]) }}">{{ $blog->title }}</a>
                                @php
                                    $excerpt = substr($blog->content, 0, 80);
                                    if (strlen($blog->content) > 80) {
                                        $excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . '...';
                                    }
                                @endphp
                                <p> {!! \Illuminate\Support\Str::limit($excerpt, 80, '...') !!}</p>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-circle" aria-hidden="true"></i> {{ $blog->user != null ? 'By '. explode(' ', $blog->user->name)[0] : '' }}</small>
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $blog->created_at->diffForHumans() }}</small>
                                <small class="flex-fill text-center py-2"><i class="fa fa-comments" aria-hidden="true"></i> {{ $blog->comments != null ? count($blog->comments) : 0 }} Comments</small>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
             <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                No posts in the category
             </div>
        @endif
    </div>

    <div class="row" style="margin-top: 20px;">
	    <h3>Other Categories</h3>
        @if((!is_null($categories)) || (count($categories) > 0))
            <div class="row">
                @foreach($categories as $item)
                    @if($item->id != $data['id'])
                        <div class="col-md-3 blog-category">
                            <a href="/category/{!! $item->id!!}/blogs">
                                {{$item->title}} - {{$item->blogs_count }} {{ $item->blogs_count > 1 ? 'posts' : 'post' }}
                            </a>
                            <p>{{ $item->description }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>
</x-main-layout>
