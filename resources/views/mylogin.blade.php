<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- css -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
      body {
        background-image: url("{{ asset('assets/img/wp.jpg')}}");
      }

      .login {
        padding-top: 110px;
      }
    </style>
</head>
<body>
    
<!-- login start -->
<section class="login">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xxl-11">
        <div class="card shadow-sm">
          <div class="row g-0">
            <div class="col-12 col-md-6">
              <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="{{ asset('assets/img/wp2.jpg')}}" alt="Welcome back you've been missed!">
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
              <div class="col-12 col-lg-11 col-xl-10">
                <div class="card-body p-3 p-md-4 p-xl-5">
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-4">
                        <h4 class="text-center fw-bold">LOGIN</h3>
                      </div>
                    </div>
                  </div>
                @yield('content')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- login end -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if($message = Session::get('success'))
  <script>
    Swal.fire('{{ $message }}');
  </script>
@endif

@if($message = Session::get('failed'))
  <script>
    Swal.fire('{{ $message }}');
  </script>
@endif
</body>
</html>