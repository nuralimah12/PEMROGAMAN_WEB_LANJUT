<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Blank Page</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            @foreach ($breadcrumb->list as $key => $value)
            @if ($key == count($breadcrumb->list) - 1)
            <li class="breadcrumb-item active">{{$value}}</li>
            @endif
            <li class="breadcrumb-item">{{$value}}</li>
            @endforeach
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
