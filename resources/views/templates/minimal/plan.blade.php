@extends(activeTemplate() .'layouts.master')

@guest
    @section('content')
        @php
            $planCaption = getContent('plan.caption',true);
        @endphp
        @include(activeTemplate().'partials.frontend-breadcrumb')
        <!-- ========Ticket-Section Starts Here ========-->
        <section class="ticket-section padding-bottom c-shape-wrapper padding-top">
            <div class="container">


                <div class="row">
                    <div class="col-12">
                        <div class="section-header">
                            <h2 class="title">{{__(@$planCaption->data_values->title)}}</h2>
                            <p>{{__(@$planCaption->data_values->short_details)}}</p>
                        </div>
                    </div>
                </div>


                <div class="row justify-content-center mb-30-none mt-5">

                    @php
                        $color = ['bg-1','bg-2','bg-3','bg-4','bg-5','bg-6','bg-7','bg-8'];
                    @endphp

                    @foreach($plans as $k => $data)
                        @php
                            $time_name = \App\TimeSetting::where('time', $data->times)->first();
                        @endphp
                    <div class="col-md-6 col-lg-4">
                        <div class="ticket-item {{$color[$k]}}">
                            <h3 class="title">{{$data->name}}</h3>
                            <h6 class="sub-title">{{__($data->interest)}} @if($data->interest_status == 1) % @else {{__($general->cur_text)}} @endif</h6>
                            <ul>
                                <li>{{__($time_name->name)}} / @if($data->lifetime_status == 0) {{__($data->repeat_time)}} @lang('Times') @else @lang('Lifetime') @endif</li>
                                @if($data->capital_back_status == 1)

                                    <li> <span class="badge badge-success">@lang('Capital Will Return Back')</span></li>
                                @elseif($data->capital_back_status == 0)
                                    <li> <span class="badge badge-warning">@lang('Capital Will Store')</span></li>
                                @endif
                                <li>@lang('24/7Support')</li>


                                @if($data->fixed_amount == 0)
                                    <li class="plan_min"> @lang('Min.') {{__($general->cur_sym)}}{{__($data->minimum)}}  <span>@lang('Max:') {{__($general->cur_sym)}}{{__($data->maximum)}}</span></li>

                                @else
                                    <li class="plan_min">  <span>@lang('Invest Amount'): {{__($general->cur_sym)}}{{__($data->maximum)}}</span></li>

                                @endif
                            </ul>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#depoModal" data-resource="{{$data}}"  class="custom-button custom-button-color investButton">@lang('Invest Now')</a>
                        </div>
                    </div>

                        @php
                             array_push($color, $color[$k]);
                        @endphp
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ========Ticket-Section Ends Here ========-->
    @endsection

@endguest
@auth
        @section('content')

            @include(activeTemplate().'partials.breadcrumb')


            <!-- ========User-Panel-Section Starte Here ========-->
            <section class="user-panel-section padding-bottom padding-top">
                <div class="container user-panel-container">
                    <div class=" user-panel-tab">
                        <div class="row">
                            @include(activeTemplate().'partials.sidebar')

                            <div class="col-lg-9" >
                                <div class="user-panel-header mb-60-80">
                                    <div class="left d-sm-block d-none">
                                        <h6 class="title">{{__($page_title)}}</h6>
                                    </div>
                                    <ul class="right">

                                        <li>
                                            <a href="#0" class="log-out d-lg-none">

                                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                                    <span class="navbar-toggler-icon"></span>

                                                    <i class="fas fa-bars" style="color:#fff; font-size:28px;"></i>
                                                </button>
                                            </a>
                                        </li>
                                    </ul>
                                </div>


                                <div class="tab-area fullscreen-width">
                                    <div class="tab-item active">



                                        <div class="row justify-content-center mb-30-none mt-5">

                                            @php
                                                $color = ['bg-1','bg-2','bg-3','bg-4','bg-5','bg-6','bg-7','bg-8'];
                                            @endphp

                                            @foreach($plans as $k => $data)
                                                @php
                                                    $time_name = \App\TimeSetting::where('time', $data->times)->first();
                                                @endphp
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="ticket-item {{$color[$k]}}">
                                                        <h3 class="title">{{$data->name}}</h3>
                                                        <h6 class="sub-title">{{__($data->interest)}} @if($data->interest_status == 1) % @else {{__($general->cur_text)}} @endif</h6>
                                                        <ul>
                                                            <li>{{__($time_name->name)}} / @if($data->lifetime_status == 0) {{__($data->repeat_time)}} @lang('Times') @else @lang('Lifetime') @endif</li>
                                                            @if($data->capital_back_status == 1)

                                                                <li> <span class="badge badge-success">@lang('Capital Will Return Back')</span></li>
                                                            @elseif($data->capital_back_status == 0)
                                                                <li> <span class="badge badge-warning">@lang('Capital Will Store')</span></li>
                                                            @endif
                                                            <li>@lang('24/7Support')</li>


                                                            @if($data->fixed_amount == 0)
                                                                <li class="plan_min"> @lang('Min.') {{__($general->cur_sym)}}{{__($data->minimum)}}  <span>@lang('Max:') {{__($general->cur_sym)}}{{__($data->maximum)}}</span></li>

                                                            @else
                                                                <li class="plan_min">  <span>@lang('Invest Amount'): {{__($general->cur_sym)}}{{__($data->maximum)}}</span></li>

                                                            @endif
                                                        </ul>
                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#depoModal" data-resource="{{$data}}"  class="custom-button custom-button-color investButton">@lang('Invest Now')</a>
                                                    </div>
                                                </div>

                                                @php
                                                    array_push($color, $color[$k]);
                                                @endphp
                                            @endforeach
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ========User-Panel-Section Ends Here ========-->
        @endsection


@endauth

@push('renderModal')
    @php
        $wallets = \App\UserWallet::where('user_id', Auth::id())->get();
    @endphp

    <!-- Modal -->
    <div class="modal fade" id="depoModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    @auth
                    <h5 class="modal-title" id="ModalLabel">@lang('Confirm to invest on') <strong class="planName text-white"></strong></h5>
                    @endauth
                    @guest
                    <h5 class="modal-title" id="ModalLabel">@lang('Need Sign In') </h5>
                    @endguest
                </div>
                <form action="{{route('user.buy.plan')}}" method="post">
                    @csrf
                    @auth
                    <div class="modal-body">

                        <div class="form-group">
                            <h5 class="text-center investAmountRenge"></h5>

                            <p class="text-center interestDetails"></p>
                            <p class="text-center interestValidaty"></p>

                            <div class="form-group">
                                <strong>@lang('Select Wallet')</strong>
                                <select class="form-control"  name="wallet_type">
                                    @foreach($wallets as $k=>$data)
                                        <option value="{{$data->id}}"> {{__(str_replace('_',' ',$data->type))}} ({{formatter_money($data->balance)}} {{__($general->currency)}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="plan_id" class="plan_id">


                            <div class="form-group">
                                <strong>@lang('Invest Amount')</strong>
                                <input type="text" class="form-control fixedAmount" id="fixedAmount" name="amount" value="{{old('amount')}}" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                            </div>
                        </div>
                    </div>

                        <div class="modal-footer">
                            <button type="submit"  class="btn btn-success " >@lang('Yes')</button>
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">@lang('No')</button>
                        </div>
                    @endauth

                    @guest
                        <div class="modal-footer">
                            <a href="{{route('user.login')}}" type="button" class="btn btn-success custom-success" >@lang('Please, Signin your account at first')</a>
                        </div>
                    @endguest
                </form>
            </div>
        </div>
    </div>


@endpush

@push('js')

    <script>
        $(document).ready(function () {
            $('.investButton').on('click', function () {
                var data =$(this).data('resource');
                var symbol = "{{__($general->cur_sym)}}";
                var currency = "{{__($general->cur_text)}}";

                if(data.fixed_amount == '0'){
                    $('.investAmountRenge').text(`@lang('Invest'): ${symbol}${data.minimum} - ${symbol}${data.maximum}`);
                    $('.fixedAmount').val('');
                    $('#fixedAmount').attr('readonly', false);

                }else{
                    $('.investAmountRenge').text(`@lang('Invest'): ${symbol}${data.fixed_amount}`);
                    $('.fixedAmount').val(data.fixed_amount);

                    $('#fixedAmount').attr('readonly', true);
                }

                if(data.interest_status == '1'){
                    $('.interestDetails').html(`<strong> @lang('Interest'): ${data.interest} % </strong>`);
                }else{
                    $('.interestDetails').html(`<strong> @lang('Interest'): ${data.interest} ${currency}  </strong>`);
                }
                if(data.lifetime_status == '0'){
                    $('.interestValidaty').html(`<strong>  @lang('Per') ${data.times} @lang('Hours') ,  ${data.repeat_time} @lang('Times')</strong>`);
                }else{
                    $('.interestValidaty').html(`<strong>  @lang('Per') ${data.times} @lang('Hours'),  @lang('Lifetime') </strong>`);
                }

                $('.planName').text(data.name);
                $('.plan_id').val(data.id);
            });
        });
    </script>
@endpush

