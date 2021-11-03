@php
    $subscribeCaption = getContent('subscribe.caption',true);
@endphp
@if($subscribeCaption)
<div class="subscribe-area" id="subscribe">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 text-center">
                <div class="section-header">
                    <h2 class="title">{{__(@$subscribeCaption->data_values->title)}}</h2>
                    <p class="section-para">{{__(@$subscribeCaption->data_values->short_details)}}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <form class="subscribe-form" action="{{route('home.subscribe')}}" method="post">
                    @csrf
                    <input type="email" name="email" placeholder="@lang('Subscribe your email')" required value="{{old('email')}}">
                    <input type="submit" class="btn-default website-color " value="@lang('Subscribe')">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="sec-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sec"></div>
            </div>
        </div>
    </div>
</div>
@endif
