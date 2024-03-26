<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable){
        return $dataTable->render('kategori.index');
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        KategoriModel::create([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori,
        ]);
        return redirect('/kategori');
    }

    public function edit($id) {
        $data = KategoriModel::find($id);
        return view('kategori.edit', ['data' => $data]);
    }

    public function update(Request $request, $id) {
        $data = [
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori,
        ];
        KategoriModel::where('kategori_id', $id)->update($data);
        return redirect('/kategori');
    }

    public function delete($id) {
        KategoriModel::destroy($id);
        return redirect('/kategori');
    }
}
