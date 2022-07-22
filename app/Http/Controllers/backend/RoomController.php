<?php

namespace App\Http\Controllers\backend;

use App\Models\Room;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Category::orderBy('id', 'desc')->get();
        //  dd($cat);
        $rooms = Room::orderBy('id', 'DESC')->with('category')->get();
        // dd($rooms);
        return view('backend.layouts.room.index', compact('rooms', 'cats'));
    }

    public function roomstatus(Request $request)
    {
        //  return $request->all();
        if ($request->mode == 'true') {
            Room::where('id', $request->id)->update(['status' => 'active']);
        } else {
            Room::where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Room status updated successfully'
        ]);
    }
    public function availabilitystatus(Request $request)
    {
        //   return $request->all();
        if ($request->mode == 'true') {
            Room::where('id', $request->id)->update(['availability' => 'free']);
            // return "free";
        } else {
            Room::where('id', $request->id)->update(['availability' => 'reserved']);
            // return "reserved";
        }
        return response()->json([
            'status' => 200,
            'message' => 'Updated successfully!'
        ]);
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
        // return $request->all();
        $request->validate([
            'title' => 'string|required',
            'size'  => 'string|required',
            'capacity' => 'string|required',
            'bed_types' => 'string|required',
            'bed_count' => 'numeric|required',
            'room_number' => 'numeric|unique:rooms,room_number|required',
            'category_id' => 'numeric|required',
            'price' => 'numeric|required',
            'description' => 'required|min:3|max:1000',
            'facilities' => 'required|min:3|max:1000',
            'availability' => 'required',
            'status' => 'required',
            'room_image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($request->file('room_image')) {
            $file = $request->file('room_image');
            $filename = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/room/'), $filename);
        }
        $room = new Room();
        $room->title = $request->title;
        $room->size = $request->size;
        $room->capacity = $request->capacity;
        $room->bed_types = $request->bed_types;
        $room->bed_count = $request->bed_count;
        $room->room_number = $request->room_number;
        $room->category_id = $request->category_id;
        $room->price = $request->price;
        $room->description = $request->description;
        $room->facilities = $request->facilities;
        $room->availability = $request->availability;
        $room->status = $request->status;
        $room->room_image = $filename;
        $data = $room->save();
        if ($data) {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Room added successfully ',
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
    public function edit($room_number)
    {
        //
        $getData = Room::where('room_number',$room_number)->first();
        // return $getData;
        if($getData){
            return response()->json($getData);
        }else{
            echo "data not found";
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $room_number)
    {
        // return $request->all();
        $validator = Validator::make($request->all(),[
            'title' => 'string|required',
            'size'  => 'string|required',
            'capacity' => 'string|required',
            'bed_types' => 'string|required',
            'bed_count' => 'numeric|required',
            // 'room_number' => 'numeric|unique:rooms,room_number|required',
            'category_id' => 'numeric|required',
            'price' => 'numeric|required',
            'description' => 'required|min:3|max:1000',
            'facilities' => 'required|min:3|max:1000',
            'availability' => 'required',
            'status' => 'required',
            'room_image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
       
        ]);
        if($validator ->passes()){
            $getRoom = Room::where('room_number',$room_number)->first();
            $filename = $getRoom->room_image; // find the image that will update


            if ($request->file('room_image')) {
                $file = $request->file('room_image');
                $filename = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('backend/images/room/'), $filename);
                @unlink(public_path('backend/images/room/' . $getRoom->room_image));
            }


            $data=$getRoom->update([
            'title' => $request->title,
            'size'  => $request->size,
            'capacity' => $request->capacity,
            'bed_types' => $request->bed_types,
            'bed_count' => $request->bed_count,
            // 'room_number' => $request->room_number,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'facilities' => $request->facilities,
            'availability' => $request->availability,
            'status' => $request->status,
            'room_image'  => $filename
            ]);
            if($data){
                return response()->json([
                    'status' => 200,
                    'message'=>'Room Updated Successfully!'
                ]);
            }
            else{
                echo "Something went wrong";
            }

        }else{
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
        $getData = Room::find($id);
        // return $getData;
        if ($getData) {
            @unlink(public_path('backend/images/room/' . $getData->room_image));
            $status = $getData->delete();
            if ($status) {
                return back();
            }
        }
    }
}
