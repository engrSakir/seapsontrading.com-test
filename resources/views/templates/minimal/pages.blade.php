@extends(activeTemplate() .'layouts.master')

@section('content')
    @include(activeTemplate().'partials.frontend-breadcrumb')

    @if($sections->secs != null)
    @foreach(json_decode($sections->secs) as $sec)
        @include(activeTemplate().'partials.'.$sec)
    @endforeach
    @endif

@endsection

@section('load-js')
<script src="{{asset('assets/templates/minimul/js/chart.js')}}"></script>
@stop
