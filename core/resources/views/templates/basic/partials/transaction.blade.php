@php
    $latestTrx = getContent('latestTrx.caption',true);
@endphp
@if($latestTrx)
    @php
        $latestDeposit = \App\Deposit::with('user', 'gateway')->where('status', 1)->latest()->limit(5)->get();
        $latestWithdraw = \App\Withdrawal::with('user', 'method')->where('status', 1)->latest()->limit(5)->get();
    @endphp


    <div class="transaction">
        <div class="container">


            <div class="row justify-content-center ">
                <div class="col-10 text-center">
                    <div class="section-header mb-5">
                        <h2 class="title">{{__(@$latestTrx->data_values->title)}} </h2>
                        <p class="section-para">{{__(@$latestTrx->data_values->short_details)}}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="transaction-area">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#deposit" role="tab"
                                   aria-selected="true">Deposit</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#withdraw" role="tab"
                                   aria-selected="false">Withdraw</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="deposit" role="tabpanel" aria-labelledby="home-tab">

                                <table class="table">
                                    <thead>
                                    <tr>
                                        
                                        <th scope="col">@lang('Date')</th>
                                        <th scope="col">@lang('Amount')</th>
                                        <th scope="col">@lang('Currency')</th>
                                        <th scope="col">@lang('Deposit')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($latestDeposit as $data)
                                        <tr>
                                            <th scope="row" class="d-flex">
                                                <div class="user-img">
                                                    <img src="{{get_image(config('constants.user.profile.path').'/'.$data->user->image)}}" alt="">
                                                </div>
                                                
                                            </th>
                                            <td>{{date('M d, Y',strtotime($data->created_at))}}</td>
                                            <td>{{__($general->cur_sym)}} {{formatter_money($data->amount)}}</td>
                                            <td>{{__($data->gateway->name)}}</td>
                                            <td>{{diffForHumans($data->created_at)}}</td>
                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>

                            </div>
                            <div class="tab-pane fade" id="withdraw" role="tabpanel" aria-labelledby="profile-tab">

                                <table class="table">
                                    <thead>
                                    <tr>
                                        
                                        <th scope="col">@lang('Date')</th>
                                        <th scope="col">@lang('Amount')</th>
                                        <th scope="col">@lang('Currency')</th>
                                        <th scope="col">@lang('Withdraw')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($latestWithdraw as $data)
                                        <tr>
                                            <th scope="row" class="d-flex">
                                                <div class="user-img">
                                                    <img src="{{get_image(config('constants.user.profile.path').'/'.$data->user->image)}}" alt="">
                                                </div>
                                                
                                            </th>
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
