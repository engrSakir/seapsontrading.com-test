@extends('admin.layouts.app')

@section('panel')


    <div class="row">

        <div class="col-md-12">
            <div class="card">


                <div class="card-body">

                    <form method="post" class="form-horizontal" action="{{route('admin.plan-store')}}">
                        @csrf

                        <div class="form-body">

                            <div class="form-row">

                                <div class="form-group col-md-3">
                                    <strong>Plan Name</strong>
                                    <input type="text" class="form-control" name="name" required>
                                </div>


                                <div class="form-group col-md-3">
                                    <strong>Amount Type</strong>
                                    <input data-toggle="toggle" id="amount" class="amount" data-onstyle="success"  data-offstyle="info" data-on="Fixed" data-off="Range" data-width="100%" type="checkbox" name="amount_type" >
                                </div>

                                <div class="form-group offman col-md-3">
                                    <strong>Minimum Amount</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="minimum">
                                        <div class="input-group-append">
                                            <div class="input-group-text">{{$general->cur_sym}}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group offman col-md-3" >
                                    <strong>Maximum Amount</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="maximum">
                                        <div class="input-group-append">
                                            <div class="input-group-text">{{$general->cur_sym}}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group onman col-md-3" style="display: none">
                                    <strong> Amount</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="amount">
                                        <div class="input-group-append">
                                            <div class="input-group-text">{{$general->cur_sym}}</div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-md-3">
                                    <strong>Return /Interest</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="interest"  required>
                                        <div class="input-group-append" style="height: 45px">
                                            <div class="input-group-text">
                                                <select name="interest_status" class="form-control" style="height: 35px !important;">
                                                    <option value="%">%</option>
                                                    <option value="{{$general->cur_sym}}">{{$general->cur_sym}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <strong>Every</strong>
                                    <select class="form-control" name="times">
                                        @foreach($time as $data)
                                            <option value="{{$data->time}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <strong>Return For</strong>
                                    <input data-toggle="toggle" id="lifetime" class="lifetime" data-onstyle="success"  data-offstyle="danger" data-on="Period" data-off="Lifetime" data-width="100%" type="checkbox" name="lifetime_status" >
                                </div>


                                <div class="form-group return col-md-3" style="display: none">
                                    <div class="form-group">
                                        <strong>How Many Times</strong>
                                        <input type="text" class="form-control" name="repeat_time">
                                    </div>
                                </div>

                                <div class="form-group col-md-3" id="capitalBack">
                                    <strong>Capital Back</strong>
                                    <input data-toggle="toggle" data-onstyle="success"  data-offstyle="danger" data-on="Yes" data-off="No" data-width="100%" type="checkbox" name="capital_back_status" >
                                </div>


                                <div class="form-group col-md-3" >
                                    <strong>Status</strong>
                                    <input data-toggle="toggle" data-onstyle="success"  data-offstyle="danger"
                                           data-on="Active" data-off="Disable" data-width="100%" type="checkbox" name="status" >
                                </div>

                                <div class="form-group col-md-3" >
                                    <strong>Featured</strong>
                                    <input data-toggle="toggle" data-onstyle="success"  data-offstyle="danger"
                                           data-on="Yes" data-off="No" data-width="100%" type="checkbox" name="featured" >
                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">

                            <button type="submit" class="btn btn-primary btn-block">Save</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection

@push('breadcrumb-plugins')
    <a href="{{route('admin.plan-setting')}}"  class="btn btn-success"><i class="fa fa-fw fa-eye"></i>Plan List</a>
@endpush

@push('script')
    <script>
        $(document).ready(function () {
            $('#amount').on('change', function () {
                var isCheck = $(this).prop('checked');
                if (isCheck == false)
                {
                    $('.offman').css('display', 'block');
                    $('.onman').css('display', 'none');
                }else {
                    $('.offman').css('display', 'none');
                    $('.onman').css('display', 'block');
                }
            });

            $('#lifetime').on('change', function () {
                var isCheck = $(this).prop('checked');
                if (isCheck == true)
                {
                    $('.return').css('display', 'block');
                }else {
                    $('.return').css('display', 'none');

                }
            });

        })
    </script>
@endpush
