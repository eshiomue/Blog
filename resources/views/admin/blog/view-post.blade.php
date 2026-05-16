<x-admin-layout>
	<div class="container-xxl py-5" style="background-color: #ffffff;">
        <div class="container">
            <div class="row" style="margin-top: 50px">
                <div class="col-md-9">
                    @if($post->picture != '')
                        <div>
                            <img src="{{asset($post->picture)}}" style="width:100%; height: auto;">
                        </div>
                    @endif
                    <h1>{{$post->title}}</h1>
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
                </div>

                <div class="col-md-3">
                    <div class="row g-0 gx-5 align-items-end">
                        <div class="col-lg-12">
                            <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                                <h5 class="mb-3">Recent post</h5>
                                @if((!is_null($recent)) && (count($recent)))
                                    @foreach($recent as $post)
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
                                        <?php $count = 0; ?>
                                        @foreach($categories as $category)
                                        {{ $count > 0 ? ', '  : '' }}
                                        <a href="{{ url('/category/' . $category->id . '/blogs') }}">
                                                <strong>{{ $category->title }}</strong>
                                        </a>
                                            <?php $count++;?>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</x-admin-layout>
