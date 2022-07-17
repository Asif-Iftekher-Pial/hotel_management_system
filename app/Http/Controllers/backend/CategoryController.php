<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        //  return $categories;
        return view('backend.layouts.category.index', compact('categories'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string',
            'description' => 'required|string',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->passes()) {
            // dd("okkkkk");
            if ($request->file('category_image')) {
                $file = $request->file('category_image');
                $filename = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('backend/category/images/'), $filename);
            }
            $category = new Category();
            $category->category_name    = $request->category_name;
            $category->description      = $request->description;
            $category->category_image   = $filename;
            $data = $category->save();

            if ($data) {
                $notification = array(
                    // 'T-messege' => 'welcome '.$request->name.'!',
                    'T-messege' => 'Category added successfully ',
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
        } else {
            echo "something went wrong";
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
        $getCat = Category::find($id);
        return response()->json($getCat);
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
        // print_r($request->all());
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string',
            'description' => 'required|string',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->passes()) {
            // dd("okkkkk");
            $getcat = Category::find($id);
            // return $getcat;
            $filename = $getcat->category_image; // find the image that will update


            if ($request->file('category_image')) {
                $file = $request->file('category_image');
                $filename = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('backend/category/images/'), $filename);
                @unlink(public_path('backend/category/images/' . $getcat->category_image));
            }
            
           $data= $getcat->update([
                'category_name' => $request->category_name,
                'description'   => $request->description,
                'category_image' => $filename
            ]);
            return response()->json(['status' =>200]);
           
            
            
        } else{
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $getData = Category::find($id);
        if ($getData) {
            @unlink(public_path('backend/category/images/' .  $getData->category_image));
            $status =  $getData->delete();
            if ($status) {
                return back();
            }
        }
    }
}
