@extends('admin.layouts.app')

@section('panel')


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive table-responsive-xl">
                    <table class="table align-items-center table-light">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @forelse($pdata as $k => $data)
                            <tr>

                                <td>{{ $data->name }}</td>
                                <td>{{ $data->slug }}</td>
                                <td>

                                    <a href="{{ route('admin.frontend.manage.section', $data->id) }}" class="btn btn-rounded btn-dark text-white"><i class="fa fa-fw fa-file"></i></a>

                                    @if($data->slug != 'home')
                                    <button class="btn btn-primary updateBtn" data-id="{{ $data->id }}" data-name="{{ $data->name }}" data-slug="{{ $data->slug }}"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger removeBtn" data-id="{{ $data->id }}"><i class="fa fa-trash"></i></button>
                                        @endif

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
            </div>
        </div>
    </div>

    {{-- Add METHOD MODAL --}}
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Add New Pages</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.frontend.manage.pages.save')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label> Page Name</label>
                            <input type="text" class="form-control form-control-lg" name="name" value="{{old('name')}}" required>
                        </div>

                        <div class="form-group">
                            <label> Slug </label>
                            <input type="text" class="form-control form-control-lg" name="slug" value="{{old('slug')}}" required>
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
                    <h5 class="modal-title"> Update Pages</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.frontend.manage.pages.update')}}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="modal-body">

                        <input type="hidden" class="form-control form-control-lg" name="id" value="">
                        <div class="form-group">
                            <label> Page Name</label>
                            <input type="text" class="form-control form-control-lg" name="name" value="{{old('name')}}" required>
                        </div>
                        <div class="form-group">
                            <label> Slug </label>
                            <input type="text" class="form-control form-control-lg" name="slug" value="{{old('slug')}}" required>
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
                <form action="{{ route('admin.frontend.manage.pages.delete') }}" method="POST">
                    @csrf
                    @method('delete')
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

@push('script')

    <script>
        $('.removeBtn').on('click', function() {
            var modal = $('#removeModal');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });

        $('.addBtn').on('click', function() {
            var modal = $('#addModal');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });


        $('.updateBtn').on('click', function() {
            var modal = $('#updateBtn');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.find('input[name=name]').val($(this).data('name'));
            modal.find('input[name=slug]').val($(this).data('slug'));
            modal.modal('show');
        });


    </script>

@endpush
