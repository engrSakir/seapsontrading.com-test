@extends(activeTemplate().'layouts.user')
@section('title','')
@section('content')

    <div class="inner-banner-area">
        <div id="particles-js"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title"><span class="float-left">{{__($page_title)}}</span>


                    <a href="{{ route('user.ticket') }}" class="btn btn-success float-right">@lang('My Support Ticket')</a>
                    </h2>
                </div>

            </div>
        </div>
    </div>

    <div class="privacy-area mb-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="dashboard-content">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="dashboard-inner-content">


                                            <form  action="{{route('user.ticket.store')}}" role="form" method="post" enctype="multipart/form-data" id="recaptchaForm">
                                                {{csrf_field()}}
                                                <div class="row ">


                                                    <div class="form-group col-md-6">
                                                        <label for="name">@lang('Name')</label>
                                                        <input type="text"  name="name" value="{{$user->firstname . ' '.$user->lastname}}" class="form-control" placeholder="@lang('Enter Name')" required readonly>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="email">@lang('Email address')</label>
                                                        <input type="email"  name="email" value="{{$user->email}}" class="form-control " placeholder="@lang('Enter your Email')" required readonly>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="website">@lang('Subject')</label>
                                                        <input type="text" name="subject" value="{{old('subject')}}" class="form-control " placeholder="@lang('Subject')" >
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="hep">@lang('Department')</label>
                                                        <select class="form-control required" name="department" required>
                                                            @foreach($topics as $topic)
                                                                <option value="{{$topic->id}}">{{$topic->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="hep">@lang('Priority')</label>
                                                        <select class="form-control required" name="priority" required>
                                                            <option value="medium">@lang('Medium')</option>
                                                            <option value="high">@lang('High')</option>
                                                            <option value="low">@lang('Low')</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 form-group">
                                                        <label for="inputMessage">@lang('Message')</label>
                                                        <textarea name="message" id="inputMessage" rows="12" class="form-control">{{old('message')}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-sm-12">
                                                        <label for="inputAttachments">@lang('Attachments')</label>
                                                    </div>
                                                    <div class="col-sm-9 file-upload">
                                                        <input type="file" name="attachments[]" id="inputAttachments" class="form-control" />
                                                        <div id="fileUploadsContainer"></div>
                                                    </div>



                                                    <div class="col-sm-3">
                                                        <button type="button" class="btn btn-success" onclick="extraTicketAttachment()">
                                                            <i class="fa fa-plus"></i> @lang('Add More')
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-12 ticket-attachments-message text-muted">
                                                        @lang("Allowed File Extensions: .jpg, .jpeg, .png, .pdf, .doc, .docx")
                                                    </div>
                                                </div>

                                                <div class="row form-group justify-content-center">
                                                    <div class="col-md-8">
                                                        <button class="btn btn-success btn-lg" type="submit" id="recaptcha" ><i class="fa fa-paper-plane"></i>&nbsp;@lang('Submit Now')</button>

                                                        <button class=" btn btn-default website-color btn-round" type="button" onclick="formReset()">&nbsp;@lang('Cancel')</button>
                                                    </div>
                                                </div>
                                            </form>


                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="sec-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec"></div>
                </div>
            </div>
        </div>
    </div>


    @if($plugins[2]->status == 1)
        <script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
        @php echo recaptcha() @endphp
    @endif
@endsection


@section('script')
    <script>
        function extraTicketAttachment() {
            $("#fileUploadsContainer").append('<input type="file" name="attachments[]" class="form-control mt-1" required />')
        }
        function formReset() {
            window.location.href = "{{url()->current()}}"
        }
    </script>
@endsection
