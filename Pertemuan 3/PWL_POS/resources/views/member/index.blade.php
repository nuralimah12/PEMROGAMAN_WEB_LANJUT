@extends('layouts.template')

@section('content')

<div class="card">
    <div class="card-header">
        <h1 class="card-title">History Pembelian</h1>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Penjualan</th>
                    <th>Tanggal Penjualan</th>
                    <th>Total Harga</th>
                    <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                </tr>
            </thead>
            <tbody>
                @foreach($penjualan as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->penjualan_kode }}</td>
                    <td>{{ $data->penjualan_tanggal }}</td>
                    <td>{{ $data->total }}</td>
                    <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
