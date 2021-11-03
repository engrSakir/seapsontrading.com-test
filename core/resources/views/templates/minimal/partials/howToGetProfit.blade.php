@php
    $profitCaption = getContent('profit.caption',true);
    $profits = getContent('profit');
@endphp
@if($profitCaption)

    <!-- ========Feature-Section Starts Here ========-->
    <section class="get-profit-section padding pos-rel">
        <div class="circle-2" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
             data-paroller-type="foreground" data-paroller-direction="horizontal">
            <img src="{{asset('assets/images/frontend/animation/05.png')}}" alt="shape">
        </div>
        <div class="left-shape01 right">
            <img src="{{asset('assets/images/frontend/animation/right-shape-1.png')}}" alt="shape"
                 class="wow slideInRight">
        </div>
        <div class="circle-2 four" data-paroller-factor="-0.1" data-paroller-factor-lg="0.30"
             data-paroller-type="foreground" data-paroller-direction="horizontal">
            <img src="{{asset('assets/images/frontend/animation/11.png')}}" alt="shape">
        </div>
        <div class="circle-1 three">
            <img src="{{asset('assets/images/frontend/animation/12.png')}}" alt="animation">
        </div>
        <div class="trop-3">
            <img src="{{asset('assets/images/frontend/animation/13.png')}}" alt="animation">
        </div>
        <div class="trop-4">
            <img src="{{asset('assets/images/frontend/animation/14.png')}}" alt="animation">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-header">
                        <h2 class="title">{{__(@$profitCaption->data_values->title)}}</h2>
                        <p>{{__(@$profitCaption->data_values->short_details)}}</p>
                    </div>
                </div>
            </div>
            <div class="get-profit">
                @foreach($profits as $k=>$data)
                <div class="item">
                <div class="item-thumb">
                    <?php echo  @$data->data_values->icon?>
                </div>
                <h5 class="subtitle">{{__($data->data_values->title)}}</h5>
                </div>
                @endforeach
                <div class="thumb d-none d-lg-block">
                    <img src="{{asset('assets/images/frontend/profit/'.@$profitCaption->data_values->image)}}"
                         alt="profit">
                </div>
            </div>
        </div>
    </section>
    <!-- ========Feature-Section Ends Here ========-->
@endif
