@php
  use App\Models\Menu;
  $menus = Menu::where(['is_active' => 1, 'is_deleted' => 0])->with('submenus')->orderBy('name', 'asc')->get();
@endphp

<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" class="img-circle elevation-2" alt="Brand Image" />
    </div>
    <div class="info">
      <a href="#" class="d-block">Nova Ardiansyah</a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      @foreach ($menus as $menu)
        @if (count($menu->submenus) > 0)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-fw {{ $menu->icon }}"></i>
              <p>
                {{ $menu->name }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @foreach ($menu->submenus as $submenu)
                <li class="nav-item">
                  <a href="{{ url($submenu->url) }}" class="nav-link {{ request()->is(substr($submenu->url, 1)) ? 'active' : '' }}">
                    <i class="fa fa-fw {{ $submenu->icon }} nav-icon"></i>
                    <p>{{ $submenu->name }}</p>
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @else
          <li class="nav-item">
            <a href="{{ url($menu->url) }}" class="nav-link {{ request()->is(substr($menu->url, 1)) ? 'active' : '' }}">
              <i class="nav-icon fa fa-fw {{ $menu->icon }}"></i>
              <p>{{ $menu->name }}</p>
            </a>
          </li>
        @endif
      @endforeach
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
