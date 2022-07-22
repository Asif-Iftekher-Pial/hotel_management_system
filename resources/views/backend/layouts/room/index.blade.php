@extends('backend.master')
@section('main')
    <div class="page-header">
        <div class="row m-l-5">
            <div class="col-sm-12 mt-5">
                <h3 class="page-title mt-3">Hotel Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Rooms</li>
                </ul>
            </div>
        </div>
    </div>
    @include('backend.layouts.errors.errormessage')
    {{-- Modal --}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Room </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <form action="{{ route('room.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row formtype">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Room Number</label>
                                                <input class="form-control" type="number" name="room_number"
                                                    placeholder="0001">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input class="form-control" type="text" name="title"
                                                    placeholder="Room name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Size</label>
                                                <input class="form-control" type="text" name="size"
                                                    placeholder="Family Size">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Capacity (Person)</label>
                                                <input class="form-control" type="number" name="capacity">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Bed Type</label>
                                                <select class="form-control" id="bed_types" name="bed_types">
                                                    <option selected>Select Bed Type</option>
                                                    <option value="single">Single</option>
                                                    <option value="double">Double</option>
                                                    <option value="quad">Quad</option>
                                                    <option value="king">King</option>
                                                    <option value="suit">Suite</option>
                                                    <option value="villa">Villa</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select class="form-control" id="sel2" name="category_id">
                                                    <option selected>Select Categoty</option>
                                                    @foreach ($cats as $item)
                                                        <option value="{{ $item->id }}">{{ $item->category_name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Bed Count</label>
                                                <select class="form-control" id="sel" name="bed_count">
                                                    <option selected>Select</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Availability</label>
                                                <select class="form-control" id="sel" name="availability">
                                                    <option selected>Select</option>
                                                    <option value="reserved">Reserved</option>
                                                    <option value="free">Free</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" id="sel" name="status">
                                                    <option selected>Select</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="number" class="form-control" name="price" id="usr1">
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
                                                <label>Facilities</label>
                                                <textarea id="summernoteTwo" class="form-control" rows="8" id="comment" name="facilities"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>File Upload</label>
                                                <div class="custom-file mb-3">
                                                    <input type="file" class="custom-file-input" id="file-input"
                                                        multiple name="room_image">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                <div id="thumb-output"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End Modal --}}
    {{-- Edit Modal --}}
    <div class="modal fade bd-example-modal-lg-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Room No: <input type="number" disabled
                            id="roomNo"> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <form method="POST" id="update_form" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row">
                                <ul id="save_msgList">

                                </ul>
                                <div class="col-lg-12">
                                    <div class="row formtype">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input class="form-control" type="text" id="title" name="title"
                                                    placeholder="Room name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Size</label>
                                                <input class="form-control" type="text" id="size" name="size"
                                                    placeholder="Family Size">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Capacity (Person)</label>
                                                <input class="form-control" type="number" id="capacity"
                                                    name="capacity">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Bed Type</label>
                                                <select class="form-control" id="types" name="bed_types">
                                                    <option selected>Select Bed Type</option>
                                                    <option value="single">Single</option>
                                                    <option value="double">Double</option>
                                                    <option value="quad">Quad</option>
                                                    <option value="king">King</option>
                                                    <option value="suit">Suite</option>
                                                    <option value="villa">Villa</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select class="form-control" id="category_id" name="category_id">
                                                    <option selected>Select Categoty</option>
                                                    @foreach ($cats as $item)
                                                        <option value="{{ $item->id }}">{{ $item->category_name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Bed Count</label>
                                                <select class="form-control" id="bed_count" name="bed_count">
                                                    <option selected>Select</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Availability</label>
                                                <select class="form-control" id="availability" name="availability">
                                                    <option selected>Select</option>
                                                    <option value="reserved">Reserved</option>
                                                    <option value="free">Free</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" id="status" name="status">
                                                    <option selected>Select</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="number" class="form-control" name="price"
                                                    id="price">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea id="summernoteThree" class="form-control description" rows="8" id="comment" name="description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Facilities</label>
                                                <textarea id="summernoteFour" class="form-control facilities" rows="8" id="comment" name="facilities"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>File Upload</label>
                                                <div class="custom-file mb-3">
                                                    <input type="file" class="custom-file-input ok" id="file-inputTwo"
                                                        multiple name="room_image">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                <div class="d-flex">
                                                    <div id="thumb-outputTwo"></div>
                                                    <div id="thumb-previous"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary submit-button">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End Edit Modal --}}


    <div class="col-md-12 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h4 class="card-title float-left mt-2">All Rooms</h4>
                <button type="button" class="btn btn-primary float-right veiwbutton" data-toggle="modal"
                    data-target=".bd-example-modal-lg">
                    <span class="fas fa-plus"></span> Add New Room
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-hover table-center">
                        <thead>
                            <tr>
                                <th>Room No</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Size</th>
                                <th>Bed Type</th>
                                <th>Bed Count</th>
                                <th>Price</th>
                                <th >Capacity</th>
                                <th>Category</th>
                                <th >Description</th>
                                <th >Facilities</th>
                                <th >Availability</th>
                                <th >Status</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $item)
                                <tr>
                                    <td class="text-nowrap">
                                        <div>{{ $item->room_number }}</div>
                                    </td>
                                    <td class="text-nowrap">
                                        {{ substr_replace($item->title, '...', 20) }}
                                    </td>
                                    <td><img style="width: 200px ; height:100px"
                                            src="{{ asset('backend/images/room/' . $item->room_image) }}"
                                            alt="room image" srcset="">
                                    </td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ $item->bed_types }}</td>
                                    <td class="text-center">{{ $item->bed_count }}</td>
                                    <td class="text-center">{{ $item->price }}</td>
                                    <td>{{ $item->capacity }} Person Max</td>
                                    <td class="text-center">{{ $item->category->category_name }}</td>
                                    <td>
                                        {!! html_entity_decode(substr_replace($item->description, '...', 20)) !!}
                                    </td>
                                    <td class="text-center">
                                        {!! html_entity_decode(substr_replace($item->facilities, '...', 20)) !!}
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="toggleAvailability" data-toggle="toggle"
                                            data-on="Free" value="{{ $item->id }}"
                                            {{ $item->availability == 'free' ? 'checked' : '' }} data-off="Reserved"
                                            data-onstyle="success" data-offstyle="warning">
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="toggle" value="{{ $item->id }}"
                                            data-toggle="toggle" {{ $item->status == 'active' ? 'checked' : '' }}
                                            data-on="Active" data-off="Inactive" data-onstyle="success"
                                            data-offstyle="danger">
                                    </td>
                                    
                                    <td class="align-items-center">
                                        <div class="d-flex">
                                            <button type="button" value="{{ $item->room_number }}"
                                                class="edit-button btn btn-sm btn-primary" data-toggle="modal"
                                                data-target=".bd-example-modal-lg-edit"><i class="fa fa-pen"></i>
                                                Edit
                                            </button>
                                            <form action="{{ route('room.destroy', $item->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn delete btn-sm btn-danger ml-3"
                                                    data-id="{{ $item->id }}">
                                                    <i class="fa fa-trash"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('backend_script')
    <script>
        $(document).ready(function() {
            $('input[name=toggle]').change(function() {
                var mode = $(this).prop('checked');
                var id = $(this).val();
                // alert(id);
                $.ajax({
                    url: "{{ route('rStatus') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        mode: mode,
                        id: id
                    },
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Good Job!',
                                text: response.message,
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }
                    }
                });
            });

            $('input[name=toggleAvailability]').change(function() {
                var mode = $(this).prop('checked');
                var id = $(this).val();
                // alert(id)
                $.ajax({
                    type: "post",
                    url: "{{ route('availability') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        mode: mode,
                        id: id
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Good Job!',
                                text: response.message,
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
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


            // edit
            $(document).on('click', '.edit-button', function(e) {
                e.preventDefault();
                var room_number = $(this).val()
                //  alert(room_number);
                $.ajax({
                    type: "get",
                    url: 'room/' + room_number + '/edit',
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        $('#roomNo').val(response.room_number);
                        // $('#room_number').val(response.room_number);
                        $('#title').val(response.title);
                        $('#size').val(response.size);
                        $('#capacity').val(response.capacity);
                        $('#types').val(response.bed_types);
                        $('#category_id').val(response.category_id);
                        $('#bed_count').val(response.bed_count);
                        $('#availability').val(response.availability);
                        $('#status').val(response.status);
                        $('#price').val(response.price);
                        $('.description').val(response.description);
                        $('.facilities').val(response.facilities);
                        $('#thumb-previous').html(
                            ' <img style="width:100px;height:100px" src="backend/images/room/' +
                            response.room_image + '" >');
                    }
                });

            });

            // update
            $('#update_form').on('submit', function(e) {
                e.preventDefault();
                var room_number = $('#roomNo').val();
                // alert('submit'+id);
                $('.submit-button').text('Updating...')
                $('.submit-button').html('<span class="fas fa-spinner fa-spin"></span>');
                $.ajax({
                    type: "post",
                    url: 'room/' + room_number,
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        // console.log(response);
                        if(response.status == 200){
                            
                        $('.bd-example-modal-lg-edit').modal('hide');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        location.reload();
                        }else{
                            $('#save_msgList').html("");
                            $('#save_msgList').addClass('alert alert-danger');
                            $.each(response.error, function(key, err_value) {
                                $('#save_msgList').append('<li>' + err_value + '</li>');
                            });
                            $('.submit-button').text('Update')
                        }
                    }
                });

            });
        });
    </script>
@endsection
