@extends('admin.layouts.app')

@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="row justify-content-between">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{$pdata->name}} Page</h3>

                                <small class="text-info">After Click Remove button If you face any problem then click update button and remove unnecessary  content from pages</small>
                            </div>

                            <div class="card-body">
                                <form action="{{route('admin.frontend.manage.section.update',$pdata->id)}}" method="post">
                                    @csrf

                                    <ol class="simple_with_drop vertical sec-item">

                                        @if($pdata->secs != null)
                                        @foreach(json_decode($pdata->secs) as $sec)


                                        <li class="highlight icon-move">
                                            <i class=" fa fa-arrows-alt"></i>

                                            <span class="d-inline-block mr-auto ml-2"> {{ $sections[$sec]}}</span>



                                            <i class="ml-auto d-inline-block remove-icon fa fa-times"></i>
                                            <input type="hidden" name="secs[]" value="{{$sec}}">

                                        </li>

                                        @endforeach
                                        @endif

                                    </ol>

                                    <button type="submit" class="btn btn-primary">Update Now</button>

                                </form>

                            </div>
                        </div>



                    </div>

                    <div class="col-4">

                        <div class="card">
                            <h3 class="card-header">Sections</h3>
                            <div class="card-body">

                                <ol class="simple_with_no_drop vertical">
                                    @foreach($sections as $k => $secs)
                                    <li class="highlight icon-move">
                                        <i class=" fa fa-arrows-alt"></i>

                                        <span class="d-inline-block mr-auto ml-2"> {{$secs}}</span>
                                        <i class="ml-auto d-inline-block remove-icon fa fa-times"></i>
                                        <input type="hidden" name="secs[]" value="{{$k}}">

                                    </li>

                                    @endforeach

                                </ol>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection


@push('script-lib')
    <script src="{{asset('assets/admin/js/jquery-sortable.js')}}"></script>
@endpush

@push('script')
    <script>
        $(function  () {
            $("ol.simple_with_drop").sortable({
                group: 'no-drop',
                handle: '.icon-move',
                onDragStart: function ($item, container, _super) {
                    // Duplicate items of the no drop area
                    if(!container.options.drop)
                        $item.clone().insertAfter($item);
                    _super($item, container);
                }
            });
            $("ol.simple_with_no_drop").sortable({
                group: 'no-drop',
                drop: false
            });
            $("ol.simple_with_no_drag").sortable({
                group: 'no-drop',
                drag: false
            });

            $(".remove-icon").on('click',function(){
                $(this).parent('.highlight').remove();
            });

        });
    </script>
@endpush


@push('breadcrumb-plugins')
    <a href="{{route('admin.frontend.manage.pages')}}" class="btn btn-success "><i class="fa fa-fw fa-backward"></i>Go Back</a>
@endpush

@push('style')
   <style>
        .span4 {
            width: 300px; }

        ol li.highlight {
            background: #000;
            color: #999999;
        }

        ol.vertical {
            margin: 0 0 9px 0;
            min-height: 10px;
        }
        li {
            line-height: 18px;
        }

        .icon-move {
            background-position: -168px -72px;
        }
        ol i.icon-move {
            cursor: pointer;
        }

        ol {
            display: block;
            list-style-type: decimal;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
        }
        .vertical li i {
            color: #2ecc71;
            padding-right: 15px;
        }

        .sec-item li i {
            color: #000;
            padding-right: 15px;
        }

        .sec-item li i.fa-times{
            color: #ff0000;
            padding-right: 15px;
        }

        ol.vertical li {
            display: block;
            margin: 10px 0;
            padding: 10px;
            color: #e0e0e0;
            background: #000036;
            font-size: 16px;
            font-weight: 600;
        }


        ol.sec-item li {
            margin: 10px 0;
            padding: 10px;
            color: #fff;
            background: #2ecc71;
            font-size: 24px;
            font-weight: 600;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }
        .ol.sec-item li.d-none {
            display: none !important;}
        [class*="span"] {
            float: left;
            margin-left: 20px;
        }

        .row {
            margin-left: -20px;
            *zoom: 1;
        }
        .row {
            position: relative;
        }
        .dragged {
             position: absolute;
             top: 0;
             opacity: 0.5;
             z-index: 2000;
            background: #333333;
            color: #999999;
         }

        ol.vertical li i.remove-icon{
            display: none !important;
        }

        ol.sec-item li i.remove-icon{
            display: block !important;
        }

    </style>
@endpush
