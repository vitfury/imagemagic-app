<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="noindex,nofollow">
    <title>Sticker.pub</title>
    <link rel="preload" href="uikit/styles.css" as="style">
    <link href="uikit/styles.css" rel="stylesheet" />

    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.png" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XEBP0KQEXK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-XEBP0KQEXK');
    </script>
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="dist/styles-admin.css" />
    <link rel="stylesheet" href="dist/styles-admin-custom.css" />
</head>
    <body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11">
                            <!-- Social login form-->
                            <div class="card my-5">
                                <div class="card-body text-center">
                                    <div class="h3 font-weight-light mb-3">Sign In</div>
                                    <!-- Social login links-->
                                    <div class="socialsLoginLinks">
                                        <a class="btn btn-icon btn-facebook mx-1 social-buttons" href="/login/facebook"><i class="fab fa-facebook-f fa-fw fa-sm social-buttons__svg"></i></a>
                                        <a class="btn btn-icon btn-github mx-1 social-buttons" href="/login/github"><i class="fab fa-github fa-fw fa-sm social-buttons__svg"></i></a>
                                        <a class="btn btn-icon btn-google mx-1 social-buttons" href="/login/google"><i class="fab fa-google fa-fw fa-sm social-buttons__svg"></i></a>
                                    </div>
                                </div>


                                <hr class="my-0" />
                                <div class="card-body">
                                    <!-- Login form-->
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <!-- Form Group (email address)-->
                                        <div class="form-group">
                                            <label class="text-gray-600 small" for="email">{{ __('E-Mail Address') }}</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Form Group (password)-->
                                        <div class="form-group">
                                            <label class="text-gray-600 small" for="password">Password</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <!-- Form Group (forgot password link)-->
                                        @if (Route::has('password.request'))
                                             <div class="form-group"><a class="small" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a></div>
                                        <!-- Form Group (login box)-->
                                        @endif
                                        <div class="form-group d-flex align-items-center justify-content-between mb-0">
                                            <div class="custom-control custom-control-solid custom-checkbox">
                                                <input class="custom-control-input small" name="remember" id="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }} />
                                                <label class="custom-control-label" for="remember"> {{ __('Remember Me') }}</label>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <hr class="my-0" />
                                <div class="card-body px-5 py-4">
                                    <div class="small text-center">
                                        New user?
                                        <a href="/register">Create an account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <div id="layoutAuthentication_footer">
                <footer class="footer mt-auto footer-dark">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 small"> &copy; Sticker.Pub 2020</div>
                            <div class="col-md-6 text-md-right small">
                                <a href="/privacy-policy">Privacy Policy</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    </body>
</html>
