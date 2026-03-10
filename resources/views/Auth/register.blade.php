<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/typicons/typicons.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset(" admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css") }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
              </div>
              <h4>New here?</h4>
              <h6 class="fw-light">Signing up is easy. It only takes a few steps</h6>
              <form class="pt-3" action="{{ route('register.store') }}" method="post">
                @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                  <strong>{{ session()->get('error') }}</strong>
                </div>

                @endif
                <div class="form-group">
                  @csrf
                  <input type="text" class="form-control form-control-lg @error('full_name') is-invalid @enderror"
                    value="{{ old('full_name') }}" name="full_name" id="exampleInputUsername1" placeholder="Full Name">
                  @error('full_name')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" name="email" id="exampleInputEmail1" placeholder="Email">
                  @error('email')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                    name="password" id="exampleInputPassword1" placeholder="Password">
                  @error('password')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="mt-3 d-grid gap-2">
                  <button class="btn  btn-primary btn-lg fw-medium">SIGN UP</button>
                </div>
                <div class="text-center mt-4 fw-light">
                  Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a>
                </div>

                <div class="text-center mt-4 fw-light">
                  <a href="{{ route('google.redirect') }}" class="text-primary"><img
                      src="{{ asset('defaultImage/googleimg.webp') }}" width="200" alt="google"></a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
  <script src="{{ asset(" admin/js/template.js") }}"></script>
  <script src="{{ asset('admin/js/settings.js') }}"></script>
  <script src="{{ asset(" admin/js/hoverable-collapse.js") }}"></script>
  <script src="{{ asset('admin/js/todolist.js') }}"></script>
  <!-- endinject -->
</body>

</html>