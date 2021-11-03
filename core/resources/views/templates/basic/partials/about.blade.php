@php
    $aboutCaption = getContent('about.caption',true);
@endphp
@if($aboutCaption)
<section class="about-section padding-bottom padding-top">
    <div class="container ">
        <div class="row">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="hyip-about-thumb">
                    <img src="{{asset('assets/images/frontend/'.@$aboutCaption->value->about)}}"
                         alt="{{$general->sitename}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hyip-about-content pt-80">
                    <div class="section-header left-style">
                        <h2 class="title">{{__(@$aboutCaption->value->title)}}</h2>
                        <p class="ml-0">{{__(strip_tags(@$aboutCaption->value->details))}}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


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
