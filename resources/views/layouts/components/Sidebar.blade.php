<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" class="img-circle elevation-2"
        alt="Brand Image" />
    </div>
    <div class="info">
      <a href="#" class="d-block">Nova Ardiansyah</a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="{{ url('back/dashboard') }}" class="nav-link {{ request()->is('back/dashboard') ? 'active' : '' }}">
          <i class="nav-icon fa fa-fw fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('back/posts') }}" class="nav-link {{ request()->is('back/posts') ? 'active' : '' }}">
          <i class="nav-icon fa fa-fw fa-newspaper"></i>
          <p>
            Posts
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-fw fa-code"></i>
          <p>
            Layouts
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="../../index.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Fixed Layout</p>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
