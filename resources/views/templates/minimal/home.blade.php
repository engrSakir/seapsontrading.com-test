@extends(activeTemplate() .'layouts.master')
@section('style')

@stop

@section('content')

    @php
        $bannerCaption = getContent('banner.caption',true);
    @endphp
    @if($bannerCaption)
    <!-- ========Banner-Section Starts Here ========-->
    <section class="banner-section">
        <div class="banner-shape02"></div>
        <div class="banner-shape03"></div>
        <div class="banner-shape01">
            <img src="{{asset('assets/images/frontend/animation/banner-shape.png')}}" alt="banner">
        </div>
        <div class="circle-2" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
             data-paroller-type="foreground" data-paroller-direction="horizontal">
            <img src="{{asset('assets/images/frontend/animation/05.png')}}" alt="shape">
        </div>
        <div class="circle-2 three" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
             data-paroller-type="foreground" data-paroller-direction="horizontal">
            <img src="{{asset('assets/images/frontend/animation/11.png')}}" alt="shape">
        </div>

        <div class="circle-2 five" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
             data-paroller-type="foreground" data-paroller-direction="horizontal">
            <img src="{{asset('assets/images/frontend/animation/15.png')}}" alt="shape">
        </div>

        <div class="container">
            <div class="banner-area align-items-center">
                <div class="banner-content">
                    <h1 class="title">{{__(@$bannerCaption->data_values->title)}}</h1>
                    <p class="text-white">{{__(@$bannerCaption->data_values->sub_title)}}</p>
                    <a href="{{route('user.register')}}" class="custom-button bg-1">@lang('SIGNUP NOW')</a>
                </div>
                <div class="banner-thumb d-none d-md-block">
                    <div class="thumb">
                        <img src="{{asset('assets/images/frontend/'.@$bannerCaption->data_values->about)}}" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========Banner-Section Ends Here ========-->
    @endif


    @if($sections->secs != null)
    @foreach(json_decode($sections->secs) as $sec)
        @include(activeTemplate().'partials.'.$sec)
    @endforeach
    @endif


@endsection
