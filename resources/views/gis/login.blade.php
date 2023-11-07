<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login | Peta Desa</title>
    <meta name="description" content="Login untuk masuk ke Peta Desa .">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <link rel="apple-touch-icon" href="/theme/assets/images/logo.svg">
    <meta name="apple-mobile-web-app-title" content="">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="/theme/assets/images/logo.svg">
    <link rel="stylesheet" href="/theme/libs/font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/theme/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" type="text/css">
    <link rel="stylesheet" href="/theme/assets/css/app.min.css">
    <link rel="stylesheet" href="/theme/assets/css/style.css">
  </head>
  <body class="login-side">
    <div class="row" style="height:inherit">
      <div class="col-lg-8  side-left hidden-xs hidden-sm" style="background-image:linear-gradient(to bottom, rgba(0,0,0,0.6) 0%,rgba(0,0,0,0.6) 100%),url('https://balidenpasartourism.com/wp-content/uploads/2016/01/DSC_0677.jpg'); ">
        <div class="inner" >
          <div class="inner-content">
            <h4>Selamat Datang</h4>
            <h2>Peta Desa </h2>
            <p>Sistem Informasi Pemerintahan & Administrasi Desa
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-12 col-sm-12 side-right">
        <div class="d-flex flex-column flex">
          <div class="navbar light bg pos-rlt box-shadow">
            <div class="mx-auto">
              <a href="/gis" class="navbar-brand">
                Login Peta Desa
              </a>
            </div>
          </div>
          <div id="content-body">
            <form class="form-horizontal" method="POST" action="/gis/login">
              {{ csrf_field() }}
              <div class="w-100">
                <div class="mx-auto w-xxl w-auto-xs">
                  @if (session()->has('error'))
                  <div class="alert mt-5 alert-danger">
                    <span>{{ session('error') }}</span>
                  </div>
                  @endif
                  <div class="form-group text-center pt-3">
                    <label class="text-left d-block">NIK</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control" placeholder="Nomor Induk Kependudukan" name="nik" required value="{{ old('nik') }}" autofocus />
                    </div>
                  </div>
                  <div class="form-group text-center">
                    <label class="text-left d-block">Tanggal Lahir Anda</label>
                    <div class="row">
                      <div class="col-sm-4" style="padding-right: 7.5px">
                        <select name="date" class="form-control">
                          @for ($i = 1; $i <= 31; $i++)
                          <option value="{{ $i }}"{{ old('date') == $i ? ' selected' : '' }}>{{ $i }}</option>
                          @endfor
                        </select>
                      </div>
                      <div class="col-sm-4" style="padding-left: 7.5px; padding-right: 7.5px">
                        <select name="month" class="form-control">
                          @foreach ($months as $key => $value)
                          <option value="{{ $key }}"{{ old('month') == $key ? ' selected' : '' }}>{{ $value }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-sm-4" style="padding-left: 7.5px">
                        <select name="year" class="form-control">
                          @for ($i = date('Y'); $i >= (date('Y') - 120); $i--)
                          <option value="{{ $i }}"{{ old('year') == $i ? ' selected' : '' }}>{{ $i }}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn primary btn-rounded btn-block">LOGIN</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>