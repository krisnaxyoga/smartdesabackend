
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Portal Desa Dauh Puri Kaja - #DesaDigital</title>

        <!-- Fonts -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #eee;
                background: linear-gradient(rgba(0,0,0,.3),rgba(0,0,0,.3)),url(https://www.selipan.com/wp-content/uploads/2018/10/via-pesonatanimbar.com_.jpg5_.jpg);
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                color: #636b6f;
                margin: 0;
                max-width: 100%;
                overflow-x: hidden;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 54px;
                color : #FEFEFE;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .menuitem {
                
            }
            .menuitem .inner {
              
                padding:20px 16px;
            }
            .menuitem:hover {
                text-decoration:none;
            }
            .menuitem .fa {
                display:block;
                margin-bottom:8px;
            }

            @media (min-width: 1200px) {
           
                .row.container {
                    width:900px;
                }

            }
           
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
           

            <div class="content">
                <center><img src="https://upload.wikimedia.org/wikipedia/id/7/73/Lambang_Kabupaten_Maluku_Tenggara_Barat.png" width="100"/></center>
                <div class="title text-white m-b-md">
                    Portal Desa Dauh Puri Kaja
                </div>

                <div class="row container" style="margin-bottom : 20px" >
                   <a href="https://play.google.com/store/apps/details?id=desa.dauhpurikaja.app&hl=in" target="_blank" class="menuitem col-md-4 text-center" >
                   <div class="inner" style="background:#0D47A1; color:white">
                   <i class="fa fa-5x fa-android"></i>
                    APLIKASI MOBILE<br>
                    M-DESA
                    </div>
                   </a>

                   <a href="{{url('penduduk')}}" target="_blank" class="menuitem col-md-4 text-center" >
                    <div class="inner" style="background:#C2185B; color:white">
                    <i class="fa fa-5x fa-users"></i>
                     SISTEM<br>
                     KEPENDUDUKAN
                     </div>
                    </a>

                <a href="{{url('peta/lokasi')}}" target="_blank" class="menuitem col-md-4 text-center" >
                    <div class="inner" style="background:#e67e22; color:white">
                    <i class="fa fa-5x fa-map-marker"></i>
                        SISTEM<br>
                        PEMETAAN
                        </div>
                    </a>
                </div>
                <div class="row container mb-3" >
                    <a href="{{url('peta')}}" target="_blank" class="menuitem col-md-4 text-center" >
                    <div class="inner" style="background:#0D47A1; color:white">
                    <i class="fa fa-5x fa-map"></i>
                     PETA<br>
                     DESA
                     </div>
                    </a>
 
                    <a href="{{url('surat/cetak')}}" target="_blank" class="menuitem col-md-4 text-center" >
                     <div class="inner" style="background:#34495e; color:white">
                     <i class="fa fa-5x fa-envelope-o"></i>
                      LAYANAN<br>
                      SURAT DESA
                      </div>
                     </a>
 
                 <a href="https://dauhpurikaja.desa.id" target="_blank" class="menuitem col-md-4 text-center" >
                     <div class="inner" style="background:#27ae60; color:white">
                     <i class="fa fa-5x fa-building"></i>
                         WEBSITE DESA<br>
                         DAUH PURI KAJA
                         </div>
                     </a>
                 </div>
             
            </div>
        </div>
    </body>
</html>
