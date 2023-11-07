<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>Login - {{env('APP_NAME')}}</title>
      <meta name="description" content="Desa Integrasi System Teknologi Informasi (PAYKITAZ-DISTI) ">
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

    <div class="row" style="height:inherit">
      <div class="col-lg-8  side-left hidden-xs hidden-sm" style="background-image:linear-gradient(to bottom, rgb(0 0 0 / 0%) 0%,rgba(0,0,0,0.6) 100%),url({{url('/')}}/images/180119045057kabupaten-oku-timut-1.png); ">
      <div class="welcome-world">
        <div class="welcome-world-content">
          <h2>Selamat Datang</h2>
          <h3>Desa Integrasi System Teknologi Informasi</h3>
          <h4>(PAYKITAZ-DISTI)</h4>
        </div>
      </div>

    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 side-right bg-login">

      <div class="d-flex flex-column flex">
         <div class="navbar indigo bg-login pos-rlt navbar-login">
            <div class="mx-auto col-md-9 w-auto-xs">
               <a href="#" class="navbar-brand navbar-brand-login">
                  <span class="hidden-folded d-inline">Paykitaz - Disti</span>
               </a>
            </div>
         </div>
         <div id="content-body">
         <form class="form-horizontal" method="POST" action="{{ route('login') }}">
         {{ csrf_field() }}
            <div class="py-5 w-100">
               <div class="mx-auto col-md-9 w-auto-xs">
                  <div class="px-3">
                    @if ($errors->any())
                      <div class="alert alert-danger">
                          @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                        <div class="form-group">
                          <label class="title-form">Login</label>
                        </div>
                        <div class="form-group">
                            <label for="Username" class="label-login">Username</label>
                            <input type="username" class="form-control" id="Username" name="username" value="{{ old('username')}}" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="Username" class="label-login">Password</label>
                            <input type="password" class="form-control" placeholder="Kata sandi"  name="password" required>
                        </div>
			<input type="hidden" name="kode_desa" value="PAJAHAN">
                        <!--div class="form-group">
                            <label for="Username">Kode Desa</label>
                            <input type="kode_desa" class="form-control" placeholder="Kode Desa" name="kode_desa" value="{{ old('kode_desa') }}" required>
                        </div-->
                        <div class="mb-3 text-center pull-right label-remember"><label class="md-check"><input {{ old('remember') ? 'checked' : '' }} type="checkbox"><i class="primary"></i> Ingat saya</label></div>
                        <button type="submit" class="btn btn-rounded btn-login col-12">Masuk</button>

                     <div class="my-4 text-center" style="display:none;"><a href="{{ route('password.request') }}"class="text-primary _600">Lupa kata sandi?</a></div>

                  </div>
               </div>
            </div>
        </form>
         </div>
      </div>

      </div>
    </div>

      <script src="{{url('/')}}/theme/scripts/app.min.js"></script>
   </body>
</html>
