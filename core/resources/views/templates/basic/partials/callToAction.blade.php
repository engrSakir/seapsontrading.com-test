@php
    $callToActionCaption = getContent('callToAction.caption',true);
@endphp
@if($callToActionCaption)
    <div class="call-to-action-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <div class="call-to-action-content">
                        <h2 class="title">{{__(@$callToActionCaption->value->title)}}</h2>
                        <p>{{__(@$callToActionCaption->value->short_details)}}</p>
                        <div class="call-to-action-btn">
                            <a href="{{@$callToActionCaption->value->btn_link}}" class="btn btn-danger">{{__(@$callToActionCaption->value->btn_name)}}</a>
                        </div>
                    </div>
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
