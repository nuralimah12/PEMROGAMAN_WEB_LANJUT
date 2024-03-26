@extends('layout.app')

@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Create')

@section('content')
<div class="container-fluid">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Buat kategori baru</h3>
    </div>

    <form action="../kategori" method="post">
      <div class="card-body">
        <div class="form-group">
          <label for="kodeKategori">Kode Kategori</label>
          <input type="text" name="kodeKategori" id="kodeKategori" placeholder="contoh: MKN"
            class="form-control">
        </div>
        <div class="form-group">
          <label for="kodeKategori">Nama Kategori</label>
          <input type="text" name="namaKategori" id="namaKategori" placeholder="Nama" class="form-control">
        </div>

        <div class=" card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection