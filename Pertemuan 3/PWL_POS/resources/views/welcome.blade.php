@extends('layouts.template')

@section('content')

<div class="card">
    @if (auth()->user()->level->level_nama != 'Member')
    <div class="card-header">
        <h1 class="card-title">Selamat Datang Admin!</h1>
        <div class="card-tools"></div>
    </div>
    @endif
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        @if (auth()->user()->level->level_nama != 'Member')
        <div class="row">
            <div class="col-md-6">
                <div class="chart-wrapper">
                    {!! $userChart->container() !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-wrapper">
                    {!! $transaksiChart->container() !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="chart-wrapper">
                {!! $stockChart->container() !!}
            </div>
        </div>
        <div class="table-wrapper container-fluid mt-4">
            <div class="title">
                <strong>DAFTAR MEMBER</strong>
            </div>
            <div class="btn-wrapper d-flex justify-content-end mb-3">
                <a href="{{route('exportPdf')}}" class="btn btn-danger mr-2">Export PDF <i
                        class="ml-1 far fa-file-pdf"></i></a>
                <a href="{{route('exportExcel')}}" class="btn btn-success">Export Excel <i
                        class="ml-1 far fa-file-excel"></i></a>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Status Validasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        @else
        <td>
        <a href="/member/{{auth()->user()->user_id}}/edit" class="btn btn-warning btn-sm">Edit</a>
        </td>
        <table class="table table-bordered table-striped table-hover table-sm">
            <tr>
                <th>ID</th>
                <td>{{ auth()->user()->user_id }}</td>
            </tr>
            <tr>
                <th>Username</th>
                <td>{{ auth()->user()->username }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ auth()->user()->nama }}</td>
            </tr>
            <tr>
                <th>Level</th>
                <td>{{ auth()->user()->level->level_nama }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ auth()->user()->status == 1 ? 'Validate' : 'Unvalidate' }}</td>
            </tr>
            
            <tr>
                <th>Foto Profil</th>
                <td><img src="{{asset('storage/profil/'.auth()->user()->profil_img)}}" class=" "></td>
            </tr>
        </table>
        {{-- <td>
            <a href="{{'', auth()->user()->id) }}" class="btn btn-primary">Edit</a>
        </td> --}}
        {{-- <a href='member/edit'.auth()->user()->user_id>link text</a> --}}
        @endif
    </div>
</div>

@endsection

@push('css')
@endpush

@push('js')
<script src="{{ $userChart->cdn() }}"></script>
{{ $userChart->script() }}
<script src="{{ $transaksiChart->cdn() }}"></script>
{{ $transaksiChart->script() }}
<script src="{{ $stockChart->cdn() }}"></script>
{{ $stockChart->script() }}
<script>
    $(document).ready(function() {
    var dataUser = $('#table_user').DataTable({
    serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
    ajax: {
    "url": "{{ url('dashboard/list') }}",
    "dataType": "json",
    "type": "POST",
    "data": function(d) {
      d.level_id = $('#level_id').val();
    },
    },

    columns: [
    {
    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
    className: "text-center",
    orderable: false,
    searchable: false
    },{
    data: "username", 
    className: "",
    orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
    searchable: true // searchable: true, jika ingin kolom ini bisa dicari
    },{
    data: "nama", 
    className: "",
    orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
    searchable: true // searchable: true, jika ingin kolom ini bisa dicari
    },{
    data: "level.level_nama", 
    className: "",
    orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
    searchable: false // searchable: true, jika ingin kolom ini bisa dicari
    },{
        data: "status", 
    className: "",
    orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
    searchable: false // searchable: true, jika ingin kolom ini bisa dicari
    },{
    data: "aksi", 
    className: "",
    orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
    searchable: false // searchable: true, jika ingin kolom ini bisa dicari
    }
    ]
    });

    $('#level_id').on('change', function() {
      dataUser.ajax.reload()
    });
});
</script>
@endpush
