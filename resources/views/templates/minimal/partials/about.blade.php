@php
    $aboutCaption = getContent('about.caption',true);
@endphp
@if($aboutCaption)
<!-- ========Hyip-About-Section Starts Here ========-->
<section class="about-section padding">
    <div class="container mw-lg-100">
        <div class="row mt-4">
            <div class="col-lg-6">
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
<!-- ========Hyip-About-Section Ends Here ========-->
@endif
