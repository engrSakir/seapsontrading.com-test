@extends(activeTemplate() .'layouts.user')

@section('script')
 <script>
       $('#myModal123').modal('show');
    </script>
@endsection
@section('content')

    <div class="inner-banner-area">
        <div id="particles-js"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="title"><span>@lang('Welcome,')</span> {{Auth::user()->username}} !</h3>
                </div>
                <div class="col-lg-6">
                    <div class="banner-form-group">
                        <div class="input-group">
                            <input type="text" name="text" class="form-control" id="referralURL" value="{{route('refer.register',[Auth::user()->username])}}" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text copytext" id="copyBoard" onclick="myFunction()"> <i class="fa fa-copy"></i> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
  <div class="modal fade" id="myModal123" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
      <div class="modal-content" style="background:white;">
        <div class="modal-header">
          <h4 class="modal-title" style="color:black;float:left;">Notification</h4>
        </div>
        <div class="modal-body" >
            
            <!-- Here you can edit the Notification text  (Developed by joinnoorabbasi) -->
            
          <p style="color:black;">UPDATE COMING UP SOON </p>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" style="background:black;color:white;">Close</button>
        </div>
      </div>
      
    </div>
  </div>

    <div class="privacy-area pb-130">
        <div class="container">
            <div class="row mb-30-none">
                @foreach($authWallets as $data)

                <div class="col-lg-4 col-md-6 col-sm-8 mb-30">
                    <div class="privacy-item">
                        <h3 class="title">{{__(str_replace('_',' ',strtoupper($data->type)))}}</h3>
                        <span class="total-amount">{{$general->cur_sym}}{{formatter_money($data->balance)}}</span>
                        @if($data->type == 'deposit_wallet')
                        <a href="{{route('user.deposit.history')}}" class="privacy-btn">@lang('View Report')</a>
                        @elseif($data->type == 'current_interest')
                            <a href="{{route('user.referral')}}" class="privacy-btn">@lang('')</a>
                        @endif
                    </div>
                </div>
                @endforeach

                <div class="col-lg-4 col-md-6 col-sm-8 mb-30">
                    <div class="privacy-item">
                        <h3 class="title">@lang('CURRENT INVESTMENT')</h3>
                        <span class="total-amount">{{$general->cur_sym}}{{formatter_money($totalInvest)}}</span>
                        <a href="{{route('user.interest.log')}}" class="privacy-btn">@lang('View Report')</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-8 mb-30">
                    <div class="privacy-item">
                        <h3 class="title">@lang("Total Withdraw")</h3>
                        <span class="total-amount">{{$general->cur_sym}}{{formatter_money($totalWithdraw)}}</span>
                        <a href="{{route('user.withdrawLog')}}" class="privacy-btn">@lang('View Report')</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-8 mb-30">
                    <div class="privacy-item">
                        <h3 class="title">@lang('Total Deposit')</h3>
                        <span class="total-amount">{{$general->cur_sym}}{{formatter_money($totalDeposit)}}</span>
                        <a href="{{route('user.deposit.history')}}" class="privacy-btn">@lang('View Report')</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-8 mb-30">
                    <div class="privacy-item">
                        <h3 class="title">@lang('Total Ticket')</h3>
                        <span class="total-amount">{{$general->cur_sym}}{{$totalTicket}}</span>
                        <a href="{{route('user.ticket')}}" class="privacy-btn">@lang('View Report')</a>
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
@endsection


@section('script')
    <script>
        function myFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/
            document.execCommand("copy");
            var alertStatus = "{{$general->alert}}";
            if(alertStatus == '1'){
                iziToast.success({message:"Copied: "+copyText.value, position: "topRight"});
            }else if(alertStatus == '2'){
                toastr.success("Copied: " + copyText.value);
            }
        }
    </script>
    
   
@endsection
