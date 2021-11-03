
@php
    $featureCaption = getContent('feature.caption',true);
    $features = getContent('feature');
@endphp
@if($featureCaption)

    <!-- ========Feature-Section Starts Here ========-->
    <section class="feature-section padding darkmode">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-header">
                        <h2 class="title">{{__(@$featureCaption->data_values->title)}}</h2>
                        <p>{{__(@$featureCaption->data_values->short_details)}}</p>
                    </div>
                </div>
            </div>
            <div class="feature-wrapper">
                <div class="feature-area two">
                    @foreach($features as $k => $data)
                    @if($k%2 == 0)
                    <div class="feature-item">
                    <h5 class="subtitle">{{__($data->data_values->title)}}</h5>
                    <p>{{__($data->data_values->short_details)}}</p>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="feature-thumb pos-rel">
                    <img
                        src="{{get_image(config('constants.frontend.feature.path') .'/'. @$featureCaption->data_values->image)}}"
                        alt="feature">


                    <div class="coin-3">
                        <img src="{{asset('assets/images/frontend/feature/feature-coin.png')}}" alt="footer">
                    </div>
                    <div class="coin-3 two">
                        <img src="{{asset('assets/images/frontend/feature/feature-coin.png')}}" alt="footer">
                    </div>
                    <div class="coin-3 three">
                        <img src="{{asset('assets/images/frontend/feature/feature-coin.png')}}" alt="footer">
                    </div>
                    <div class="coin-4">
                        <img src="{{asset('assets/images/frontend/feature/feature-coin.png')}}" alt="footer">
                    </div>
                    <div class="coin-4 two">
                        <img src="{{asset('assets/images/frontend/feature/feature-coin.png')}}" alt="footer">
                    </div>
                    <div class="coin-4 three">
                        <img src="{{asset('assets/images/frontend/feature/feature-coin.png')}}" alt="footer">
                    </div>
                    <div class="coin-4 four">
                        <img src="{{asset('assets/images/frontend/feature/feature-coin.png')}}" alt="footer">
                    </div>

                    <div class="coin-3 bela two">
                        <img src="{{asset('assets/images/frontend/feature/feature-coin.png')}}" alt="footer">
                    </div>
                    <div class="coin-3 bela three">
                        <img src="{{asset('assets/images/frontend/feature/feature-coin.png')}}" alt="footer">
                    </div>
                    <div class="coin-4 bela">
                        <img src="{{asset('assets/images/frontend/feature/feature-coin.png')}}" alt="footer">
                    </div>
                    <div class="coin-4 bela two">
                        <img src="{{asset('assets/images/frontend/feature/feature-coin.png')}}" alt="footer">
                    </div>
                    <div class="coin-4 bela three">
                        <img src="{{asset('assets/images/frontend/feature/feature-coin.png')}}" alt="footer">
                    </div>
                    <div class="coin-4 bela four">
                        <img src="{{asset('assets/images/frontend/feature/feature-coin.png')}}" alt="footer">
                    </div>
                </div>
                <div class="feature-area">
                    @foreach($features as $k => $data)
                    @if($k%2 != 0)
                    <div class="feature-item">
                    <h5 class="subtitle">{{__($data->data_values->title)}}</h5>
                    <p>{{__($data->data_values->short_details)}}</p>
                    </div>
                    @endif
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- ========Feature-Section Ends Here ========-->

@endif
