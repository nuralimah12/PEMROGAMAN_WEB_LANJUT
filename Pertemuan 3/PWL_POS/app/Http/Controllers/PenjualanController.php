<?php

namespace App\Http\Controllers;

use App\Charts\TransaksiChart;
use App\Models\BarangModel;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\StokModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TransaksiChart $chart)
    {
        $breadcrumb = (object) [
            'title' => 'Manajemen Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar transaksi penjualan yang terdaftar dalam sistem',
        ];

        $activeMenu = 'penjualan';

        $user = UserModel::all();

        return view('penjualan.index', [
        'breadcrumb' => $breadcrumb, 
        'page' => $page, 
        'user' => $user, 
        'chart' => $chart->build(),
        'activeMenu' => $activeMenu,
        'unvalidateUser' => userModel::where('status', false)->get()
        ]);
    }

    public function list(Request $request)
    {

        if ($request->user_id) {
            // $transactions->where('user_id', $request->user_id);

            $transactions = (object) DB::table('t_penjualan as p')
                ->join('t_penjualan_detail as pd', 'p.penjualan_id', '=', 'pd.penjualan_id')
                ->join('m_user as u', 'p.user_id', '=', 'u.user_id')
                ->selectRaw("p.penjualan_id,u.nama, p.pembeli, p.penjualan_kode, DATE_FORMAT(p.penjualan_tanggal, '%d-%m-%Y') as penjualan_tanggal, sum(pd.harga * pd.jumlah) as total")
                ->where('p.user_id', $request->user_id)
                ->groupBy('u.nama')
                ->groupBy('p.pembeli')
                ->groupBy('p.penjualan_id')
                ->groupBy('p.penjualan_kode')
                ->groupBy('penjualan_tanggal')
                ->orderBy('p.penjualan_id', 'desc')
                ->get();
        } else {

            if (auth()->user()->level->level_nama == 'Member') {
                $transactions = (object) DB::table('t_penjualan as p')
                    ->join('t_penjualan_detail as pd', 'p.penjualan_id', '=', 'pd.penjualan_id')
                    ->join('m_user as u', 'p.user_id', '=', 'u.user_id')
                    ->selectRaw("p.penjualan_id,u.nama, p.pembeli, p.penjualan_kode, DATE_FORMAT(p.penjualan_tanggal, '%d-%m-%Y') as penjualan_tanggal, sum(pd.harga * pd.jumlah) as total")
                    ->where('p.pembeli', auth()->user()->username)
                    ->groupBy('u.nama')
                    ->groupBy('p.pembeli')
                    ->groupBy('p.penjualan_id')
                    ->groupBy('p.penjualan_kode')
                    ->groupBy('penjualan_tanggal')
                    ->orderBy('p.penjualan_id', 'desc')
                    ->get();
            } else {
                $transactions = (object) DB::table('t_penjualan as p')
                    ->join('t_penjualan_detail as pd', 'p.penjualan_id', '=', 'pd.penjualan_id')
                    ->join('m_user as u', 'p.user_id', '=', 'u.user_id')
                    ->selectRaw("p.penjualan_id,u.nama, p.pembeli, p.penjualan_kode, DATE_FORMAT(p.penjualan_tanggal, '%d-%m-%Y') as penjualan_tanggal, sum(pd.harga * pd.jumlah) as total")
                    ->groupBy('u.nama')
                    ->groupBy('p.pembeli')
                    ->groupBy('p.penjualan_id')
                    ->groupBy('p.penjualan_kode')
                    ->groupBy('penjualan_tanggal')
                    ->orderBy('p.penjualan_id', 'desc')
                    ->get();
            }
        }

        if (auth()->user()->level->level_nama == 'Member') {
            return DataTables::of($transactions)->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
                ->addColumn('aksi', function ($penjualan) { // menambahkan kolom aksi
                    $btn = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                    return $btn;
                })
                ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
                ->make(true);
        } else {
            return DataTables::of($transactions)->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
                ->addColumn('aksi', function ($penjualan) { // menambahkan kolom aksi
                    $btn = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                    $btn .= '<form class="d-inline-block" method="POST" action="' .
                        url('/penjualan/' . $penjualan->penjualan_id) . '">'
                        . csrf_field() . method_field('DELETE') .
                        '<button type="submit" class="btn btn-danger btn-sm" 
        onclick="return confirm(\'Apakah Anda yakit menghapus data 
        ini?\');">Delete</button></form>';
                    return $btn;
                })
                ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
                ->make(true);
        }
    }


    public function edit(string $id)
    {
        $penjualan = penjualanModel::with('user')->find($id);
        $penjualanDetail = PenjualanDetailModel::where('penjualan_id', $id)->get();

        // dd($penjualanDetail);

        $barang = StokModel::where('stok_jumlah', '>' ,0)->with('barang')->get();
        $user = UserModel::all();


        $breadcrumb = (object) [
            'title' => 'Edit penjualan',
            'list' => ['Home', 'penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit penjualan',
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.edit', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'penjualan' => $penjualan,
            'penjualanDetail' => $penjualanDetail,
            'barang' => $barang,
            'user' => $user,
            'activeMenu' => $activeMenu,
            'unvalidateUser' => userModel::where('status', false)->get()
        ]);
    }

    public function show(string $id)
    {
        $penjualan = penjualanModel::with('user')->find($id);
        $penjualanDetail = PenjualanDetailModel::where('penjualan_id', $id)->with('barang')->get();

        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.show', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'penjualan' => $penjualan,
            'penjualanDetail' => $penjualanDetail,
            'activeMenu' => $activeMenu,
            'unvalidateUser' => UserModel::where('status', false)->get()
        ]);
    }
    
    public function update(Request $request, string $id)
    {

       $request->validate([
            'barang_id' => 'nullable|array',
            'user_id' => 'nullable|integer',
            'pembeli' => 'nullable|string',
            'penjualan_tanggal' => 'nullable|date',
        ]);

        DB::beginTransaction();

        $penjualan = PenjualanModel::find($id);

        // Membuat kode penjualan otomatis pada form edit
        $randomString = Str::random(3);
        $dateNow = \Carbon\Carbon::now()->format('dmY');
        $totalPenjualanHariIni = PenjualanModel::whereDate('penjualan_tanggal', \Carbon\Carbon::today())->count() + 1;
        $penjualanKode = $randomString . '-' . strtoupper($request->pembeli) . '-' . $totalPenjualanHariIni . '-' . $dateNow;

        $penjualan->update(array_merge($request->all(), ['penjualan_kode' => $penjualanKode]));
        
        $barang = BarangModel::all();

        $terjual = $request->only('barang_id');

        if (count($terjual) > 0) {
            PenjualanDetailModel::where('penjualan_id', $id)->delete();

            foreach ($terjual['barang_id'] as $item) {
                PenjualanDetailModel::create([
                    'penjualan_id' => $penjualan->penjualan_id,
                    'barang_id' => $item,
                    'harga' => $barang->find($item)->harga_jual,
                    'jumlah' => 1,
                ]);

                $stok = StokModel::where('barang_id', $item)->with('barang')->first();
                $stok->decrement('stok_jumlah', 1);

                if ($stok->stok_jumlah < 0) {
                    return back()->with('error', 'Stok ' . $stok->barang->barang_nama . ' Tidak Cukup');
                }
            }
        }

        DB::commit();

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil diubah');
    }

    public function store(Request $request)
    {

        $request->validate([
            'barang_id' => 'required|array',
            'user_id' => 'required|integer',
            'pembeli' => 'required|string',
            'penjualan_tanggal' => 'required|date',
        ]);

        // Membuat kode penjualan otomatis
        $randomString = Str::random(3); // Mendapatkan 3 huruf acak
        $dateNow = \Carbon\Carbon::now()->format('dmY');
        $totalPenjualanHariIni = PenjualanModel::whereDate('penjualan_tanggal', \Carbon\Carbon::today())->count() + 1;
        $penjualanKode = $randomString . '-' . strtoupper($request->pembeli) . '-' . $totalPenjualanHariIni . '-' . $dateNow;

        $barang = BarangModel::all();

        $penjualan = PenjualanModel::create([
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_kode' => $penjualanKode,
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);

        $terjual = $request->only('barang_id');

        foreach ($terjual['barang_id'] as $item) {
            PenjualanDetailModel::create([
                'penjualan_id' => $penjualan->penjualan_id,
                'barang_id' => $item,
                'harga' => $barang->find($item)->harga_jual,
                'jumlah' => 1,
            ]);

            $stok = StokModel::where('barang_id', $item)->with('barang')->first();
            $stok->decrement('stok_jumlah', 1);

            if ($stok->stok_jumlah < 0) {
                return back()->with('error', 'Stok ' . $stok->barang->barang_nama . ' Tidak Cukup');
            }
        }

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil disimpan');
    }

    public function destroy(string $id)
    {
        $check = PenjualanModel::find($id);

        if(!$check){
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        try {
            PenjualanDetailModel::where('penjualan_id',$id)->first()->delete();

            PenjualanModel::destroy($id);

            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect('/penjualan')->with('error', 'Data penjualan gagal dihapus');
        }
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Penjualan',
            'list' => ['Home', 'Penjualan', 'Tambah'],
        ];

        $page = (object) [
            'title' => 'Tambah penjualan baru'
        ];

        $barang = StokModel::where('stok_jumlah', '>' ,0)->with('barang')->get();
        $user = UserModel::all();

        $activeMenu = 'penjualan';

        return view('penjualan.create',[
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'barang' => $barang, 
            'user' => $user, 
            'activeMenu' => $activeMenu,
            'unvalidateUser' => userModel::where('status', false)->get()
        ]);
    }

 
}
