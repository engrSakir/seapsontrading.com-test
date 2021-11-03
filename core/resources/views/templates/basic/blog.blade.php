@extends(activeTemplate() .'layouts.master')

@section('content')
    <div class="inner-banner-area">
        <div id="particles-js"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="title"><span>{{__($page_title)}}</span></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="container py-5 ">
            <div class="row">
                <div class="col-md-8">
<div class="row justify-content-center">
                    @foreach($blogs as $k=> $data)
                       <div class="col-md-6">
                    <div class="blog-post ">
                        <div class="item-thumbs">
                            <img src="{{get_image(config('constants.frontend.blog.post.path').'/'.$data->value->image)}}" alt="{{$data->value->title}}" style="width: 100%;">
                        </div>
                        <div class="blog-outer">
                            <div class="meta ">
                                <span class="date mb-3 text-white">  {{date('d-M-Y', strtotime($data->created_at))}}</span>
                            </div><br>
                            <a href="{{route('home.blog.details',[str_slug($data->value->title),$data->id])}}" class="mt-3 ">
                            <h2 class="blog-title text-white">{{__($data->value->title)}} </h2>
                            </a>
                        </div>

                    </div>
                    </div>
                    @endforeach
                </div>



                </div>
                @include(activeTemplate().'partials.recent-blog')
            </div>

            <div class="row  mt-4">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    {{$blogs->links()}}
                </div>
            </div>
        </div>
    </div>






@endsection
