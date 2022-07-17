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
    {{-- Modal --}}
    {{-- <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
                        <form method="POST" id="upload_form" enctype="multipart/form-data">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="row formtype">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input class="form-control" type="text" name="category_name" placeholder="BKG-0001">
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="saveButton" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- End Modal --}}

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

                <h2 class="text-center my-5">loading....</h2>
                {{-- <div class="table-responsive">
                    <table id="myTable" class="table table-hover table-center">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                                <tr>
                                    <td>{{ substr_replace($item->category_name, '...', 15) }}</td>

                                    <td><img style="width: 200px ; height:100px"
                                            src="{{ asset('backend/category/images/' . $item->category_image) }}"
                                            alt="category image" srcset=""></td>

                                    <td>{!! html_entity_decode(substr_replace($item->description, '...', 20)) !!}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success">Edit</button>
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
{{-- 
@section('backend_script')
    <script>
        $(document).ready(function() {
            $('#upload_form').on('submit', function(e) {
                e.preventDefault();
                $('#saveButton').text('Saving...');
                // $('#saveButton').html(' <i class="fas fa-spinner fa-spin"></i>');
                // alert('ok');
                $.ajax({
                    type: "POST",
                    url: "{{ route('category.store') }}",
                    data: new FormData(this),
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,

                    beforeSend: function() {
                    
                        $('#saveButton').html(' <i class="fas fa-spinner fa-spin"></i>');
                    },
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 200) {
                            $("#upload_form")[0].reset();
                            $('.bd-example-modal-lg').modal('hide');
                            $('#saveButton').text('Save Changes');
                            $("#upload_form")[0].reset();
                            $('#thumb-output').html('');
                            $('.bd-example-modal-lg').modal('hide');
                            Toast.fire({
                                icon: 'success',
                                title: 'Category saved successfully!'
                            })
                            fetchdata();
                        }
                    }
                })
            })
        });

        // fetch data
   
        fetchdata();
        function fetchdata(){
            $.ajax({
                type: "get",
                url: "{{ route('fetch') }}",
               
                success: function (response) {
                    // console.log(response);
                    $('#show_all_category').html(response);
                    $('table').DataTable();
                    // alert('ok');
                }
            });
        };
    </script>
@endsection --}}
