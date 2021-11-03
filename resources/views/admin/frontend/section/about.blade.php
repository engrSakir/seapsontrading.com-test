@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{  route('admin.frontend.about.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col-md-4">


                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview" style="background-image: url({{ asset('assets/images/frontend/'.@$post->value->about) }})">
                                                    <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                </div>

                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1" class="bg-primary">Image</label>
                                                <small class="mt-2 text-facebook">Supported files: <b>jpeg, jpg, png</b>. Image will be resized into <b>720X505 px</b> </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>About Heading</label>
                                    <input type="text" class="form-control" placeholder="About Heading" name="title" value="{{ @$post->value->title }}" required/>
                                </div>
                                <div class="form-group">
                                    <label>About Sub Heading</label>
                                    <input type="text" class="form-control" placeholder="About Sub Heading" name="sub_title" value="{{ @$post->value->sub_title }}" required/>
                                </div>

                                <div class="form-group">
                                    <label>About Content</label>
                                    <textarea rows="10" class="form-control nicEdit" placeholder="About description" name="details" required>{{ @$post->value->details }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Video Link</label>
                                    <input type="url" class="form-control" placeholder="Video Link" name="video_link" value="{{ @$post->value->video_link}}" required/>
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

