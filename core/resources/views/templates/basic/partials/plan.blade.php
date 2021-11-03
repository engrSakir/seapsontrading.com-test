@php
    $planCaption = getContent('plan.caption',true);
@endphp
@if($planCaption)
    @php
        $plans = \App\Plan::where('status', 1)->where('featured', 1)->latest()->get();
    @endphp


        <section class="investment-plan-area">
            <div class="container">
                <div class="row justify-content-center ">
                    <div class="col-10 text-center">
                        <div class="section-header mb-5">
                            <h2 class="title">{{__(@$planCaption->data_values->title)}} </h2>
                            <p class="section-para">{{__(@$planCaption->data_values->short_details)}}</p>
                        </div>
                    </div>
                </div>

                <div class="row">

                    @foreach($plans as $k => $data)
                        @php
                            $time_name = \App\TimeSetting::where('time', $data->times)->first();
                        @endphp
                        <div class="col-md-4">
                            <div class="plan-area">
                                <div class="plan-item">
                                    <div class="plan_name">{{$data->name}}</div>
                                    <div class="plan_day">{{__($data->interest)}} @if($data->interest_status == 1) % @else {{__($general->cur_text)}} @endif</div>
                                    <div class="plan_pr">
                                        {{__($time_name->name)}} / @if($data->lifetime_status == 0) {{__($data->repeat_time)}} @lang('Times') @else @lang('Lifetime') @endif
                                    </div>

                                    <div>
                                        <ul>

                                            @if($data->capital_back_status == 1)

                                                <li> <span class="badge badge-success">@lang('Capital Will Return Back')</span></li>
                                            @elseif($data->capital_back_status == 0)
                                                <li> <span class="badge badge-warning">@lang('Capital Will Store')</span></li>
                                            @endif
                                            <li>@lang('24/7Support')</li>
                                        </ul>
                                    </div>

                                    @if($data->fixed_amount == 0)
                                        <div class="plan_min "> @lang('Min.') {{__($general->cur_sym)}}{{__($data->minimum)}} <span>@lang('Max:') {{__($general->cur_sym)}}{{__($data->maximum)}}</span></div>

                                    @else
                                        <div class="plan_min "> <span class="color-transparent">&centerdot;</span> <span>@lang('Invest Amount'): {{__($general->cur_sym)}}{{__($data->maximum)}}</span></div>

                                    @endif


                                    <a href="#" data-toggle="modal" data-target="#depoModal" data-resource="{{$data}}"  class="btn btn-primary investButton">@lang('Invest Now')</a>
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
                            <h3 class="text-center investAmountRenge"></h3>

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

