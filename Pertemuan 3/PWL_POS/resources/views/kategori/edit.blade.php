@extends('layout.app')

@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Update')

@section('content')
<div class="container-fluid">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Edit Kategori</h3>
    </div>

    <form action="/kategori/update/{{ $data->kategori_id }}" method="post">
        @csrf
        @method('PUT')  
        <div class="card-body">
            <div class="form-group">
                <label for="kodeKategori">Kode Kategori</label>
                <input type="text" class="form-control" id="kodeKategori" name="kodeKategori"
                    placeholder="Kode Kategori" value="{{ $data->kategori_kode }}">
            </div>
            <div class="form-group">
                <label for="namaKategori">Nama Kategori</label>
                <input type="text" class="form-control" id="namaKategori" name="namaKategori"
                    placeholder="Nama Kategori" value="{{ $data->kategori_nama }}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
  </div>
</div>
@endsection
