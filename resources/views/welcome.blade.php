<x-main-layout>
        <!-- Blog List Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-6">
                        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                            <h1 class="mb-3">Welcome to Proser Blog</h1>
                            <!-- <p>Success begins with knowledge. Prosper Blog brings you powerful content designed to inspire growth, creativity, and positive change.</p> -->
                             <p>At Prosper Blog, we share practical tips, fresh ideas, and valuable stories to help you learn, improve, and thrive every day.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                        <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-1">Featured</a>
                            </li>
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-2">Recent</a>
                            </li>
                            <li class="nav-item me-0">
                                <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-3">Popular</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            @foreach($posts as $blog)
                                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="property-item rounded overflow-hidden">
                                        <div class="position-relative overflow-hidden">
                                            <a href="{{ url('/post/view', ['id'=>$blog->id]) }}"><img class="img-fluid" src="{{ $blog->picture }}" alt=""></a>
                                            <!-- <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Sell</div>
                                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Appartment</div> -->
                                        </div>
                                        <div class="p-4 pb-0">
                                            <!-- <h5 class="text-primary mb-3">$12,345</h5> -->
                                            <a class="d-block h5 mb-2" href="{{ url('/post/view', ['id'=>$blog->id]) }}">
                                                @php
                                                    $excerpt = substr($blog->title, 0, 60);
                                                    if (strlen($blog->title) > 60) {
                                                        $excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . '...';
                                                    }
                                                @endphp
                                                {{ \Illuminate\Support\Str::limit($excerpt, 60, '...') }}
                                            </a>
                                            @php
                                                $excerpt = substr($blog->content, 0, 80);
                                                if (strlen($blog->content) > 80) {
                                                    $excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . '...';
                                                }
                                            @endphp
                                            <p><?php echo(\Illuminate\Support\Str::limit($excerpt, 80, '...')); ?> </p>
                                        </div>
                                        <div class="d-flex border-top">
                                            <small class="flex-fill text-center border-end py-2"><i class="fa-duotone fa-thin fa-user"></i>{{ $blog->user != null ? 'By '. explode(' ', $blog->user->name)[0] : '' }}</small>
                                            <small class="flex-fill text-center border-end py-2"><i class="fa-graphite fa-thin fa-calendar"></i>{{ $blog->created_at->diffForHumans() }}</small>
                                            <small class="flex-fill text-center py-2"><i class="fa-thin fa-comment"></i>{{ $blog->comments != null ? count($blog->comments) : 0 }} Comments</small>
                                            <small class="flex-fill text-center py-2"><i class="fa-thin fa-group"></i>{{ $blog->category != null ? 'Category: ' . $blog->category->title : '' }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                                {{ $posts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Blog List End -->
             <hr>
            <div class="container" style="margin-top: 15px;">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Blog Categories</h4>
                    </div>
                </div>
                @if((is_null($categories)) || (count($categories) == 0))
                    <div class="row" style="margin-top:10px; text-align: center;">
                        <p>No categories found</p>
                    </div>
                @else

                    <div class="row">
                        @foreach($categories as $item)
                            <div class="col-md-3">
                                <a href="/category/<?php echo($item->id);?>/blogs">
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
