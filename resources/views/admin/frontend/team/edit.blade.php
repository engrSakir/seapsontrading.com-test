@extends('admin.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.frontend.update', $testi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview" style="background-image: url({{ get_image(config('constants.frontend.team.path') .'/'. $testi->value->image) }})">
                                                    <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image_input" id="profilePicUpload1" accept=".png">
                                                <label for="profilePicUpload1" class="bg-primary">Upload Image</label>
                                                <small class="mt-2 text-facebook">Supported files: <b>png,</b>. Image will be resized into <b>{{ Config::get('constants.frontend.team.size') }}px</b> </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">

                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Name" value="{{ @$testi->value->name }}" name="name" required />
                                </div>

                                <div class="form-group">
                                    <label>Designation <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Designation" value="{{@$testi->value->designation}}" name="designation" required />
                                </div>

                                <div class="form-group">
                                    <label>Facebook <span class="text-danger">*</span></label>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-facebook"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Facebook" value="{{@$testi->value->facebook}}" name="facebook" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Twitter <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-twitter"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Twitter" value="{{@$testi->value->twitter}}" name="twitter" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pinterest <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-pinterest-p"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Pinterest" value="{{@$testi->value->pinterest}}" name="pinterest" required />
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-block btn-primary mr-2">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.frontend.team.index') }}" class="btn btn-dark" ><i class="fa fa-fw fa-reply"></i>Back</a>
@endpush
