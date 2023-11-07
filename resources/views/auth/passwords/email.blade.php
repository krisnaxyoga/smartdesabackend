<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login - {{env('APP_NAME')}}</title>
        <meta name="description" content="ZiBiGI">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
        <link rel="apple-touch-icon" href="{{url('/')}}/theme/assets/images/logo.svg">
        <meta name="apple-mobile-web-app-title" content="{{env('APP_NAME')}}">
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="shortcut icon" sizes="196x196" href="{{url('/')}}/theme/assets/images/logo.svg">
        <link rel="stylesheet" href="{{url('/')}}/theme/libs/font-awesome/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="{{url('/')}}/theme/assets/css/app.min.css">
        <link rel="stylesheet" href="{{url('/')}}/theme/assets/css/style.css">
    </head>
    <body class="login-side">
        <div class="navbar light bg pos-rlt box-shadow">
            <div class="mx-auto">
                <a href="#" class="navbar-brand">
                    <span class="hidden-folded d-inline">{{env('APP_NAME')}}</span>
                </a>
            </div>
        </div>
        <div id="content-body">
            <form class="form-horizontal text-center" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <div class="py-5 w-100">
                    <div class="mx-auto w-xxl w-auto-xs">
                        <div class="px-3">
                            @if (session('status'))
                                <div class="alert alert-success text-center">
                                    Kami sudah mengirimkan e-mail berisi tautan untuk me-reset kata sandi anda.
                                </div>
                            @else
                                <div>
                                    <h5>Lupa kata sandi?</h5>
                                    <p class="text-muted my-3">Masukkan email anda dan kami akan mengirimkan arahan bagaimana cara mengubah kata sandi anda.</p>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}<br>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn primary">Berikutnya</button>
                                </div>
                            @endif
                            <div class="py-4">
                                Kembali ke <a href="{{ url('/login') }}" class="text-primary _600">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script src="{{url('/')}}/theme/scripts/app.min.js"></script>
    </body>
</html>