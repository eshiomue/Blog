<x-main-layout>
	<div class="container">
		<div class="row" style="margin-top: 50px">
            <div class="col-md-9">
                @if($post->picture != '')
                    <div>
                        <img src="{{asset($post->picture)}}" style="width:100%; height: auto;">
                    </div>
                @endif

                <h1 style="margin-top:15px">{{$post->title}} <span style="font-size:0.5rem">{{ $post->category != null ? $post->category->title : '' }}</span></h1>
                <p style="text-align: justify;"><?php echo($post->content); ?></p>

                <span style="font-weight:bold; font-style: italic;"> Created by:
                    {{ $post->user != null ? $post->user->name : ''}}
                </span>

                <span style="font-weight:bold; font-style: italic;">
                    {{$post->created_at->diffForHumans()}}
                </span>

                <?php $comments = $post->comments ?>
                @foreach($comments as $reply)
                    <div class="row" style="border:1px; margin-top: 20px; border-top: thin solid #999999; padding: 15px; border-radius: 15px;">
                        <h6>Re:{{$post->title}}</h6>
                        <p>
                            <b>{{$reply->user->name}}</b>:- <?php echo($reply->comment); ?>
                        </p>
                    </div>
                @endforeach

                <div class="comment-section" style="margin-top: 50px">
                <h6>Leave a Comment</h6>
                    <form action="/posts/comments" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$post->id}}">
                        <textarea id="summernote" name="comment" rows="5" cols="40" placeholder="Write something..." required></textarea><br><br>
                        <input class="btn btn-primary" type="submit" value="Post Comment">
                    </form>
                </div>
            </div>

            <div class="col-md-3">
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-12">
                        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                            @if((!is_null($relatedPosts)) && (count($relatedPosts)))
                                <h5 class="mb-3">Related post</h5>
                                @foreach($relatedPosts as $post)
                                    <div class="col-md-12" style="border-radius: 15px; margin-bottom: 10px;">
                                        <a href="{{ url('/post/view', ['id'=>$post->id] ) }}"> {{$post->title}} </a>
                                    </div>

                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-12">
                        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                            <h5 class="mb-3">Blog categories</h5>
                            @if((!is_null($categories)) && (count($categories)))
                                <div class="col-md-12" style="border-radius: 15px; margin-bottom: 10px;">
                                    @foreach($categories as $category)
                                        <p>
                                            <a href="{{ url('/category/' . $category->id . '/blogs') }}">
                                                <strong>{{ $category->title }}</strong>
                                            </a>
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</x-main-layout>
