<?php

namespace App\Http\Controllers;

use App\Charts\userChart;
use App\Exports\UsersExport;
use App\Models\UserModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class WelcomeController extends Controller
{
        public function index(userChart $chart)
    {
        $breadcrumb = (object) [
            'title' => 'Welcome',
            'list' => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';

        $members = UserModel::where('status', 0)->get();

        return view('welcome', ['breadcrumb' => $breadcrumb, 'members' => $members, 'chart' => $chart->build(),'activeMenu' => $activeMenu]);
    }

    

    public function list(Request $request)
    {
        $users = UserModel::with('level')
                ->whereRelation('level', 'level_nama', 'Member' );

        if($request->level_id){
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
        $btn = '<a href="'.url('/dashboard/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> ';
        $btn .= '<a href="'.url('/dashboard/validasiStatus/' . $user->user_id ).'" class="btn btn-warning btn-sm">'.($user->status == 0 ? 'Validate' : 'Unvalidate' ).'</a> ';
        $btn .= '<form class="d-inline-block" method="POST" action="'. url('/dashboard/'.$user->user_id).'">'. csrf_field() . method_field('DELETE') . 
        '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Delete</button></form>'; 
        
        return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    public function validasiStatus(Request $request, $id){
        $user = UserModel::find($id);

        $user->update([
            'status' => !(bool) $user->status
        ]);

        return redirect()->route('dashboard');
    }

    

    public function exportPdf(){
        $members = UserModel::with('level')->whereRelation('level', 'level_nama', 'Member')->get();

        $pdf = Pdf::loadView('tabelMember', [
            'members'=> $members, 
            'title'=> 'Data Member'
        ]);
        return response()->streamDownload(function() use($pdf){
            echo $pdf->stream();
        }, 'Daftar Member.pdf');
    }

    public function exportExcel(){
        return Excel::download(new UsersExport, 'Data_Member_PWL_POS.xlsx');
    }

    public function show(string $id)
    {
        $user = userModel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail user'    
        ];

        $activeMenu = 'user';

        return view('user.show', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }

    public function destroy(string $id) {
        $check = UserModel::find($id);
        if (!$check) {      // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('dashboard')->with('error', 'Data user tidak ditemukan');
        }

        try {
            UserModel::destroy($id);   // Hapus data level

            return redirect('/')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {

            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('dashboard')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
