@php
    $callToActionCaption = getContent('callToAction.caption',true);
@endphp
@if($callToActionCaption)
<!-- ========Call-In-Action-Section Starts Here ========-->
<section class="call-in-action bg-6 padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="call-wrapper">
                    <div class="call-area">
                        <h3 class="title">{{__(@$callToActionCaption->value->title)}}</h3>
                        <p>{{__(@$callToActionCaption->value->short_details)}}</p>
                        <a href="{{@$callToActionCaption->value->btn_link}}" class="custom-button bg-3">{{__(@$callToActionCaption->value->btn_name)}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========Call-In-Action-Section Ends Here ========-->
@endif
