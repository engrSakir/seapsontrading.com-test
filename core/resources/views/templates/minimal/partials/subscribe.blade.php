@php
    $subscribeCaption = getContent('subscribe.caption',true);
@endphp
@if($subscribeCaption)
<!-- ========Newslater-Section Starts Here ========-->
<section id="subscribe" class="newslater-section padding overlay-1 bg_img pos-rel" data-paroller-factor="0.10"
         data-paroller-factor-lg="-0.30"
         data-paroller-type="background" data-paroller-direction="vertical">

    <div class="star-1">
        <img src="{{asset('assets/images/frontend/animation/01.png')}}" alt="shape">
    </div>

    <div class="circle-1">
        <img src="{{asset('assets/images/frontend/animation/02.png')}}" alt="shape">
    </div>

    <div class="trop-1">
        <img src="{{asset('assets/images/frontend/animation/03.png')}}" alt="shape">
    </div>

    <div class="star-2">
        <img src="{{asset('assets/images/frontend/animation/04.png')}}" alt="shape">
    </div>

    <div class="circle-2" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
         data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{asset('assets/images/frontend/animation/05.png')}}" alt="shape">
    </div>

    <div class="star-3">
        <img src="{{asset('assets/images/frontend/animation/06.png')}}" alt="shape">
    </div>

    <div class="container">
        <div class="newslater-wrapper ">
            <div class="row">
                <div class="col-12">
                    <div class="section-header">
                        <h2 class="title">{{__(@$subscribeCaption->data_values->title)}}</h2>
                        <p>{{__(@$subscribeCaption->data_values->short_details)}}</p>
                    </div>
                </div>
            </div>
            <form class="subscribe-form pb-70" action="{{route('home.subscribe')}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="@lang('Email Address')">
                    <button type="submit">
                        <i class="flaticon-send"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- ========Newslater-Section Ends Here ========-->
@endif
