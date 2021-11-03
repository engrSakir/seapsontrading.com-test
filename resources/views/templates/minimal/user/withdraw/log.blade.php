@extends(activeTemplate() .'layouts.user')

@section('content')

    @include(activeTemplate().'partials.breadcrumb')
    <!-- ========User-Panel-Section Starte Here ========-->
    <section class="user-panel-section padding-bottom padding-top">
        <div class="container user-panel-container">
            <div class=" user-panel-tab">
                <div class="row">
                    @include(activeTemplate().'partials.sidebar')

                    <div class="col-lg-9">
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


                                <div class="row mb-60-80">
                                    <div class="col-md-12 mb-30">
                                        <div class="table-responsive table-responsive-xl table-responsive-lg table-responsive-md table-responsive-sm">
                                            <table class="table table-striped">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">@lang('Transaction ID')</th>
                                                    <th scope="col">@lang('Gateway')</th>
                                                    <th scope="col">@lang('Amount')</th>
                                                    <th scope="col">@lang('Status')</th>
                                                    <th scope="col">@lang('Time')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(count($withdraws) >0)
                                                    @foreach($withdraws as $k=>$data)
                                                        <tr>
                                                            <td data-label="#@lang('Trx')">{{$data->trx}}</td>
                                                            <td data-label="@lang('Gateway')">{{ $data->method->name   }}</td>
                                                            <td data-label="@lang('Amount')">
                                                                <strong>{{formatter_money($data->amount)}} {{$general->cur_text}}</strong>
                                                            </td>
                                                            <td data-label="@lang('Status')">
                                                                @if($data->status == 0)
                                                                    <span class="badge badge-warning">@lang('Pending')</span>
                                                                @elseif($data->status == 1)
                                                                    <span class="badge badge-success">@lang('Completed')</span>
                                                                @elseif($data->status == 2)
                                                                    <span class="badge badge-danger">@lang('Rejected')</span>
                                                                @endif

                                                            </td>
                                                            <td data-label="@lang('Time')">
                                                                <i class="fa fa-calendar"></i> {{date('d M, Y ', strtotime($data->created_at))}}
                                                                <span class="pl-1"></span> {{date('h:i A', strtotime($data->created_at))}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4"> @lang('No results found')!</td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>

                                        {{$withdraws->links()}}
                                    </div>
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


@section('load-js')
@stop
@section('script')
@stop
