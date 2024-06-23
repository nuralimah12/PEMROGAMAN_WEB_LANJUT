<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\PenjualanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function index(){
        return PenjualanModel::all();
    }

    public function store(Request $request){
        
        $validator = Validator::make($request->all(),[
            'penjualan_id' => 'required',
            'user_id'  => 'required',
            'pembeli'=> 'required',
            'penjualan_kode' => 'required',
            'penjualan_tanggal'> 'required',
            'image' => 'required|image|mimes:jpeg,png,gif,svg|max:2048',
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->move(public_path('uploads/images'), $imageName);
        } else {
            return response()->json(['image' => 'Image upload failed'], 400);
        }

        // Create penjualan
        $penjualan = PenjualanModel::create([
            'penjualan_id' => $request->penjualan_id,
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_kode' => $request->penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal,
            'image' => $imageName,
    
        ]);
        if($penjualan){
            return response()->json([
                'success' => true,
                'user' => $penjualan,
            ], 201);
        }

        //return JSON process insert failed
        return response()->json([
            'success' => false,
        ], 409);


    }   

    public function show(PenjualanModel $penjualan){
        return PenjualanModel::find($penjualan);
    }

    public function update(Request $request, PenjualanModel $penjualan){
        $penjualan->update($request->all());
        return PenjualanModel::find($penjualan);
    }

    public function destroy(PenjualanModel $penjualan){
        $penjualan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus',
        ]);
    }
}
