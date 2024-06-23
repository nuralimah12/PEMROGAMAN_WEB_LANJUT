<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TransaksiController extends Controller
{
    public function index(){
        
        return PenjualanDetailModel::all();
    }

    public function store(Request $request){
        
        $validator = Validator::make($request->all(),[
            'detail_id' => 'required',
            'penjualan_id' => 'required',
            'barang_id' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
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

        // Create transaksi
        $transaksi = PenjualanDetailModel::create([
            'detail_id' => $request->detail_id,
            'penjualan_id' => $request->penjualan_id,
            'barang_id' => $request->barang_id,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'image' => $imageName,
        ]);
        if($transaksi){
            return response()->json([
                'success' => true,
                'user' => $transaksi,
            ], 201);
        }

        //return JSON process insert failed
        return response()->json([
            'success' => false,
        ], 409);


    }   

    public function show($id){
        $transaksi = PenjualanDetailModel::with('barangs')->find($id);
        if (!$transaksi) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($transaksi);
    }

    public function update(Request $request, PenjualanDetailModel $transaksi){
        $transaksi->update($request->all());
        return PenjualanDetailModel::find($transaksi);
    }

    public function destroy(PenjualanDetailModel $transaksi){
        $transaksi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus',
        ]);
    }
}
