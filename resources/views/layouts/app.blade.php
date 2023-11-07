<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title') - DISTI {{Auth::user()->desa->nama_desa}}</title>
    <meta name="description" content="Smart Desa {{Auth::user()->desa->nama_desa}}">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- for ios 7 style, multi-resolution icon of 152x152 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <link rel="apple-touch-icon" href="/theme/assets/images/logo.svg">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="/theme/assets/images/logo.svg">


    <!-- style -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="/theme/libs/font-awesome/css/font-awesome.min.css" type="text/css"/>
    {{-- <script src="/theme/libs/ckeditor/ckeditor.js"></script> --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/11.1.1/classic/ckeditor.js"></script>

    <!-- build:css ../theme/assets/css/app.min.css -->
    <link rel="stylesheet" href="/theme/libs/bootstrap/dist/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="/theme/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"
          type="text/css"/>
    <link rel="stylesheet" href="/theme/libs/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css"
          type="text/css"/>
    <link rel="stylesheet" href="/theme/libs/summernote/dist/summernote.css" type="text/css"/>
    <link rel="stylesheet" href="/theme/libs/select2/dist/css/select2.min.css" type="text/css"/>
    <link rel="stylesheet" href="/theme/libs/summernote/dist/summernote-bs4.css" type="text/css"/>
    <link rel="stylesheet" href="/theme/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" type="text/css"/>
    <link rel="stylesheet" href="/theme/assets/css/theme/success.css" type="text/css"/>
    <link rel="stylesheet" href="/theme/assets/css/app.css" type="text/css"/>
    <link rel="stylesheet" href="/theme/assets/css/style.css" type="text/css"/>
    <link rel="stylesheet" href="/css/custom.css" type="text/css"/>
    <!-- endbuild -->
</head>
<body ui-class="fixed-aside fixed-content">

<header class="app-header dark indigo header-admin">
    <div class="navbar bg-admin navbar-expand-lg ">

        <!-- Page title -->
        <!-- brand -->
        <a href="{{url('/')}}" class="navbar-brand">
            <b class="text-white text-desa">{{Auth::user()->desa->nama_desa}}</b>
        </a>
        <!-- / brand -->

        <ul class="nav flex-row order-lg-5">

            <!-- User dropdown menu -->
            <li class="dropdown d-flex align-items-center">
                <a href="#" data-toggle="dropdown" class="d-flex align-items-center text-white">
                    <span
                        class='avatar text-sm w-32 d-inline-flex lime'>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>

                    <span
                        class="dropdown-toggle mx-2 d-none l-h-1x d-lg-block"><span>{{Auth::user()->name}}</span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right w pt-0 mt-2 animate fadeIn">

                    <a class="dropdown-item" href="{{url('profile')}}"><span>Profile</span> </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">Sign out</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>


                </div>
            </li>
            <!-- Navarbar toggle btn -->
            <li class="d-lg-none d-flex align-items-center">
                <a href="#" class="mx-2" data-toggle="collapse" data-target="#navbarToggler">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512">
                        <path d="M64 144h384v32H64zM64 240h384v32H64zM64 336h384v32H64z"/>
                    </svg>
                </a>
            </li>
        </ul>
        <!-- Navbar collapse -->
        <div class="collapse navbar-collapse navbar-dark order-lg-2 menu-admin" id="navbarToggler">
            <ul class="navbar-nav mt-2 mt-lg-0 mx-0 mx-lg-5">
                <li class="nav-item">
                    <a href="{{url('/')}}" class="nav-link menu-admin-link">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </a>
                </li>


                <li class="nav-item dropdown">
                    <a href="#" class="nav-link menu-admin-link" data-toggle="dropdown">
                        <i class="fa fa-male"></i> Kependudukan
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mt-2 text-color" role="menu">

                        <a href="{{route('penduduk.index')}}" class="dropdown-item">
                            <i class="fa fa-male"></i>
                            Data Penduduk
                        </a>
                        <a href="{{route('statistik.penduduk')}}" class="dropdown-item">
                            <i class="fa fa-bar-chart"></i>
                            Statistik Kependudukan
                        </a>

                        <a href="{{route('keluarga.index')}}" class="dropdown-item">
                            <i class="fa fa-user-circle"></i>
                            Data Keluarga
                        </a>

                        <a href="{{route('bantuan.index')}}" class="dropdown-item">
                            <i class="fa fa-heart"></i>
                            Program / Bantuan
                        </a>


                        <a href="{{route('kelompok.index')}}" class="dropdown-item">
                            <i class="fa fa-users"></i>
                            Kelompok
                        </a>

                        <a href="{{route('kategori-kelompok.index')}}" class="dropdown-item">
                            <i class="fa fa-server"></i>
                            Kategori Kelompok
                        </a>

                        <hr class="dropdown-divider">

                        <a href="{{route('penduduk-pendatang.index')}}" class="dropdown-item">
                            <i class="fa fa-male"></i>
                            Data Penduduk Pendatang
                        </a>

                    </div>

                </li>

                <!--li class="nav-item dropdown">
                    <a href="#" class="nav-link " data-toggle="dropdown">
                        <i class="fa fa-money"></i> E-Planning
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mt-2 text-color" role="menu">
                        <a href="/e-planning/rkp-desa" class="dropdown-item">
                            <i class="fa fa-university"></i>
                            RKP
                        </a>
                        <a href="/e-planning/rab-desa" class="dropdown-item">
                            <i class="fa fa-balance-scale"></i>
                            RAB
                        </a>
                        <a href="/#!" class="dropdown-item">
                            <i class="fa fa-users"></i>
                            RKKD
                        </a>
                        <a href="/e-planning/bidang" class="dropdown-item">
                            <i class="fa  fa-th-large"></i>
                            Bidang
                        </a>
                        <a href="/e-planning/usulan-desa" class="dropdown-item">
                            <i class="fa fa-list-alt"></i>
                            Usulan Desa
                        </a>
                        <a href="/e-planning/usulan-dusun/" class="dropdown-item">
                            <i class="fa fa-list-alt"></i>
                            Usulan Masyarakat
                        </a>
                        <a href="/e-planning/barang/" class="dropdown-item">
                            <i class="fa fa-list-alt"></i>
                            Barang
                        </a>
                        <a href="/e-planning/kategori-barang/" class="dropdown-item">
                            <i class="fa fa-list-alt"></i>
                            Kategori Barang
                        </a>
                    </div>
                </li-->

            <!--li class="nav-item dropdown">
                <a href="#" class="nav-link" data-toggle="dropdown">
                    <i class="fa fa-archive"></i> Aset
                </a>
                <div class="dropdown-menu dropdown-menu-right mt-2 text-color" role="menu">
                    <a  href="{{route('aset.index')}}" class="dropdown-item">
                        <i class="fa fa-archive"></i>
                        Aset
                    </a>
                    <a  href="{{route('kategori-aset.index')}}" class="dropdown-item">
                        <i class="fa fa-list-ul"></i>
                        Kategori Aset
                    </a>
                </div>

            </li-->
            <!-- <li class="nav-item dropdown">
                <a href="#" class="nav-link" data-toggle="dropdown">
                <i class="fa fa-pie-chart"></i> Statistik
                </a>
                <div class="dropdown-menu dropdown-menu-right mt-2 text-color" role="menu">
                    <a  href="{{route('statistik.penduduk')}}" class="dropdown-item">
                        <i class="fa fa-wheelchair"></i>
                        Statistik Kependudukan
                    </a>

                    {{-- <a  href="{{route('keluarga.index')}}" class="dropdown-item">
                        <i class="fa fa-female"></i>
                        Laporan Desa
                    </a>
                    --}}

                </div>

        </li> -->

                <!--li class="nav-item dropdown">
                    <a href="#" class="nav-link " data-toggle="dropdown">
                        <i class="fa fa-map"></i> Peta
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mt-2 text-color" role="menu">
                        <a href="/peta" class="dropdown-item">
                            <i class="fa fa-tag"></i>
                            Peta Desa
                        </a>

                        <a href="/peta/lokasi" class="dropdown-item">
                            <i class="fa fa-map-marker"></i>
                            Lokasi
                        </a>

                        <a href="/peta/tipelokasi" class="dropdown-item">
                            <i class="fa fa-map-marker"></i>
                            Tipe Lokasi
                        </a>

                        <a href="/peta/garis" class="dropdown-item">
                            <i class="fa fa-expand"></i>
                            Garis
                        </a>

                        <a href="/peta/tipegaris" class="dropdown-item">
                            <i class="fa  fa-compress"></i>
                            Tipe Garis
                        </a>

                        <a href="/peta/area" class="dropdown-item">
                            <i class="fa fa-area-chart"></i>
                            Area
                        </a>

                        <a href="/peta/tipearea" class="dropdown-item">
                            <i class="fa fa-area-chart"></i>
                            Tipe Area
                        </a>

                    </div>
                </li-->

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link menu-admin-link" data-toggle="dropdown">
                    <i class="fa  fa-newspaper-o"></i> Web
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mt-2 text-color" role="menu">
                        <a href="/slider" class="dropdown-item">
                            <i class="fa fa-newspaper-o"></i>
                            Slider
                        </a>
                        <a href="/berita" class="dropdown-item">
                            <i class="fa fa-newspaper-o"></i>
                            Berita
                        </a>

                        <a href="/kategori-berita" class="dropdown-item">
                            <i class="fa fa-newspaper-o"></i>
                            Kategori Berita
                        </a>



                        <a href="/sejarah" class="dropdown-item">
                            <i class="fa fa-tag"></i>
                            Sejarah
                        </a>

                        <a href="/visimisi" class="dropdown-item">
                            <i class="fa fa-tag"></i>
                            Visi & Misi
                        </a>

                        <a href="/lembaga-masyarakat" class="dropdown-item">
                            <i class="fa fa-users"></i>
                            Lembaga Masyarakat
                        </a>

                        <a href="/lembaga-desa" class="dropdown-item">
                            <i class="fa fa-users"></i>
                            Lembaga Desa
                        </a>


                        <a href="/transparasi-keuangan" class="dropdown-item">
                            <i class="fa fa-file-o"></i>
                            Transparasi Keuangan
                        </a>

                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link menu-admin-link" data-toggle="dropdown">
                        <i class="fa  fa-envelope"></i> Layanan Publik
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mt-2 text-color" role="menu">
                        <!--
                        <a href="/jenis-surat" class="dropdown-item">
                            <i class="fa fa-newspaper-o"></i>
                            Jenis Surat
                        </a>
                        -->
                        <a href="/surat/permohonan" class="dropdown-item">
                            <i class="fa fa-envelope-o"></i>
                            Daftar Permohonan
                        </a>

                        <a href="/surat/cetak" class="dropdown-item">
                            <i class="fa fa-envelope-o"></i>
                            Cetak Surat
                        </a>

                        <a href="/surat" class="dropdown-item">
                            <i class="fa fa-envelope-o"></i>
                            Arsip Surat
                        </a>



                        <a href="/surat/laporan" class="dropdown-item">
                            <i class="fa fa-envelope-o"></i>
                            Rekap Surat Per Kadus
                        </a>

                        <hr class="dropdown-divider">

                        <a href="/notification" class="dropdown-item">
                            <i class="fa fa-bullhorn"></i>
                            Pengumuman
                        </a>

                        <hr class="dropdown-divider"-->

                        <a href="/pengaduan" class="dropdown-item">
                            <i class="fa fa-exclamation-triangle"></i>
                            Pengaduan Masyarakat
                        </a>
                        <a href="/cctv" class="dropdown-item">
                            <i class="fa fa-video-camera"></i>
                            CCTV
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link menu-admin-link" data-toggle="dropdown">
                        <i class="fa fa-gear"></i> Pengaturan
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mt-2 text-color" role="menu">
                        <a href="{{route('desa.edit')}}" class="dropdown-item">
                            <i class="fa fa-building"></i>
                            Informasi Desa
                        </a>
                        <a href="{{route('pamong.index')}}" class="dropdown-item">
                            <i class="fa fa-tag"></i>
                            Staff Desa
                        </a>

                        <hr class="dropdown-divider">

                        <a href="{{route('kepala-dusun.index')}}" class="dropdown-item">
                            <i class="fa fa-user"></i>
                            Kepala Dusun
                        </a>

                        <a href="{{route('wilayah.index')}}" class="dropdown-item">
                            <i class="fa fa-building"></i>
                            Wilayah Administratif
                        </a>

                        <a href="{{route('user.index')}}" class="dropdown-item">
                            <i class="fa fa-user"></i>
                            Pengguna
                        </a>

                    </div>
                </li>


            </ul>
        </div>

    </div>
</header>

<div class="app" id="app">

    <div id="content" class="app-content box-shadow-2 box-radius-2" role="main">
        <div class="content-header white box-shadow-2" id="content-header">
            <div class="navbar navbar-expand-lg">
                <div class="navbar-text nav-title flex" id="pageTitle">@yield('title')</div>
                <div class="pull-right">
                    @yield('action')
                </div>
            </div>
        </div>
        @yield('content')
        <div class="content-footer white" id="content-footer">
            <div class="d-flex p-3">
                <span class="text-sm text-muted flex">&copy; Copyright {{date('Y')}}. {{env('APP_NAME')}}</span>
                <div class="text-sm text-muted">Version 1.0</div>
            </div>
        </div>
    </div>
</div>

<!-- build:js scripts/app.min.js -->
<!-- jQuery -->
<script src="/theme/libs/jquery/dist/jquery.min.js"></script>
<script src="/theme/libs/vue.min.js"></script>
<!-- Bootstrap -->
<script src="/theme/libs/popper.js/dist/umd/popper.min.js"></script>
{{-- <script src="/theme/libs/popper.js/dist/umd/tooltip.min.js"></script> --}}
<script src="/theme/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- core -->
<script src="/theme/libs/moment/min/moment-with-locales.min.js"></script>
<script src="/theme/libs/pace-progress/pace.min.js"></script>
<script src="/theme/libs/pjax/pjax.js"></script>

<script src="/theme/libs/chart.js/dist/Chart.min.js"></script>
<script src="/theme/scripts/plugins/jquery.chart.js"></script>
<script src="/theme/libs/notie/dist/notie.min.js"></script>


<script src="/theme/libs/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/theme/libs/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<script src="/theme/scripts/plugins/datatable.js"></script>

<script src="/theme/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/theme/libs/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>

<script src="/theme/libs/summernote/dist/summernote.min.js"></script>
<script src="/theme/libs/summernote/dist/summernote-bs4.min.js"></script>
<script src="/theme/libs/select2/dist/js/select2.min.js"></script>

<script src="/theme/libs/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="/theme/scripts/lazyload.config.js"></script>
<script src="/theme/scripts/lazyload.js"></script>
<script src="/theme/scripts/plugin.js"></script>
<script src="/theme/scripts/nav.js"></script>
<script src="/theme/scripts/scrollto.js"></script>
<script src="/theme/scripts/toggleclass.js"></script>
<script src="/theme/scripts/theme.js"></script>
<!--<script src="/theme/scripts/ajax.js"></script>-->
<script src="/theme/scripts/app.js"></script>
<script src="{{url('/')}}/js/vue.cdn.js"></script>
<!-- endbuild -->

<script type="text/javascript">
    var colors = ['red', 'pink', 'purple', 'deep-purple', 'indigo', 'blue', 'light-blue', 'cyan', 'teal', 'green', 'light-green', 'lime', 'yellow', 'amber', 'orange', 'deep-orange', 'brown', 'blue-grey', 'grey'];

    window.app = {
        color: {
            primary: '#2499ee',
            accent: '#6284f3',
            warn: '#907eec'
        },
        setting: {
            folded: false,
            container: false,
            theme: 'primary',
            aside: 'dark',
            brand: 'dark',
            header: 'white',
            fixedContent: true,
            fixedAside: true,
            bg: ''
        }
    };

    $(document).ready(function () {
        $("ul.nav li").each(function (e) {
            if ($(this).attr('data-path') == 1) {
                $(this).addClass('active');
            }
        })
    });

    $(document).on('click', '.delete-item', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = $(this).data('url');
        var label = $(this).data('label');

        if (confirm('Apakah anda yakin ingin menghapus ' + label + ' ini?')) {
            $.ajax({
                type: "DELETE",
                dataType: "JSON",
                url: url,
                data: {
                    "id": id,
                    "_method": 'DELETE',
                    "_token": "{{ csrf_token() }}",
                }
            }).then((data) => {
                if (typeof data.message !== 'undefined') {
                    notie.alert({
                        text: data.message,
                        type: 'success'
                    })
                    $("#datatable").DataTable().ajax.reload();

                }
                $("#datatable").DataTable().ajax.reload();
            })
        }
    });

    // bg
    $('body').removeClass($('body').attr('ui-class')).addClass(app.setting.bg).attr('ui-class', app.setting.bg);
    // folded
    app.setting.folded ? $('#aside').addClass('folded') : $('#aside').removeClass('folded');
    // container
    app.setting.container ? $('body').addClass('container') : $('body').removeClass('container');
    // aside
    $('#aside .sidenav').removeClass($('#aside .sidenav').attr('ui-class')).addClass(app.setting.aside).attr('ui-class', app.setting.aside);
    // brand
    $('#aside .navbar').removeClass($('#aside .navbar').attr('ui-class')).addClass(app.setting.brand).attr('ui-class', app.setting.brand);
    // fixed header
    app.setting.fixedContent ? $('body').addClass('fixed-content') : $('body').removeClass('fixed-content');
    // fixed aside
    app.setting.fixedAside ? $('body').addClass('fixed-aside') : $('body').removeClass('fixed-aside');
</script>

@stack('scripts')
</body>
</html>
