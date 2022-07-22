@extends('backend.master')
@section('main')
    <div class="page-header">
        <div class="row m-l-5">
            <div class="col-sm-12 mt-5">
                <h3 class="page-title mt-3">Hotel Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Category</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="col-md-12 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h4 class="card-title float-left mt-2">All Category</h4>
                <button type="button" class="btn btn-primary float-right veiwbutton" data-toggle="modal"
                    data-target=".bd-example-modal-lg">
                    <span class="fas fa-spinner fa-spin"></span> Add New Category
                </button>
            </div>
            <div class="card-body" id="show_all_category">
                {{-- <h2 class="text-center my-5">loading....</h2> --}}
                <div class="table-responsive">
                    <table id="myTable" class="table table-hover table-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                                <tr class="post{{ $item->id }}">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ substr_replace($item->category_name, '...', 15) }}</td>

                                    <td><img style="width: 200px ; height:100px"
                                            src="{{ asset('backend/images/category/' . $item->category_image) }}"
                                            alt="category image" srcset="">
                                    </td>

                                    <td>{!! html_entity_decode(substr_replace($item->description, '...', 20)) !!}</td>
                                    <td style="display: flex;">
                                        <button type="button" value="{{ $item->id }}"
                                            class=" edit-button btn btn-sm btn-primary mr-2" data-toggle="modal"
                                            data-target=".bd-example-modal-lg-edit">Edit</button>
                                        <form action="{{ route('category.destroy', $item->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn delete btn-sm btn-danger" data-id="{{ $item->id }}">
                                                <i class="fa fa-trash"></i>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $categories->links() }} --}}
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Category </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <form action="{{ route('category.store') }}" method="POST" id="upload_form"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row formtype">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input class="form-control" type="text" name="category_name"
                                            placeholder="BKG-0001">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea id="summernote" class="form-control" rows="8" id="comment" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>File Upload</label>
                                        <div class="custom-file mb-3">
                                            <input type="file" class="custom-file-input" id="file-input" multiple
                                                name="category_image">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        <div id="thumb-output"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End Modal --}}
    {{-- edit modal --}}
    {{-- Modal --}}
    <div class="modal fade bd-example-modal-lg-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <ul id="save_msgList">

                        </ul>
                        <form method="POST" id="update_form" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="cat_id" id="cat_id">
                            <div class="row formtype">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input class="form-control" type="text" id="category_name"
                                            name="category_name" placeholder="BKG-0001">
                                        <span class="text-danger" id="category_name_error"></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea id="summernoteTwo" class="form-control" rows="8" id="description" name="description"></textarea>
                                        <span class="text-danger" id="description_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>File Upload</label>
                                        <div class="custom-file mb-3">
                                            <input type="file" class="custom-file-input ok" id="file-inputTwo"
                                                multiple name="category_image">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        <div class="d-flex">
                                            <div id="thumb-outputTwo"></div>
                                            <div id="thumb-previous"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" id="submitButton" class="btn btn-sm btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end edit modal --}}
@endsection
@section('backend_script')
    <script>
        $(document).ready(function() {
            // edit
            $('.edit-button').click(function(e) {
                e.preventDefault();
                var id = $(this).val();
                //  alert(id);
                $.ajax({
                    type: "get",
                    url: 'category/' + id + '/edit',
                    success: function(response) {
                        // console.log(response);
                        $('#category_name').val(response.category_name);
                        $('#cat_id').val(response.id);
                        $('#description').val(response.description);
                        // $('.ok').val(response.category_image);
                        $('#thumb-previous').html(
                            ' <img style="width:100px;height:100px" src="backend/images/category/' +
                            response.category_image + '" >');
                    }
                });
            });
            // update
            $('#update_form').on('submit', function(e) {
                e.preventDefault();
                var id = $('#cat_id').val();
                // alert(id);
                $('#submitButton').text('Updating...')
                $('#submitButton').html('<span class="fas fa-spinner fa-spin"></span>')
                $.ajax({
                    type: "POST",
                    url: 'category/' + id,
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {

                        // console.log(response);

                        if (response.status == 200) {
                            $('.bd-example-modal-lg-edit').modal('hide');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Category Updated successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            })

                            location.reload();
                        } else {
                            $('#save_msgList').html("");
                            $('#save_msgList').addClass('alert alert-danger');
                            $.each(response.error, function(key, err_value) {
                                $('#save_msgList').append('<li>' + err_value + '</li>');
                            });
                            $('#submitButton').text('Update')
                        }
                    }
                });
            });

            // delete
            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                $('.delete').text('Deleting...');
                $('.delete').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>')

                var form = $(this).closest('form'); //sellecting form
                var dataID = $(this).data('id'); // getting id 
                // console.log(form);
                // let url = $(this).attr('data-href');
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-info',
                        cancelButton: 'btn btn-danger mr-3'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your file is safe :)',
                            'error'
                        )
                        $('.delete').text('Delete');
                    }
                })

            });
        });
    </script>
@endsection
