<?php

namespace App\Http\Controllers;

use App\Models\UnitModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    //
    public function index()
    {

        $data = UnitModel::all();

        return response()->json($data);
    }

    public function show($id)
    {

        $data = UnitModel::find($id);

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nm_unit' => 'required|unique:tbl_unit|max:255',
                'pimpinan' => 'required|max:255',
                'gol' => 'required|max:255',
                'jabatan' => 'required|max:255',
                'lat' => 'required|numeric|between:-90,90',
                'long' => 'required|numeric|between:-90,90',
                'radius' => 'required|numeric',
            ],
            [
                'nm_unit.required' => 'Kolom Nama unit wajib diisi.',
                'nm_unit.unique' => 'Nama unit sudah digunakan.',
                'nm_unit.max' => 'Panjang maksimal nama unit adalah 255 karakter.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422); // 422: Unprocessable Entity
        }

        $validatedData = $validator->validated();

        try {
            UnitModel::create($validatedData);

            return response()->json(['success' => true, 'message' => 'Success'], 201); // 201: Created
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed'], 500); // 500: Internal Server Error
        }
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nm_unit' => 'required|max:255',
                'pimpinan' => 'required|max:255',
                'gol' => 'required|max:255',
                'jabatan' => 'required|max:255',
                'lat' => 'required|numeric|between:-90,90',
                'long' => 'required|numeric|between:-90,90',
                'radius' => 'required|numeric',
            ],
            [
                'nm_unit.required' => 'Kolom Nama unit wajib diisi.',
                'nm_unit.max' => 'Panjang maksimal nama unit adalah 255 karakter.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422); // 422: Unprocessable Entity
        }

        $validatedData = $validator->validated();
    
        $findId = UnitModel::find($id);
    
        if (!$findId) {
            return response()->json(['success' => false, 'message' => 'Not Found'], 404); // 404: Not Found
        }
    
        try {
            $data = UnitModel::findOrFail($id);
            $data->update($validatedData);
            return response()->json(['success' => true, 'message' => 'Success'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed'], 500); // 500: Internal Server Error
        }
    }
    
    public function destroy($id)
    {
        $findId = UnitModel::find($id);
    
        if (!$findId) {
            return response()->json(['success' => false, 'message' => 'Not Found'], 404); // 404: Not Found
        }
    
        try {
            $data = UnitModel::findOrFail($id);
            $data->delete();
    
            return response()->json(['success' => true, 'message' => 'Success'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed'], 500); // 500: Internal Server Error
        }
    }
}
