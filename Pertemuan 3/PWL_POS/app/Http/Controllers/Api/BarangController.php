<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index(){
        return BarangModel::all();
    }

    public function store(Request $request){
        
        $validator = Validator::make($request->all(),[
            'barang_id' => 'required',
            'kategori_id' => 'required',
            'barang_kode' => 'required',
            'barang_nama' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'image' => 'required|image|mimes:jpeg,png,gif,svg|max:2048'
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

        // Create barang
        $barang = BarangModel::create([
            'barang_id' => $request->barang_id,
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual'=> $request->harga_jual,
            'image' => $imageName,
        ]);
        if($barang){
            return response()->json([
                'success' => true,
                'user' => $barang,
            ], 201);
        }

        //return JSON process insert failed
        return response()->json([
            'success' => false,
        ], 409);


    }   

    public function show(BarangModel $barang){
        return BarangModel::find($barang);
    }

    public function update(Request $request, BarangModel $barang){
        $barang->update($request->all());
        return BarangModel::find($barang);
    }

    public function destroy(BarangModel $barang){
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus',
        ]);
    }
}
