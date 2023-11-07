<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/theme/libs/bootstrap/dist/css/bootstrap.min.css" type="text/css" />


    <title>{{$data->jenisSurat->judul}} - No : {{$data->nomor_surat}}</title>
    <style>

        .judul-surat{
            font-size: 13pt;
        }

        .full-width {
            width : 100%;
        }

        .line   {
            height: 2px;
            /* border-top : 4px solid #000; */
            border-bottom : 2px solid #000
        }

        .m-0 {
            margin : 0;

        }

        .mt-0 {
            margin-top : 0 !important
        }
        .mb-0 {
            margin-bottom : 0 !important
        }

        @page {
            margin : 1cm 1.5cm
        }

        p {
            line-height: 1.3
        }

        .tab-space {
            display: inline-block;
            width: 40px;
        }
    </style>
</head>
<body>
    <header>
        <div class="kop-surat">
            <table style="width : 100%">
                <tr>
                    <td style="width : 130px">
                        <img src="{{$desa->logo}}" alt="" class="full-width">
                    </td>
                    <td style="width : 10px">
                        <p>&nbsp;</p>
                    </td>
                    <td style="width : calc(100% - 180px)">
                        <center>
                            <h1 style="margin-bottom : 0" class="judul-surat">
                                PEMERINTAH {{ strtoupper($desa->nama_kabupaten) }}  <br>
                                KECAMATAN {{ strtoupper($desa->nama_kecamatan) }}  <br>
                                DESA {{ strtoupper($desa->nama_desa) }}
                            </h1>
                            <p style="margin-top : 4px;font-size : 10pt">
                                Alamat : {{ $desa->alamat_kantor }} - No Telp. {{ $desa->telepon }} Email: {{$desa->email_desa}}
                                <br>
                                Kode Pos {{ $desa->kode_pos }}
                            </p>
                            {{-- <table style="width : 100%;margin-top : 15px;padding-left : 20px">
                                <tr>
                                    <td style="font-size : 14px"><i><b>Alamat : {{ $desa->alamat_kantor }}</b></i> </td>
                                    <td style="font-size : 14px"><i><b>Telp : {{ $desa->telepon }}</b></i> </td>
                                </tr>
                                <tr>
                                    <td style="font-size : 14px"><i><u><b>{{$desa->website}}</b></u></i></td>
                                    <td style="font-size : 14px"><i><b>{{$desa->email_desa}}</b></i></td>
                                </tr>
                            </table> --}}
                            <p style="margin-top : 4px" >
                                {{-- {{ $desa->alamat_kantor }}, Telepon {{ $desa->telepon }}, Kode Pos {{$desa->kode_pos}} --}}
                            </p>
                        </center>
                    </td>
                </tr>
            </table>

    </div>
    <div class="line">

    </div>
    <center>
        <h3 class="mb-0" style="line-height : 1.6;text-decoration : underline">{{ $data->jenisSurat->judul }}</h3>
        <h4 class="mt-0">Nomor : {{ $data->nomor_surat }}</h4>
    </center>
    </header>

    <main class="body">
        @yield('content')
    </main>

    <footer class="body">
        <table width="100%">
        <tr>
            @if($data->jenisSurat->kode_surat == 'SKPT')
            <td style="width : 300px" valign="top">
                <br>
                <p>
                <b>Catatan: </b><br>Pada Waktu Surat K. Pindah ini diberikan <br>
                        Nama yang bersangkutan pada KK di coret <br>
                        dan KTP Asli Dicabut</p>
            </td>
            @endif
            <td style="width : calc(100% - 350px)">
                &nbsp;
            </td>
            <td style="width : 350px" class="ttd-form">
                <center>
                        <p>
                           {{str_replace(' ', '', strstr($desa->nama_kabupaten, ' '))}}, {{ \App\Helpers\Helper::localDate(date('Y-m-d',strtotime($data->tanggal_cetak))) }}
                            @if (!$data->staff->is_kades)
                            <br>a.n. {{-- $data->staff->jabatan --}} Perbekel Desa {{$desa->nama_desa}}
                            @endif
                            <br> {{ $data->staff->jabatan }}
                        </p>
                        <br>
                        <br>
                        <p style="font-weight : 700;">
                            <strong><u>{{$data->staff->pamong_nama}}</u></strong><br>
                            <strong>NIP: {{ $data->staff->pamong_nip ?: "-" }}</strong>
                        </p>
                        </center>
            </td>
            </tr>
        </table>
        <div width="400px">

        </div>
    </footer>

</body>
</html>
