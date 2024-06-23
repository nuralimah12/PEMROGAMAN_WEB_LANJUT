<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Manajemen Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar Barang yang terdaftar dalam sistem',
        ];

        $activeMenu = 'barang';

        $kategori = KategoriModel::all();

        return view('barang.index', [
        'breadcrumb' => $breadcrumb, 
        'page' => $page, 
        'kategori' => $kategori, 
        'activeMenu' => $activeMenu,
        'unvalidateUser' => UserModel::where('status', false)->get()
        ]);
    }

    public function list(Request $request)
    {
        $barangs = BarangModel::with('kategori');

        if($request->kategori_id){
            $barangs->where('kategori_id', $request->kategori_id);
        }


        return DataTables::of($barangs)->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
        $btn = '<a href="'.url('/barang/' . $barang->barang_id).'" class="btn btn-info btn-sm">Detail</a> ';
        $btn .= '<a href="'.url('/barang/' . $barang->barang_id . '/edit').'" 
        class="btn btn-warning btn-sm">Edit</a> ';
        $btn .= '<form class="d-inline-block" method="POST" action="'. 
        url('/barang/'.$barang->barang_id).'">'
        . csrf_field() . method_field('DELETE') . 
        '<button type="submit" class="btn btn-danger btn-sm" 
        onclick="return confirm(\'Apakah Anda yakit menghapus data 
        ini?\');">Hapus</button></form>'; 
        return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah'],
        ];

        $page = (object) [
            'title' => 'Tambah barang baru'
        ];

        $kategori = KategoriModel::all();

        $activeMenu = 'barang';

        return view('barang.create', [
        'breadcrumb' => $breadcrumb, 
        'page' => $page, 
        'kategori' => $kategori, 
        'activeMenu' => $activeMenu,
        'unvalidateUser' => UserModel::where('status', false)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kategori_id' => 'required',
            'barang_nama' => 'required',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        if ($request->harga_jual < $request->harga_beli) {
            return redirect()->back()->withErrors(['harga_jual' => 'Harga jual tidak boleh kurang dari harga beli'])->withInput();
        }
    
        // Ambil kode kategori
        $kategori = KategoriModel::find($request->kategori_id);
        $kategoriKode = $kategori->kategori_kode; // Pastikan ada field kategori_kode di tabel kategori
    
        // Hitung jumlah barang yang ada di kategori tersebut
        $barangCount = BarangModel::where('kategori_id', $request->kategori_id)->count() + 1;
    
        // Buat kode barang otomatis
        $kodeBarang = $kategoriKode . str_pad($barangCount, 3, '0', STR_PAD_LEFT) . date('dmy');
    
        // Simpan barang
        $barang = new BarangModel();
        $barang->kategori_id = $request->kategori_id;
        $barang->barang_kode = $kodeBarang;
        $barang->barang_nama = $request->barang_nama;
        $barang->harga_beli = $request->harga_beli;
        $barang->harga_jual = $request->harga_jual;
        $barang->save();

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $barang = BarangModel::with('kategori')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail barang'
        ];

        $activeMenu = 'barang';

        return view('barang.show', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'barang' => $barang,
            'activeMenu' => $activeMenu,
            'unvalidateUser' => UserModel::where('status', false)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = BarangModel::find($id);

        $kategori = KategoriModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list' => ['Home', 'barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Barang',
        ];

        $activeMenu = 'barang';

        return view('barang.edit', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'barang' => $barang,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu,
            'unvalidateUser' => UserModel::where('status', false)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_id' => 'required|integer',
            'barang_nama' => 'required|string|max:100',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg',
        ]);

        if ($request->harga_jual < $request->harga_beli) {
            return redirect()->back()->withErrors(['harga_jual' => 'Harga jual tidak boleh kurang dari harga beli'])->withInput();
        }

        // Ambil kode kategori
        $kategori = KategoriModel::find($request->kategori_id);
        $kategoriKode = $kategori->kategori_kode; // Pastikan ada field kategori_kode di tabel kategori

        // Hitung jumlah barang yang ada di kategori tersebut
        $barangCount = BarangModel::where('kategori_id', $request->kategori_id)->count();

        // Buat kode barang otomatis
        $kodeBarang = $kategoriKode . str_pad($barangCount, 3, '0', STR_PAD_LEFT) . date('dmy');

        $barang = BarangModel::find($id);
        $barang->update([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $kodeBarang,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = BarangModel::find($id);

        if(!$check){
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        try {
            BarangModel::destroy($id);

            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect('/barang')->with('/error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}