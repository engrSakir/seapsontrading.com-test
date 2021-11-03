@extends(activeTemplate() .'layouts.master')



@section('content')


    <div class="inner-banner-area">
        <div id="particles-js"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="title"><span>{{__($page_title)}}</span></h1>
                </div>
            </div>
        </div>
    </div>
    @if($sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            @include(activeTemplate().'partials.'.$sec)
        @endforeach
    @endif

@endsection

@section('load-js')
    <script src="{{asset('assets/templates/minimul/js/chart.js')}}"></script>
@stop

