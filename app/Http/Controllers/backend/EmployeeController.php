<?php

namespace App\Http\Controllers\backend;

use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return view('backend.layouts.Employees.allEmployees', compact('employee'));
    }
    public function filterEmployee()
    {
        // dd(ok);
        $ok = $_GET['e_id'];
        $oke = $_GET['user_name'];
        $okr = $_GET['role'];
        if ($ok) {
            $data = Employee::where('e_id', 'LIKE', '%' . $ok . '%')->first();
            return view('backend.layouts.Employees.profile', compact('data'));
        } elseif ($oke) {
            $data = Employee::where('user_name', 'LIKE', '%' . $oke . '%')->first();
            return view('backend.layouts.Employees.profile', compact('data'));
        }
        else{
            $employee = Employee::where('role', 'LIKE', '%' . $okr . '%')->orderBy('id','desc')->get();
            return view('backend.layouts.Employees.filteredEmployee', compact('employee'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:employees,email',
            'role' => 'required'
        ]);

        $status = Employee::create([
            'email' => $request->email,
            'role' => $request->role,
            'join_date' => $request->join_date,
            'e_id' => Str::random(8),
            'password' => Hash::make('12345')
        ]);

        if ($status) {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Employee created successfully ',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Something went wrong ',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
