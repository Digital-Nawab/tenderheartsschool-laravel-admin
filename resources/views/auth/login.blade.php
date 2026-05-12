<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

<head>
    <meta charset="utf-8" />
    <title>Sign In | THS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium  Admin & Dashboard  by digital Nawab" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets')}}/images/favicon.ico">
    <!-- Layout config Js -->
   <!-- Bootstrap Css -->
    <link href="{{asset('assets')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets')}}/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
</head>

<body>
    <div class="auth-page-wrapper pt-5">
        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <!-- end row -->
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            @if (session('status'))
                                <div class="mb-4 text-green-500">
                                    {{ session('status') }}
                                </div>
                            @endif
                                {{-- Validation errors --}}
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to THS.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form method="POST" action="{{ route('login') }}">
                                       @csrf
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control" id="email" placeholder="Enter Email" required
                                                autofocus autocomplete="username">
                                            @if ($errors->has('email'))
                                                <span class="mt-2 text-red-500">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5" name="password"
                                                    required autocomplete="current-password"
                                                    placeholder="Enter password" id="password">
                                                {{-- <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i>
                                                </button> --}}
                                                @if ($errors->has('password'))
                                                    <span
                                                        class="mt-2 text-red-500">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" id="remember" type="checkbox" name="remember">
                                            <label class="form-check-label" for="remember">Remember me</label>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
    </div>
    <script src="{{asset('assets')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
