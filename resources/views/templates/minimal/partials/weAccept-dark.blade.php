<!-- ========Sponsor-Section Starte Here ========-->
@php
    $weAcceptCaption = getContent('weAccept.caption',true);
    $weAccept = \App\Gateway::where('status', '1')->get();
@endphp
@if($weAcceptCaption)

<div class="sponsor-section padding darkmode">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header">
                    <h2 class="title">{{@$weAcceptCaption->data_values->title}}</h2>
                    <p>{{@$weAcceptCaption->data_values->short_details}}</p>
                </div>
            </div>
        </div>
        <div class="sponsors">
            <div class="owl-carousel owl-theme sponsor-slider">


                @foreach($weAccept as $data)
                <div class="sponsor-thumb">
                    <a href="javascript:void(0)">
                        <img src="{{get_image(config('constants.deposit.gateway.path') .'/'. $data->image)}}" alt="{{$data->name}}">
                    </a>
                </div>
                @endforeach

            </div>
            <div class="owl-prev">
                <i class="fas fa-angle-left"></i>
            </div>
            <div class="owl-next">
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </div>
</div>
@endif
<!-- ========Sponsor-Section Ends Here ========-->

