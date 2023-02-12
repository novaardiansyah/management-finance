<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    @if (isset($breadcrumbs))
      @foreach ($breadcrumbs as $breadcrumb)
        @if ($loop->last)
          <li class="breadcrumb-item active">{{ $breadcrumb['name'] }}</li>
        @else
          <li class="breadcrumb-item"><a href="{{ url($breadcrumb['url']) }}">{{ $breadcrumb['name'] }}</a></li>
        @endif
      @endforeach
    @endif
  </ol>
</div>