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
                        <form action="{{ route('room.store') }}" method="POST" id="upload_form"
                            enctype="multipart/form-data">
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
                                <th class="text-center">Capacity</th>
                                <th class="text-right">Category</th>
                                <th class="text-left">Description</th>
                                <th class="text-left">Facilities</th>
                                <th class="text-center">Availability</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
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
                                            src="{{ asset('backend/room/images/' . $item->room_image) }}"
                                            alt="room image" srcset="">
                                    </td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ $item->bed_types }}</td>
                                    <td class="text-center">{{ $item->bed_count }}</td>
                                    <td class="text-center">{{ $item->price }}</td>
                                    <td>{{ $item->capacity }} Person Max</td>
                                    <td class="text-center">{{ $item->category_id }}</td>
                                    <td>
                                        {!! html_entity_decode(substr_replace($item->description, '...', 20)) !!}
                                    </td>
                                    <td class="text-center">
                                        {!! html_entity_decode(substr_replace($item->facilities, '...', 20)) !!}
                                    </td>
                                    <td class="text-right">
                                        <input type="checkbox" name="toggleAvailability" data-toggle="toggle"
                                            data-on="Free" value="{{ $item->id }}"
                                            {{ $item->availability == 'free' ? 'checked' : '' }} data-off="Reserved"
                                            data-onstyle="success" data-offstyle="warning">
                                    </td>
                                    <td class="text-right">
                                        <input type="checkbox" name="toggle" value="{{ $item->id }}"
                                            data-toggle="toggle" {{ $item->status == 'active' ? 'checked' : '' }}
                                            data-on="Active" data-off="Inactive" data-onstyle="success"
                                            data-offstyle="danger">
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-success">Edit</button>
                                        <button class="btn btn-sm btn-danger">Delete</button>
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
                    success: function (response) {
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
        });
    </script>
@endsection
