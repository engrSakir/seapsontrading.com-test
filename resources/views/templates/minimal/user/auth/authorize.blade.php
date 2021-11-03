@extends(activeTemplate() .'layouts.master')
@section('style')
<style>

    .pincode-input-container{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .pincode-input-container .pincode-input-text {
        /*margin-left: 5px;*/
        text-align: center;
        font-weight: 600;
        font-size: 48px;
        border: 2px solid #000036;
        color: #{{$general->bclr}};
    }
    .login-area .login-form .frm-grp input {
        padding:inherit;
    }
    .pincode-input-text, .form-control.pincode-input-text {
        width: 60px;
        height: 60px !important;
    }
</style>
@stop
@section('content')

@if(!$user->status)
@include(activeTemplate().'partials.frontend-breadcrumb')
<div class="account--section sign-in-section active relative">
    <div class="container-fluid">
        <div class="account--area">
            <h1 class="title text-center text-danger">{{__($page_title)}}</h1>
        </div>
    </div>
</div>

@elseif(!$user->ev)
@include(activeTemplate().'partials.frontend-breadcrumb')

<section class="user-panel-section padding-bottom padding-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <form method="POST" action="{{route('user.verify_email')}}" >
                    @csrf
                    <h4 class="text-center py-5"> @lang('Please Verify Your Email to Get Access')</h4>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-form-label">@lang('Your Email Address')</label>
                        <input type="email" name="email" class="form-control form-control-lg" readonly value="{{auth()->user()->email}}">
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-form-label">@lang('Enter Verification Code')</label>
                        <br>
                        <input  name="email_verified_code"  id="pincode-input" placeholder="@lang('Code')" class="form-control form-control-lg">
                        @if ($errors->has('email_verified_code'))
                        <small class="text-danger">{{ $errors->first('email_verified_code') }}</small>
                        @endif
                    </div>
                    <div class="form-group ">
                        <button type="submit" class="custom-button bg-3  text-center mt-3">
                            @lang('Submit')
                        </button>
                    </div>
                    <div class="form-group">
                        <div class="remember mr-5">
                            <label class="form-check-label" for="gridCheck1">
                                @lang('Please check including your Junk/Spam Folder. if not found, you can ') <a href="{{route('user.send_verify_code')}}?type=email"> @lang('Resend code again')</a> !
                                @if ($errors->has('resend'))
                                <br/>
                                <small class="text-danger">{{ $errors->first('resend') }}</small>
                                @endif
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


@elseif(!$user->sv)

@include(activeTemplate().'partials.frontend-breadcrumb')


<section class="user-panel-section padding-bottom padding-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <form method="POST" action="{{route('user.verify_sms')}}" >
                    @csrf
                    <h2 class="text-center text-white pb-4 text-uppercase"> @lang($page_title)</h2>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-form-label">@lang('Your Mobile Number')</label>
                        <input type="text" name="mobile" class="form-control" readonly value="{{auth()->user()->mobile}}">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-form-label">@lang('Enter Code')</label>
                        <input  name="sms_verified_code"  id="pincode-input" placeholder="@lang('Code')" class="form-control form-control-lg">
                        @if ($errors->has('sms_verified_code'))
                        <small class="text-danger">{{ $errors->first('sms_verified_code') }}</small>
                        @endif
                    </div>
                    <div class="form-group ">
                        <button type="submit" class="custom-button bg-3  text-center mt-3">
                            @lang('Submit')
                        </button>
                    </div>
                    <div class="form-group">

                        <div class="remember mr-5">
                            <label class="form-check-label" for="gridCheck1">
                                @lang('No code on your phone Yet ?') <a  href="{{route('user.send_verify_code')}}?type=phone"> @lang('Resend code')</a>
                                @if ($errors->has('resend'))
                                <br/>
                                <small class="text-danger">{{ $errors->first('resend') }}</small>
                                @endif

                            </label>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

@elseif(!$user->tv)

@include(activeTemplate().'partials.frontend-breadcrumb')


<section class="user-panel-section padding-bottom padding-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <form method="POST"  action="{{route('user.go2fa.verify') }}" >
                    @csrf

                    <h2 class="text-center pb-4 text-uppercase"> @lang('2FA Verification')</h2>
                    <strong> @lang('Current Time'): {{\Carbon\Carbon::now()}}</strong>

                    <div class="form-group pt-3">
                        <label for="inputEmail3" class="col-form-label">@lang('Google Authenticator Code')</label>
                        <input  name="code" id="pincode-input" placeholder="@lang('Enter Google Authenticator Code')" class="form-control">
                        @if ($errors->has('code'))
                        <small class="text-danger">{{ $errors->first('code') }}</small>
                        @endif
                    </div>


                    <div class="form-group ">
                        <button type="submit" class="custom-button bg-3  text-center mt-3">
                            @lang('Submit')
                        </button>
                    </div>

                </form>
            </div>
        </div>


    </div>
</section>

@else
<script>
    window.location.href = "{{route('user.home')}}";
</script>
@endif
@endsection



@push('style-lib')
<link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-pincode-input.css') }}"/>
@endpush

@push('js')
<script src="{{ asset('assets/admin/js/bootstrap-pincode-input.js') }}"></script>
@endpush


@push('js')
<script>
    $('#pincode-input').pincodeInput({
        inputs:6,
        placeholder:"- - - - - -",
        hidedigits:false
    });
</script>    
@endpush