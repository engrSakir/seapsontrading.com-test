<!-- ========Transaction-Section Starts Here ========-->
@php
    $latestTrx = getContent('latestTrx.caption',true);
@endphp
@if($latestTrx)
@php
    $latestDeposit = \App\Deposit::with('user', 'gateway')->where('status', 1)->latest()->limit(5)->get();
    $latestWithdraw = \App\Withdrawal::with('user', 'method')->where('status', 1)->latest()->limit(5)->get();
@endphp


<section class="transaction-section bg-shape-1 padding darkmode">
    <div class="left-shape01">
        <img src="{{asset('assets/images/frontend/animation/left-shape-1.png')}}" alt="shape"
             class="wow slideInLeft">
    </div>
    <div class="trop-2">
        <img src="{{asset('assets/images/frontend/animation/09.png')}}" alt="shape">
    </div>
    <div class="circle-2" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
         data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{asset('assets/images/frontend/animation/05.png')}}" alt="shape">
    </div>
    <div class="circle-3" data-paroller-factor="0.10" data-paroller-factor-lg="-0.30"
         data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{asset('assets/images/frontend/animation/08.png')}}" alt="shape">
    </div>
    <div class="star-4">
        <img src="{{asset('assets/images/frontend/animation/07.png')}}" alt="shape">
    </div>
    <div class="star-4 two">
        <img src="{{asset('assets/images/frontend/animation/07.png')}}" alt="shape">
    </div>
    <div class="star-5">
        <img src="{{asset('assets/images/frontend/animation/07.png')}}" alt="shape">
    </div>
    <div class="circle-1 two">
        <img src="{{asset('assets/images/frontend/animation/10.png')}}" alt="shape">
    </div>
    <div class="circle-2 two" data-paroller-factor="-0.10" data-paroller-factor-lg="0.20"
         data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{asset('assets/images/frontend/animation/08.png')}}" alt="shape">
    </div>
    <div class="circle-2 three" data-paroller-factor="-0.1" data-paroller-factor-lg="0.30"
         data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{asset('assets/images/frontend/animation/11.png')}}" alt="shape">
    </div>
    <div class="right-circle d-none d-lg-block"></div>
    <div class="shadow1 wow slideInUp" data-wow-duration="1s">
        <img src="{{asset('assets/images/frontend/animation/shadow1.png')}}" alt="animation">
    </div>
    <div class="shadow2 wow slideInUp" data-wow-duration="1s" data-wow-delay=".5s">
        <img src="{{asset('assets/images/frontend/animation/shadow1.png')}}" alt="animation">
    </div>
    <div class="coin1 wow bounceInDown" data-wow-duration="1s" data-wow-delay="1.5s">
        <img src="{{asset('assets/images/frontend/animation/coin1.png')}}" alt="animation">
    </div>
    <div class="coin2 wow bounceInDown" data-wow-duration="1s" data-wow-delay="2s">
        <img src="{{asset('assets/images/frontend/animation/coin2.png')}}" alt="animation">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header">
                    <h2 class="title">{{__(@$latestTrx->data_values->title)}}</h2>
                    <p>{{__(@$latestTrx->data_values->short_details)}}</p>
                </div>
            </div>
        </div>
        <div class="tab deposit-tab">
            <ul class="tab-menu text-center">
                <li class="active custom-button">
                    @lang('Latest deposit')
                </li>
                <li class="custom-button">
                    @lang('Latest Withdraw')
                </li>
            </ul>
            <div class="tab-area">
                <div class="tab-item active">
                    <div class="deposite-table">
                        <table>
                            <thead>
                            <tr class="bg-2">
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Date')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('Currency')</th>
                                <th scope="col">@lang('Deposit')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latestDeposit as $data)
                                <tr>
                                    <td>
                                        <div class="author">
                                            <div class="thumb">
                                                <a href="javascript:void(0)">
                                                    <img
                                                        src="{{get_image(config('constants.user.profile.path').'/'.$data->user->image)}}"
                                                        alt="{{$data->user->username}}">
                                                </a>
                                            </div>
                                            <div class="content">
                                                <a href="javascript:void(0)">{{$data->user->fullname}} </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{date('M d, Y',strtotime($data->created_at))}}</td>
                                    <td>{{__($general->cur_sym)}} {{formatter_money($data->amount)}}</td>
                                    <td>{{__($data->gateway->name)}}</td>
                                    <td>{{diffForHumans($data->created_at)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-item">
                    <div class="deposite-table">
                        <table>
                            <thead>
                            <tr class="bg-2">
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Date')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('Currency')</th>
                                <th scope="col">@lang('Withdraw')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latestWithdraw as $data)
                                <tr>
                                    <td>
                                        <div class="author">
                                            <div class="thumb">
                                                <a href="javascript:void(0)">
                                                    <img
                                                        src="{{get_image(config('constants.user.profile.path').'/'.$data->user->image)}}"
                                                        alt="{{$data->user->username}}">
                                                </a>
                                            </div>
                                            <div class="content">
                                                <a href="javascript:void(0)">{{$data->user->fullname}} </a>
                                            </div>
                                        </div>
                                    </td>


                                    <td>{{date('M d, Y',strtotime($data->created_at))}}</td>
                                    <td>{{__($general->cur_sym)}} {{formatter_money($data->amount)}}</td>
                                    <td>{{__($data->method->name)}}</td>
                                    <td>{{diffForHumans($data->created_at)}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- ========Transaction-Section Ends Here ========-->
