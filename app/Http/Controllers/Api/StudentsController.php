<?php

namespace App\Http\Controllers\Api;

use App\Models\Students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Students::all();
        return response()->json([
            'message' => 'Data All',
            'data' => $data
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'address' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ],400);
        }
        $data = [
            'name' => $request->name,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
        ];

        if(Students::create($data)) {
            return response()->json([
                'success' => true,
                'message' => 'Insert Data Success'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Insert Data Failed'
            ]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'address' => 'required',
        ],[
            'name.required' => 'Nama Wajib Di Isi',
            'gender.required' => 'Jenis Kelamin Wajib Di Isi',
            'age.required' => 'Umur Wajib Di Isi',
            'address.required' => 'Alamat Wajib Di Isi',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ]);
        }
        $data = [
            'name' => $request->name,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
        ];
        $students = Students::findOrFail($id);
        if($students->update($data)) {
            return response()->json([
                'success' => true,
                'message' => 'Update Data Success'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Update Data Failed'
            ]);
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
        $students = Students::findOrFail($id);
        if($students->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Data Has Been Deleted'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Failed'
            ]);
        }
    }
}
