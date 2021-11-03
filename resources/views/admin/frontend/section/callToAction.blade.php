@extends('admin.layouts.app')

@section('panel')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.frontend.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Heading</label>
                                    <input type="text" class="form-control" placeholder="Heading" name="title" value="{{ @$blog->value->title }}" required/>
                                </div>
                                <div class="form-group">
                                    <label>Sub Heading</label>
                                    <input type="text" class="form-control" placeholder="Sub Heading" name="short_details" value="{{ @$blog->value->short_details }}" required/>
                                </div>
                                <div class="form-group">
                                    <label>Button Link</label>
                                    <input type="text" class="form-control" placeholder="Button Link" name="btn_link" value="{{ @$blog->value->btn_link }}" required/>
                                </div>
                                <div class="form-group">
                                    <label>Button Name</label>
                                    <input type="text" class="form-control" placeholder="Button Name" name="btn_name" value="{{ @$blog->value->btn_name }}" required/>
                                </div>




                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-block btn-primary ">Update</button>


                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('breadcrumb-plugins')

@endpush

@push('script')


@endpush
