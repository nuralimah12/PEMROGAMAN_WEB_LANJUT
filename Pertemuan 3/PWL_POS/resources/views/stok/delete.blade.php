@extends('layouts.template') 
 
@section('content') 
  <div class="card card-outline card-primary"> 
    <div class="card-header"> 
      <h3 class="card-title">{{ $page->title }}</h3> 
      <div class="card-tools"></div> 
    </div> 
    <div class="card-body"> 
      @empty($stok) 
        <div class="alert alert-danger alert-dismissible"> 
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> 
            Data yang Anda cari tidak ditemukan. 
        </div> 
        <a href="{{ url('stok') }}" class="btn btn-sm btn-default mt2">Kembali</a> 
      @else 
        <form method="POST" action="{{ url('/stok/'.$stok->stok_id) }}" 
class="form-horizontal"> 

@csrf 
          {!! method_field('PUT') !!}  <!-- tambahkan baris ini untuk proses edit yang butuh method PUT --> 
          <div class="form-group row"> 
            <label class="col-1 control-label col-form-label">Barang ID</label> 
            <div class="col-11"> 
              <select class="form-control" id="barang_id" name="barang_id" required> 
                <option value="">- Pilih Barang ID -</option> 
                @foreach($barang as $item) 
                  <option value="{{ $item->barang_id }}" @if($item->barang_id == $user->barang_id) selected @endif>{{ $item->barang_id }}</option> 
                @endforeach 
              </select> 
              @error('level_id') 
                <small class="form-text text-danger">{{ $message }}</small> 
              @enderror 
            </div> 
          </div> 
          <div class="form-group row"> 
            <label class="col-1 control-label col-form-label">User ID</label> 
            <div class="col-11"> 
              <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required> 
              @error('username') 
                <small class="form-text text-danger">{{ $message }}</small> 
              @enderror 
            </div> 
          </div> 
          <div class="form-group row"> 
            <label class="col-1 control-label col-form-label">Nama</label> 
            <div class="col-11"> 
              <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required> 
              @error('nama') 
                <small class="form-text text-danger">{{ $message }}</small> 
              @enderror 
            </div> 
          </div> 
          <div class="form-group row"> 
            <label class="col-1 control-label col-form-label">Password</label> 
            <div class="col-11"> 
              <input type="password" class="form-control" id="password" name="password"> 
              @error('password') 
                <small class="form-text text-danger">{{ $message }}</small>
                @else 
                <small class="form-text text-muted">Abaikan (jangan diisi) jika tidak ingin mengganti password user.</small> 
              @enderror 
            </div> 
          </div> 
          <div class="form-group row"> 
            <label class="col-1 control-label col-form-label"></label> 
            <div class="col-11"> 
              <button type="submit" class="btn btn-primary btn-sm">Simpan</button> 
              <a class="btn btn-sm btn-default ml-1" href="{{ url('user') }}">Kembali</a> 
            </div> 
          </div> 
        </form> 
      @endempty 
    </div> 
  </div> 
@endsection 
 
@push('css') 
@endpush 
@push('js') 
@endpush 