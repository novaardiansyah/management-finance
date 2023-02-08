<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> {{ env('APP_VERSION', '1.0.1') }}
  </div>
  <strong>Copyright &copy; 2022-{{ date('Y') }} <a
      href="https://github.com/novaardiansyah">{{ env('APP_COPYRIGHT', 'Nova Ardiansyah') }}</a></strong> All rights
  reserved.
</footer>
