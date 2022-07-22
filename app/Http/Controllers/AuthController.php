<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function home()
    {
        return view('backend.layouts.home.home');
    }

    public function loginIndex()
    {
        return view('backend.layouts.auth.login');
    }

    public function doLogin(Request $request)
    {

        //  return $request->all();
        $credentials = $request->only('email', 'password');


        if (Auth::guard('employee')->attempt($credentials)) {
            // dd('ok');
            $request->session()->regenerate();
            $status = Employee::where('id', '=', Auth::guard('employee')->user()->id);
            // dd($status);
            $status->update([
                'status' => 'Active'
            ]);
            //dd($request->all());
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'You are Logged in as Employee',
                'alert-type' => 'success'
            );
            return redirect()->intended(route('home'))->with($notification);;
        }else{
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Oops! wrong email or password',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        
    }
}
