<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/theme/libs/bootstrap/dist/css/bootstrap.min.css" type="text/css" />


    <title>SURAT KETERANGAN TANDA LAPOR DIRI (STLD)  - No : {{ $duktang->no_surat_desa }}</title>
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

        .table-bordered {
            border-collapse: collapse;
        }

        .table-bordered,.table-bordered th,.table-bordered td {
            border: 1px solid black;
        }
        .body , .body th, .body td {
            font-size: 15px;
        }

        .text-header {
            font-size: 15px;
        }


        /* .container {

            margin: 0px auto;
        } */
    </style>
</head>
<body>
    <header class="mb-0">
        <div class="kop-surat">
            <table style="width : 100%">
                <tr>
                    <td style="width : 130px">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d2/Lambang_Kabupaten_Badung.png" alt="" class="full-width">
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
                            <table style="width : 100%;margin-top : 15px;padding-left : 20px">
                                <tr>
                                    <td style="font-size : 14px"><i><b>Alamat : {{ $desa->alamat_kantor }}</b></i> </td>
                                    <td style="font-size : 14px"><i><b>Telp : {{ $desa->telepon }}</b></i> </td>
                                </tr>
                                <tr>
                                    <td style="font-size : 14px"><i><u><b>{{$desa->website}}</b></u></i></td>
                                    <td style="font-size : 14px"><i><b>{{$desa->email_desa}}</b></i></td>
                                </tr>
                            </table>
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
        <h3 class="mb-0" style="line-height : 1.6;text-decoration : underline">SURAT KETERANGAN TANDA LAPOR DIRI (STLD) </h3>
        <h3 class="mb-0" style=" font-weight: normal!important;
            margin-top: 4.5px;">No. {{$duktang->no_surat_desa}}</h3>
    </center>
    </header>
    <main class="body mt-0">
            <p style="margin-bottom:1.5px; margin-top: 4.5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang bertanda tangan dibawah ini, Perbekel Desa {{$desa->nama_desa}}, Kecamatan {{$desa->nama_kecamatan}}, Kabupaten {{$desa->nama_kabupaten}}, dengan ini menerangkan bahwa:</p>
            <table class="body" style="width: 98%; margin: 0px auto; border-collapse: collapse" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="20" style="vertical-align: top">1. </td>
                    <td width="160" style="padding-right : 8px; vertical-align: top">NIK</td>
                    <td width="10" style="vertical-align: top">: </td>
                    <td style="vertical-align: top">{{ $duktang->nik }}</td>
                </tr>
                <tr>
                    <td width="20" style="vertical-align: top">2. </td>
                    <td width="160" style="padding-right : 8px; vertical-align: top">Nama Lengkap</td>
                    <td width="10" style="vertical-align: top">: </td>
                    <td style="vertical-align: top">{{ strtoupper($duktang->nama) }}</td>
                </tr>
                <tr>
                    <td width="20" style="vertical-align: top">3. </td>
                    <td width="160" style="padding-right : 8px; vertical-align: top">Tempat/Tanggal Lahir</td>
                    <td width="10" style="vertical-align: top">: </td>
                    <td style="vertical-align: top">{{ strtoupper($duktang->tempat_lahir)}}, {{date('d/m/Y', strtotime($duktang->tanggal_lahir))}}</td>
                </tr>
                <tr>
                    <td width="20" style="vertical-align: top">4. </td>
                    <td width="160" style="padding-right : 8px; vertical-align: top">Agama</td>
                    <td width="10" style="vertical-align: top">: </td>
                    <td style="vertical-align: top">{{$duktang->agama ? $duktang->agama->nama : ''}}</td>
                </tr>
                <tr>
                    <td width="20" style="vertical-align: top">5. </td>
                    <td width="160" style="padding-right : 8px; vertical-align: top">Jenis Kelamin</td>
                    <td width="10" style="vertical-align: top">: </td>
                    <td style="vertical-align: top">{{$duktang->jenisKelamin ? $duktang->jenisKelamin->nama : ''}}</td>
                </tr>
                <tr>
                    <td width="20" style="vertical-align: top">6. </td>
                    <td width="160" style="padding-right : 8px; vertical-align: top">Pendidikan</td>
                    <td width="10" style="vertical-align: top">: </td>
                    <td style="vertical-align: top">{{$duktang->pendidikan ? $duktang->pendidikan->nama : ''}}</td>
                </tr>
                <tr>
                    <td width="20" style="vertical-align: top">7. </td>
                    <td width="160" style="padding-right : 8px; vertical-align: top">Pekerjaan</td>
                    <td width="10" style="vertical-align: top">: </td>
                    <td style="vertical-align: top">{{$duktang->pekerjaan ? $duktang->pekerjaan->nama : ''}}</td>
                </tr>
                <tr>
                    <td width="20" style="vertical-align: top">8. </td>
                    <td width="160" style="padding-right : 8px; vertical-align: top">Status Perkawinan</td>
                    <td width="10" style="vertical-align: top">: </td>
                    <td style="vertical-align: top">{{$duktang->status_kawin ? $duktang->status_kawin->nama : ''}}</td>
                </tr>
                <tr>
                    <td width="20" style="vertical-align: top">9. </td>
                    <td width="160" style="padding-right : 8px; vertical-align: top">Alamat Asal</td>
                    <td width="10" style="vertical-align: top">: </td>
                    <td style="vertical-align: top;">{{$duktang->alamat_asal." ". ucfirst(strtolower($asal->name)).", ". ucfirst(strtolower($asal->district)).", ". ucfirst(strtolower($asal->regency)).", ". ucfirst(strtolower($asal->province))}}</td>
                </tr>
                <tr>
                    <td width="20" style="vertical-align: top">10. </td>
                    <td width="160" style="padding-right : 8px; vertical-align: top">Melapor pada hari/tanggal</td>
                    <td width="10" style="vertical-align: top">: </td>
                    <td style="vertical-align: top;">{{$duktang->hari_melapor}}</td>
                </tr>
                <tr>
                    <td width="20" style="vertical-align: top">11. </td>
                    <td width="160" style="padding-right : 8px; vertical-align: top">Alamat tempat tinggal</td>
                    <td width="10" style="vertical-align: top">: </td>
                    <td style="vertical-align: top;">{{$duktang->alamat_tinggal." "}}{{$duktang->dusun ? $duktang->dusun->dusun.", " : ''}}{{$desa->nama_desa.", ".$desa->nama_kecamatan.", ".$desa->nama_kabupaten}}</td>
                </tr>
                <tr>
                    <td width="20" style="vertical-align: top">12. </td>
                    <td width="160" style="padding-right : 8px; vertical-align: top">Surat yang dibawa</td>
                    <td width="10" style="vertical-align: top">: </td>
                    <td style="vertical-align: top;">{{$duktang->surat}}</td>
                </tr>
                <tr>
                    <td width="20" style="vertical-align: top">13. </td>
                    <td width="160" style="padding-right : 8px; vertical-align: top">Keluarga yang ikut</td>
                    <td width="10" style="vertical-align: top">: </td>
                    <td style="vertical-align: top;">{{ count($anggota_duktang) == null ? 'Tidak ada' : 'Ada'}}</td>
                </tr>
                <tr>
                    <td width="20" style="vertical-align: top">14. </td>
                    <td width="160" style="padding-right : 8px; vertical-align: top">Tanggal berlaku</td>
                    <td width="10" style="vertical-align: top">: </td>
                    <td style="vertical-align: top;">{{ date('d/m/Y', strtotime($duktang->masa_berlaku)) }}</td>
                </tr>
            </table>

            <table style="width: 98%; margin: 0px auto;" class="table-bordered body">
                <thead>
                    <tr>
                        <th style="text-align : center; vertical-align: top">No.</th>
                        <th  style="text-align : center; vertical-align: top">Nama</th>
                        <th  style="text-align : center; vertical-align: top">Jenis<br>Kelamin</th>
                        <th  style="text-align : center; vertical-align: top">Umur</th>
                        <th  style="text-align : center; vertical-align: top">Status<br>Perkawinan</th>
                        <th  style="text-align : center; vertical-align: top">Pendidikan</th>
                        <th  style="text-align : center; vertical-align: top">Status<br>Keluarga</th>
                        <th  style="text-align : center; vertical-align: top">Ket</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($anggota_duktang) > 0)
                        @php
                            $id = 1;
                        @endphp
                        @foreach ($anggota_duktang as $item)
                        <tr>
                            <td style="text-align : center">{{$id}}</td>
                            <td  style="text-align : left">{{$item->nama}}</td>
                            <td  style="text-align : center">{{$item->sex_id == 1 ? 'L' : 'P'}}</td>
                            <td  style="text-align : center">{{$item->umur}}</td>
                            <td  style="text-align : left">{{$item->status_kawin ? $item->status_kawin->nama : '-'}}</td>
                            <td  style="text-align : left">{{$item->pendidikan ? $duktang->pendidikan->nama : '-'}}</td>
                            <td  style="text-align : left">{{$item->hubungan ? $item->hubungan->nama : '-'}}</td>
                            <td  style="text-align : left">{{$item->keterangan}}</td>
                        </tr>
                        @php
                        $id++;
                        @endphp
                        @endforeach
                    @else
                        <tr>
                            <td style="padding: 12px;">{{" "}}</td>
                            <td style="padding: 12px;">{{" "}}</td>
                            <td style="padding: 12px;">{{" "}}</td>
                            <td style="padding: 12px;">{{" "}}</td>
                            <td style="padding: 12px;">{{" "}}</td>
                            <td style="padding: 12px;">{{" "}}</td>
                            <td style="padding: 12px;">{{" "}}</td>
                            <td style="padding: 12px;">{{" "}}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <p style="width: 98%; margin: 0px auto;">Demikian Surat Keterangan ini kami buat dengan sebenarnya agar dapat digunakan sebagaimana mestinya. </p>
    </main>
    <footer class="body">
        <table width="100%">
        <tr>

            <td style="width : 300px" valign="top">

            </td>

            <td style="width : calc(100% - 350px)">
                &nbsp;
            </td>
            <td style="width : 350px" class="ttd-form">
                <center>
                        <p>
                            {{$desa->nama_desa}}, {{ \App\Helpers\Helper::localDate(date('Y-m-d',strtotime($duktang->tanggal_melapor))) }}
                            <br>a.n. Perbekel Desa {{$desa->nama_desa}}
                            <br> {{ $duktang->no_surat_desa }}
                        </p>
                        <br>
                        <br>
                        <p style="font-weight : 700;">
                            <strong><u>{{$duktang->staff ? $duktang->staff->pamong_nama : ''}}</u></strong><br>
                            {{--<strong>NIP: {{  $duktang->staff->pamong_nip ? : "-" }}</strong>--}}
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
