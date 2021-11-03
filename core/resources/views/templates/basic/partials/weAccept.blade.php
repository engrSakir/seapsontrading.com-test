@php
    $weAcceptCaption = getContent('weAccept.caption',true);
    $weAccept = \App\Gateway::where('status', '1')->get();
@endphp
@if($weAcceptCaption)
    <section class="logo-area">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-10 text-center">
                    <div class="section-header mb-5">
                        <h2 class="title">{{__(@$weAcceptCaption->data_values->title)}} </h2>
                        <p class="section-para">{{__(@$weAcceptCaption->data_values->short_details)}}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="mon_wr owl-carousel">
                        @foreach($weAccept as $data)
                            <div><img src="{{get_image(config('constants.deposit.gateway.path') .'/'. $data->image)}}" alt="{{$data->name}}"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


@endif
