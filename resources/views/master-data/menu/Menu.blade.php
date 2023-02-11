@extends('layouts.Main')

@section('content')
  <div class="row pb-3">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="left" title="Create a new post" onclick="return modalCreate()">
                <i class="fa fa-fw fa-plus"></i> Add
              </button>
            </div>
          </div>

          <hr class="my-3" />

          <table id="listMenu" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Icon</th>
                <th>Url</th>
                <th>Status</th>
                <th>::</th>
              </tr>
            </thead>
            <tbody>
              {{-- content here --}}
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

  @include(env('BS4_COMPONENTS_PATH', '') . '/modal/backdropVerticalCentered')
@endsection

@section('scripts')
  <script src="{{ asset('js/master-data/menu/menu.js?v=') . time() }}"></script>
@endsection
