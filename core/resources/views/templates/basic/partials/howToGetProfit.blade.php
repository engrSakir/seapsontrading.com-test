@php
    $profitCaption = getContent('profit.caption',true);
    $profits = getContent('profit');
@endphp
@if($profitCaption)

    <div class="get-profit-section pos-rel">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-header">
                        <h2 class="title">{{__(@$profitCaption->data_values->title)}}</h2>
                        <p class="section-para">{{__(@$profitCaption->data_values->short_details)}}</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-30-none">

                @foreach($profits as $k=>$data)
                <div class="col-md-6 col-xl-3">
                    <div class="profit-item">
                        <div class="profit-thumb">
                            <?php echo  @$data->data_values->icon?>
                        </div>
                        <div class="profit-content">
                            <h4 class="subtitle">{{__(@$data->data_values->title)}}</h4>
                            <p>
                                {{__(@$data->data_values->short_details)}}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach

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
