@php
    $calculationCaption = getContent('calculation.caption',true);
@endphp
@if($calculationCaption)
    @php
        $planList = \App\Plan::where('status', 1)->latest()->get();
    @endphp
<div class="profit-calc">
    <div class="shape"></div>
    <div class="circle-2" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
         data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{asset('assets/images/frontend/animation/08.png')}}" alt="shape">
    </div>
    <div class="circle-2 five" data-paroller-factor="-0.10" data-paroller-factor-lg="0.30"
         data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{asset('assets/images/frontend/animation/05.png')}}" alt="shape">
    </div>
    <div class="elepsis">
        <img src="{{asset('assets/images/frontend/footer/elepsis.png')}}" alt="profit">
    </div>
    <div class="man-coin">
        <img src="{{asset('assets/images/frontend/footer/man-coin.png')}}" alt="profit">
    </div>
    <div class="coin-only">
        <img src="{{asset('assets/images/frontend/footer/profit-coin.png')}}" alt="profit">
    </div>
    <div class="man-only">
        <img src="{{asset('assets/images/frontend/footer/profit-man.png')}}" alt="profit">
    </div>
    <div class="container">

        <div class="row justify-content-center ">
            <div class="col-10 text-center">
                <div class="section-header mb-5">
                    <h2 class="title">{{__(@$calculationCaption->data_values->title)}} </h2>
                    <p class="section-para">{{__(@$calculationCaption->data_values->sub_title)}}</p>
                </div>
            </div>
        </div>


        <form class="profit-form">
            <div class="row justify-content-center mb-30-none">
                <div class="form-group col-sm-6 col-md-4 col-lg-3">
                    <h6 class="profil-title">@lang('Plan')</h6>
                    <select class="select-bar" id="changePlan">
                        <option value="">@lang('Choose Plan')</option>
                        @foreach($planList as $k => $data)
                            <option value="{{$data->id}}" >{{$data->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-3">
                    <h6 class="profil-title">@lang('Invest Amount')</h6>
                    <input type="text" placeholder="0.00" class="invest-input"
                           onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-3">
                    <h6 class="profil-title">@lang('Profit')</h6>
                    <input type="text" placeholder="0.00" class="profit-input" readonly>
                    <code class="period"></code>
                </div>
            </div>
        </form>
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




@push('js')
    <script>

        (function ($) {
            "use strict";
            $(document).ready(function () {
                $("#changePlan").on('change', function () {
                    var planId = $("#changePlan option:selected").val();
                    var investInput = $('.invest-input').val();
                    var profitInput = $('.profit-input').val('');

                    $('.period').text('');

                    if (investInput != '' && planId != null) {
                        ajaxPlanCalc(planId, investInput)
                    }
                });

                $(".invest-input").on('change', function () {
                    var planId = $("#changePlan option:selected").val();
                    var investInput = $(this).val();
                    var profitInput = $('.profit-input').val('');
                    $('.period').text('');
                    if (investInput != '' && planId != null) {
                        ajaxPlanCalc(planId, investInput)
                    }
                });
            });
        })(jQuery);

        function ajaxPlanCalc(planId, investInput) {
            $.ajax({
                url: "{{route('planCalculator')}}",
                type: "post",
                data: {
                    planId,
                    investInput
                },
                success: function (response) {

                    var alertStatus = "{{$general->alert}}";
                    if (response.errors) {
                        if (alertStatus == '1') {
                            iziToast.error({message: response.errors, position: "topRight"});
                        } else if (alertStatus == '2') {
                            toastr.error(response.errors);
                        }
                    }

                    console.log(response);

                    $('.profit-input').val(response.interest_amount);
                    $('.period').text(response.interestValidity);


                }
            });
        }
    </script>
@endpush
