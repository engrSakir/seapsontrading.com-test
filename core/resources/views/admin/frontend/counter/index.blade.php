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
                                    <label>Title</label>
                                    <input type="text" class="form-control" placeholder="Title" name="title" value="{{ @$blog->value->title }}" required/>
                                </div>
                                <div class="form-group">
                                    <label>Short Details</label>
                                    <input type="text" class="form-control" placeholder="Short Details" name="short_details" value="{{ @$blog->value->short_details }}" required/>
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


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive table-responsive-xl">
                    <table class="table align-items-center table-light">
                        <thead>
                        <tr>
                            <th scope="col">Icon</th>
                            <th scope="col">Title</th>
                            <th scope="col">Sub Title</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @forelse($howItWorks as $testi)
                            <tr>
                                <td scope="row">
                                    <div class="media align-items-center">
                                        <?php echo @$testi->value->icon ?>


                                    </div>
                                </td>
                                <td>{{ @$testi->value->title }}</td>
                                <td>{{ @$testi->value->subtitle }}</td>
                                <td>

                                    <button class="btn btn-primary updateBtn"  data-route="{{ route('admin.frontend.update', $testi->id) }}"  data-id="{{ $testi->id }}" data-title="{{ $testi->value->title}}" data-subtitle="{{ $testi->value->subtitle}}" data-counter_digit="{{ @$testi->value->counter_digit}}"   data-icon="{{ $testi->value->icon}}"><i class="fa fa-pencil"></i></button>

                                    <button class="btn btn-danger removeBtn" data-id="{{ $testi->id }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        {{ $howItWorks->links() }}
                    </nav>
                </div>

            </div>
        </div>
    </div>



    {{-- Add METHOD MODAL --}}
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.frontend.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="key" value="counter">

                        <div class="form-group">
                            <label>Title  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Title" value="{{ old('title') }}" name="title" required />
                        </div>
                        <div class="form-group">
                            <label>Number / Digit  <span class="text-danger">*</span></label>
                            <input type="number" min="0" class="form-control" placeholder="Counter Digit" value="{{ old('counter_digit') }}" name="counter_digit" required />
                        </div>

                        <div class="form-group">
                            <label>Sub Title  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Sub title" value="{{ old('subtitle') }}" name="subtitle" required />
                        </div>

                        <div class="form-group">
                            <label>Icon</label>
                            <div class="input-group has_append">
                                <input type="text" class="form-control" name="icon" required>

                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary iconPicker" data-icon="fas fa-home" role="iconpicker"></button>
                                </div>
                            </div>

                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Update METHOD MODAL --}}
    <div id="updateBtn" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Update </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" class="edit-route" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">


                        <div class="form-group">
                            <label> Title</label>
                            <input type="text" class="form-control form-control-lg" name="title" value="{{old('title')}}" required placeholder="Title">
                        </div>


                        <div class="form-group">
                            <label>Number / Digit  <span class="text-danger">*</span></label>
                            <input type="number" min="0" class="form-control" placeholder="Counter Digit" value="{{ old('counter_digit') }}" name="counter_digit" required />
                        </div>

                        <div class="form-group">
                            <label>Sub Title  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Sub title" value="{{ old('subtitle') }}" name="subtitle" required />
                        </div>


                        <div class="form-group">
                            <label>Icon</label>
                            <div class="input-group has_append">
                                <input type="text" class="form-control" name="icon" required>

                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary iconPicker" data-icon="fas fa-home" role="iconpicker"></button>
                                </div>
                            </div>

                        </div>



                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{-- REMOVE METHOD MODAL --}}
    <div id="removeModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Removal Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.frontend.remove') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>Are you sure to remove this post?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Remove</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



@push('breadcrumb-plugins')
    <a href="javascript:void(0)" class="btn btn-success addBtn"><i class="fa fa-fw fa-plus"></i>Add New</a>
@endpush



@push('style-lib')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-iconpicker.min.css') }}">
@endpush
@push('script-lib')
    <script src="{{ asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
@endpush


@push('script')

    <script>
        $('.removeBtn').on('click', function() {
            var modal = $('#removeModal');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });

        $('.addBtn').on('click', function() {
            var modal = $('#addModal');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('input[name=icon]').val($(this).data('icon'));
            modal.find('input[name=short_details]').val($(this).data('short_details'));
            modal.modal('show');
        });


        $('.updateBtn').on('click', function() {
            var modal = $('#updateBtn');
            modal.find('.edit-route').attr('action',$(this).data('route'));

            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('input[name=title]').val($(this).data('title'));
            modal.find('input[name=subtitle]').val($(this).data('subtitle'));
            modal.find('input[name=counter_digit]').val($(this).data('counter_digit'));

            modal.find('input[name=icon]').val($(this).data('icon'));
            modal.modal('show');
        });

    $('#updateBtn').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });
    $('#addModal').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });
    
        $('.iconPicker').iconpicker({
            align: 'center', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-left',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: 10,
            footer: true,
            header: true,
            icon: 'fas fa-bomb',
            iconset: 'fontawesome5',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom', // Only in button tag
            rows: 5,
            search: false,
            searchText: 'Search icon',
            selectedClass: 'btn-success',
            unselectedClass: ''
        }).on('change', function(e){
            $(this).parent().siblings('input[name=icon]').val(`<i class="${e.icon}"></i>`);
        });
    </script>

@endpush

