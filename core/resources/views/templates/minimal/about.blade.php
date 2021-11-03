@extends(activeTemplate() .'layouts.master')

@section('content')
    @include(activeTemplate().'partials.frontend-breadcrumb')
    @include(activeTemplate().'partials.feature-section')


    @include(activeTemplate().'partials.about-section')


    @include(activeTemplate().'partials.counter-section')
    @include(activeTemplate().'partials.investor-section')
    @include(activeTemplate().'partials.statistics-section')






    @include(activeTemplate().'partials.client-say')


    @include(activeTemplate().'partials.section-blog')
    @include(activeTemplate().'partials.we-accept')
@endsection

@section('load-js')
<script src="{{asset('assets/templates/minimul/js/chart.js')}}"></script>
@stop
