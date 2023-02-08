@extends('layouts.auth.Main')

@section('content')
  <div class="register-box">
    <div class="register-logo">
      <a href="/">{{ env('APP_NAME') }}</a>
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new account</p>

        <form action="{{ url('auth/register') }}" method="post">
          @csrf

          <div class="input-group mb-3">
            <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" id="fullname" placeholder="Fullname" value="{{ old('fullname') }}" />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fa fa-fw fa-user"></span>
              </div>
            </div>

            @error('fullname')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          {{-- input-group --}}

          <div class="input-group mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}" />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fa fa-fw fa-envelope"></span>
              </div>
            </div>

            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          {{-- input-group --}}

          <div class="input-group mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" />
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

          <div class="input-group mb-3">
            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password"
              id="confirm_password" placeholder="Confirm Password" />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fa fa-fw fa-lock"></span>
              </div>
            </div>

            @error('confirm_password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          {{-- input-group --}}

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                <label for="agreeTerms">
                  I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <a href="{{ url('auth/login') }}" class="text-center">I already have an account</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->
@endsection

@section('scripts')
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
