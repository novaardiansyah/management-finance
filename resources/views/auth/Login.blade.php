@extends('layouts.auth.Main')

@section('content')
  <div class="login-box">
    <div class="login-logo">
      <a href="/">{{ env('APP_NAME') }}</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{ url('auth/login') }}" method="post">
          @csrf

          <div class="input-group mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
              placeholder="Email" />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>

            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          {{-- input-group --}}

          <div class="input-group mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
              id="password" placeholder="Password" />

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fa fa-fw fa-eye" onclick="return toggle_password(event)"></span>
              </div>
            </div>

            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          {{-- input-group --}}

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="{{ url('auth/register') }}" class="text-center">Register a new account</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
@endsection

@section('scripts')
  @if (session()->has('success'))
    <script>
      sweet_alert('success', `{{ session()->get('success') }}`);
    </script>
  @endif

  <script>
    const toggle_password = (event) => {
      let password = $('#password')
      let confirm_password = $('#confirm_password')

      if (password.attr('type') == 'password') {
        password.attr('type', 'text')
        confirm_password.attr('type', 'text')
        $(event.target).removeClass('fa-eye').addClass('fa-eye-slash')
      } else {
        password.attr('type', 'password')
        confirm_password.attr('type', 'password')
        $(event.target).removeClass('fa-eye-slash').addClass('fa-eye')
      }
    }
  </script>
@endsection
