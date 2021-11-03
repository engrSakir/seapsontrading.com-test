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

    @include(activeTemplate().'partials.frontend-breadcrumb')
    <section class="padding-bottom padding-top">
        <div class="container">
            <div class="row justify-content-center">
                                    <div class="col-md-6 text-center">
                                        <form action="{{ route('user.password.verify-code') }}" method="POST" >
                                            @csrf

                                            <h2 class="text-center text-white pb-4 text-uppercase"> @lang($page_title)</h2>

                                            <input type="hidden" name="email" value="{{ $email }}">

                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-form-label">@lang('Verification Code')</label>
                                                <input type="text" name="code" id="pincode-input" class="magic-label form-control">
                                            </div>


                                            <div class="form-group ">
                                                <button type="submit" class="custom-button bg-3  text-center mt-3">
                                                    @lang('Verify Code')
                                                </button>
                                            </div>

                                            <div class="form-group">
                                              @lang('Please check including your Junk/Spam Folder. if not found, you can ') <a href="{{ route('user.password.request') }}">@lang('Try to send again')</a>
                                            </div>

                                        </form>
                                    </div>
                                </div>


                            </div>

    </section>

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