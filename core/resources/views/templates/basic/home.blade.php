@extends(activeTemplate() .'layouts.master')

@section('style')
    <style>
        .plan-item {
            padding-top: 10px;
            width: 406px;
        }
    </style>
@stop

@php
    $bannerCaption = getContent('banner.caption',true);
@endphp
@push('home-breadcrumb')
    <div class="banner-area">
        <div id="particles-js"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="title py-5">{{__(@$bannerCaption->data_values->title)}}</h1>
                    <p class="pb-5">
                        {{__(@$bannerCaption->data_values->sub_title)}}
                    </p>
                    <a href="{{route('user.register')}}" class="btn btn-default website-color mt-1 mb-1">@lang('SIGNUP NOW')</a>
                </div>
                <div class="col-lg-6">
                    <div class="coin_main"><img src="{{asset('assets/images/frontend/'.@$bannerCaption->data_values->about)}}" alt="..."></div>
                </div>
            </div>
        </div>
    </div>
@endpush


@section('content')

    <div class="sec-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec"></div>
                </div>
            </div>
        </div>
    </div>


    @if($sections->secs != null)
    @foreach(json_decode($sections->secs) as $sec)
        @include(activeTemplate().'partials.'.$sec)
    @endforeach
    @endif


@endsection


