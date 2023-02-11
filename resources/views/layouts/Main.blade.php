<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- csrf-token --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ env('APP_NAME') }}</title>

  {{-- Favicon --}}
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/fontawesome-free/css/all.min.css') }}" />
  <!-- Datatables -->
  <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}" />
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('/vendor/adminlte/plugins/select2/css/select2.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('/vendor/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />
  <!-- Summernote -->
  <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/summernote/summernote-bs4.css') }}" />
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}" />
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
  <!-- Site wrapper -->
  <div class="wrapper">
    @include('layouts.components.Navbar')

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      @include('layouts.components.Sidebar')
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h5>{{ $title ?? 'Page Title' }}</h5>
            </div>
            @include('layouts.components.Breadcrumb')
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content pb-3">
        <div class="container-fluid">
          @yield('content')
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('layouts.components.Footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('vendor/adminlte/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Datatables -->
  <script src="{{ asset('vendor/adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('vendor/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ asset('vendor/adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <!-- SweetAlert2 -->
  <script src="{{ asset('vendor/adminlte/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

  <script>
    const config = {
      base_url: '{{ url('/') }}',
      asset_url: '{{ asset('') }}',
      csrf_token: '{{ csrf_token() }}'
    }

    function url(path = '') {
      return config.base_url + '/' + path
    }

    function asset(path = '') {
      return config.asset_url + path
    }
  </script>

  <!-- Core App -->
  <script src="{{ asset('js/app/utils.js?v=') . time() }}"></script>

  @yield('scripts')
</body>

</html>
