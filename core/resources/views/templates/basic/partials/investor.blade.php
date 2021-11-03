@php
    $investorCaption = getContent('investor.caption',true);
@endphp
@if($investorCaption)
    @php
        $topInvestor = \App\Invest::with('user')
                   ->selectRaw('SUM(amount) as totalAmount, user_id')
                   ->orderBy('totalAmount', 'desc')
                   ->groupBy('user_id')
                   ->limit(6)
                   ->get()->toArray();
    @endphp

    <section class="investetor-section padding-top padding-bottom">
        <div class="container">


            <div class="row justify-content-center ">
                <div class="col-10 text-center">
                    <div class="section-header mb-5">
                        <h2 class="title">{{__(@$investorCaption->data_values->title)}} </h2>
                        <p class="section-para">{{__(@$investorCaption->data_values->short_details)}}</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-30-none">

                @foreach($topInvestor as $k => $data)
                    <div class="col-md-6 col-lg-4 col-xl-3 col-sm-10">
                        <div class="investor-item">
                            <div class="investor-thumb">


                                <img src="{{get_image(config('constants.user.profile.path') .'/'. json_decode(json_encode($data['user']['image']))) }}" alt="{{json_decode(json_encode($data['user']['username']))}}">
                                <a href="{{get_image(config('constants.user.profile.path') .'/'. json_decode(json_encode($data['user']['image']))) }}" class="img-pop">
                                    <i class="flaticon-plus"></i>
                                </a>
                            </div>
                            <div class="investor-content">
                                <h5 class="title">
                                    <a href="javascript:void(0)"> {{json_decode(json_encode($data['user']['username']))}}</a>
                                </h5>
                                <span class="total">@lang('Total Invest') : </span><span class="amount">{{$general->cur_sym}}{{$data['totalAmount'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
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
