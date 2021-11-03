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
        font-size: 40px;
        border: 2px striped #{{$general->bclr}};
        color: #{{$general->bclr}};
    }
    .login-area .login-form .frm-grp input {
        padding:inherit;
    }
    .pincode-input-text, .form-control.pincode-input-text {
        width: 46px;
        height: 46px !important;
    }
</style>
@stop
@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <form action="{{ route('user.password.verify-code') }}" method="POST" class="login-form">
                @csrf
                <h2 class="text-center text-white pb-4 text-uppercase"> {{$page_title}}</h2>
                <input type="hidden" name="email" value="{{ $email }}">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <div class="form-group">
                            <p class="pb-3">@lang('Verification Code'):</p>
                            <input type="text" name="code" id="pincode-input" class="magic-label form-control">
                        </div>
                        <div class="form-group pt-5">
                            <button type="submit" class="btn btn-default website-color">@lang('Verify Code')</button>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mt-5">
                        @lang('Please check including your Junk/Spam Folder. if not found, you can ') 
                        <a href="{{ route('user.password.request') }}">@lang('Try to send again')</a>
                    </div>
                </div>
            </form>
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