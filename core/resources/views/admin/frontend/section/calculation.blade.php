@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{  route('admin.frontend.calculator.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Heading</label>
                                    <input type="text" class="form-control" placeholder="About Heading" name="title" value="{{ @$post->value->title }}" required/>
                                </div>
                                <div class="form-group">
                                    <label>Sub Heading</label>
                                    <input type="text" class="form-control" placeholder="About Sub Heading" name="sub_title" value="{{ @$post->value->sub_title }}" required/>
                                </div>


                            </div>
                        </div>

                    </div>


                    <div class="card-footer">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-block btn-primary mr-2">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

