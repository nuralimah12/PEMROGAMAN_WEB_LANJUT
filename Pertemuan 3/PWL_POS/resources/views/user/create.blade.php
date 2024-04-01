@extends('layout.app')

@section('subtitle', 'User')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Create')

@section('content')
<div class="container-fluid">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Buat User baru</h3>
    </div>

    <form action="/user" method="post">
      <div class="card-body">
        </div>
        <div class="form-group">
            <label for="levelId">Level Id</label>
            <input type="number" name="levelId" id="levelId" placeholder="contoh: 1" class="form-control">
          </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" placeholder="contoh: admin" class="form-control">
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" placeholder="contoh: Administrator"
              class="form-control">
        <div class="form-group">
            <label for="password">Masukkan Password</label>
            <input type="password" name="password" id="password" placeholder="Masukan Password" class="form-control">
          </div>

        <div class=" card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection