@extends('backend.master')
@section('main')
    {{-- Modal --}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <form action="{{ route('employee.store') }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Add new employee</h5>
                                    <div class="row">
                                        <div class="col-md-10 col-lg-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email" id="email">
                                            </div>
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select class="form-control"  name="role">
                                                    <option selected>Select Role</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="Staff">Staff</option>
                                                    <option value="Accountant">Accountant</option>
                                                    <option value="Receiptionalist">Receiptionalist</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-10 col-lg-6">
                                            <div class="form-group">
                                                <label>Join Date</label>
                                                <input type="date"class="form-control" name="join_date" id="">
                                            </div>
                                        </div>
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
    {{-- modal end --}}

    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Employee</h4>
                        <button type="button" class="btn btn-primary float-right veiwbutton" data-toggle="modal"
                            data-target=".bd-example-modal-lg">
                            <span class="fas fa-plus"></span> Add New Employee
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @include('backend.layouts.errors.errormessage')
        {{-- search --}}
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('filterEmployee') }}" type="get">
                    <div class="row formtype">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Employee ID</label>
                                <input type="text" class="form-control" name="e_id" id="usr">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Employee User name</label>
                                <input type="text" class="form-control" name="user_name" id="usr1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" id="sel1" name="role">
                                    <option selected>Selected</option>
                                    <option>Admin</option>
                                    <option>Manager</option>
                                    <option>Staff</option>
                                    <option>Accountant</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Search</label>
                                {{-- <a href="#" class="btn btn-success btn-block mt-0 search_button"> Search </a> --}}
                                <button type="submit" class="btn btn-success btn-block mt-0 search_button"> Search </button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- search end --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Employee ID</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Join Date</th>
                                        <th>role</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employee as $item)
                                    <tr>
                                        <td>{{ $item->user_name }}</td>
                                        <td>{{ $item->e_id }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->contact_number }}</td>
                                        <td>{{ $item->join_date }}</td>
                                        <td>
                                            <span class="custom-badge status-green">{{ $item->role }}</span>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i
                                                        class="fas fa-ellipsis-v ellipse_color"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="edit-employee.html"><i
                                                            class="fas fa-pencil-alt m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#delete_asset"><i class="fas fa-trash-alt m-r-5"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cristina Groves</td>
                                        <td>SF-0001</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="680b1a011b1c0106090f1a071e0d1b280d10090518040d460b0705">[email&#160;protected]</a>
                                        </td>
                                        <td>928-344-5176</td>
                                        <td>1 Jan 2013</td>
                                        <td>Staff</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="fas fa-ellipsis-v ellipse_color"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="edit-employee.html"><i
                                                            class="fas fa-pencil-alt m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#delete_asset"><i class="fas fa-trash-alt m-r-5"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mary Mericle</td>
                                        <td>SF-0003</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="4825293a31252d3a212b242d082d30292538242d662b2725">[email&#160;protected]</a>
                                        </td>
                                        <td>603-831-4983</td>
                                        <td>27 Dec 2017</td>
                                        <td>Accountant</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="fas fa-ellipsis-v ellipse_color"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="edit-employee.html"><i
                                                            class="fas fa-pencil-alt m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#delete_asset"><i class="fas fa-trash-alt m-r-5"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Haylie Feeney</td>
                                        <td>SF-0002</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="4f272e3623262a292a2a212a360f2a372e223f232a612c2022">[email&#160;protected]</a>
                                        </td>
                                        <td>616-774-4962</td>
                                        <td>21 Apr 2017</td>
                                        <td>Room Maintainers</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="fas fa-ellipsis-v ellipse_color"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="edit-employee.html"><i
                                                            class="fas fa-pencil-alt m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#delete_asset"><i class="fas fa-trash-alt m-r-5"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Zoe Butler</td>
                                        <td>SF-0001</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="5e24313b3c2b2a323b2c1e3b263f332e323b703d3133">[email&#160;protected]</a>
                                        </td>
                                        <td>444-555-9999</td>
                                        <td>19 May 2012</td>
                                        <td>Receptionist</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="fas fa-ellipsis-v ellipse_color"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="edit-employee.html"><i
                                                            class="fas fa-pencil-alt m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#delete_asset"><i class="fas fa-trash-alt m-r-5"></i>
                                                        Delete</a>
                                                </div>
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
        </div>

    </div>
@endsection
