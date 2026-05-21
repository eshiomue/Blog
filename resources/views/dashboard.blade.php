<x-main-layout>

    <div class="container">
        <div class="row">
            @if(Session::has('message'))
                <b><span style="margin-bottom: 30px; color: red;">{{Session::get('message')}}</span>
            @endif
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </x-slot>
        </div>
    </div>

    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md-3">
                <h5>My Post <span class="badge bg-success">{{ $myPosts->total() }}</span></h5>
                @if((!is_null($myPosts)) && (count($myPosts) > 0))
                    @foreach($myPosts as $post)
                        <div class="row my-post">
                            <div class="col-md-3">
                                <img src="{{url($post->picture)}}" style="width: 100%; height: auto; border-radius: 5px;">
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ url('/post/view', ['id'=> $post->id]) }}"> {{$post->title}}</a>
                                    </div>
                                    <div class="col-md-12 my-post-footer">
                                        Date: {{ $post->created_at->diffForHumans() }}
                                        | {{ $post->comments != null ? count($post->comments) : 0  }} comments
                                    </div>
                                </div>
                                <div class="d-flex gap-3">
                                    <a href="{{ url('/post/view/'. $post->id) }}"><button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                    <a href="{{ url('/post/edit/'. $post->id) }}"><button class="btn btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
                                    <a href="{{ url('/post/delete/'. $post->id) }}"><button class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-12">
                            {{ $myPosts->links() }}
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-12">You have not made a post</div>
                    </div>
                @endif

                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-12">
                        <h5>My Comments <span class="badge bg-success">{{ $myComments->total() }}</span></h5>
                        @if((!is_null($myComments)) && (count($myComments) > 0))
                            <div class="row">
                                @foreach($myComments as $comment)
                                    <div class="my-post">
                                        <h6>{{ $comment->post->title }}</h6>
                                         {!! $comment->comment !!}

                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-12">You have not made a comment</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <h5>Recent blog post
                    <!-- <span class="badge bg-success">{{ $latestPosts->total() }}</span> -->
                </h5>
                @if((!is_null($latestPosts)) && (count($latestPosts) > 0))
                    <div class="row g-4">
                        @foreach($latestPosts as $blog)
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href="{{ url('/post/view', ['id'=>$blog->id]) }}"><img class="img-fluid" src="{{ $blog->picture }}" alt=""></a>
                                        <!-- <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Sell</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Appartment</div> -->
                                    </div>
                                    <div class="p-4 pb-0">
                                        <!-- <h5 class="text-primary mb-3">$12,345</h5> -->
                                        <a class="d-block h5 mb-2" href="{{ url('/post/view', ['id'=>$blog->id]) }}" title="{{ $blog->title }}">
                                            @php
                                                $excerpt = substr($blog->title, 0, 50);
                                                if (strlen($blog->title) > 50) {
                                                    $excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . '...';
                                                }
                                            @endphp
                                            {{ \Illuminate\Support\Str::limit($excerpt, 50, '...') }}
                                        </a>
                                        @php
                                            $excerpt = substr($blog->content, 0, 80);
                                            if (strlen($blog->content) > 80) {
                                                $excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . '...';
                                            }
                                        @endphp
                                        <p> {!! \Illuminate\Support\Str::limit($excerpt, 80, '...')!!}</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-duotone fa-thin fa-user"></i>{{ $blog->user != null ? 'By '. explode(' ', $blog->user->name)[0] : '' }}</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-graphite fa-thin fa-calendar"></i>{{ $blog->created_at->diffForHumans() }}</small>
                                        <small class="flex-fill text-center py-2"><i class="fa-thin fa-comment"></i>{{ $blog->comments != null ? count($blog->comments) : 0 }} Comments</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12">
                            {{ $myPosts->links() }}
                        </div>
                    </div>
                 @endif
            </div>
        </div>
    </div>
</x-main-layout>

<style>
    .alert {
        font-size: 1rem;
        font-weight: 500;
        border-radius: 0.5rem;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        width: 17%;
        max-width: 800px;
        margin: 0 auto;
    }
</style>
