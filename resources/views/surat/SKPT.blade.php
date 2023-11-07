@extends('surat.layouts.main')
@section('content')
<style>
        .table-bordered {
            border-collapse: collapse;
        }

        .table-bordered,.table-bordered th,.table-bordered td {
            border: 1px solid black;
        }
        .body , .body th, .body td {
            font-size: 15px;
        }
</style>
    <table class="body" style="width: 100%; border-collapse: collapse" cellspacing="0" cellpadding="0">
        <tr>
            <td width="20" style="vertical-align: top">1. </td>
            <td width="160" style="padding-right : 8px; vertical-align: top">Nama Lengkap</td>
            <td width="10" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->nama }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top">2. </td>
            <td style="padding-right : 8px; vertical-align: top">Jenis Kelamin</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{$data->penduduk->sex == 1 ? "Laki - Laki" : "Perempuan"}}</td>
        </tr>

        <tr>
            <td style="vertical-align: top">3. </td>
            <td style="padding-right : 8px; vertical-align: top">Dilahirkan di</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->tempatlahir }}, {{ $data->penduduk->tanggal_lahir_format }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top">4. </td>
            <td style="padding-right : 8px; vertical-align: top">Kewarganegaraan</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->kewarganegaraan->nama }}</td>
        </tr>
       
        <tr>
            <td style="vertical-align: top">5. </td>
            <td style="padding-right : 8px; vertical-align: top">Agama</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->agama->nama }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top">6. </td>
            <td style="padding-right : 8px; vertical-align: top">Status Perkawinan</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{$data->penduduk->status_kawin ? $data->penduduk->status_kawin->nama :'-'}}</td>
        </tr>

        <tr>
            <td style="vertical-align: top">7. </td>
            <td style="padding-right : 8px; vertical-align: top">Pekerjaan</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->pekerjaan->nama }}</td>
        </tr>

        <tr>
            <td style="vertical-align: top">8. </td>
            <td style="padding-right : 8px; vertical-align: top">Pendidikan</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{$data->penduduk->pendidikanKK->nama}}</td>
        </tr>
        <tr>
            <td style="vertical-align: top">9. </td>
            <td style="padding-right : 8px; vertical-align: top">Alamat</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->alamat_sekarang }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top">10. </td>
            <td style="padding-right : 8px; vertical-align: top">Nomor dan Tanggal KK</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">
                <table style="width : 100%; border-collapse: collapse" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width : 200px">
                            {{$data->penduduk->keluarga == null ? $data->penduduk->no_kk_sebelumnya : $data->penduduk->keluarga->no_kk}}
                        </td>
                        <td style="vertical-align: top">
                            {{ \App\Helpers\Helper::localDate(date('Y-m-d',strtotime($data->tanggal_kk))) }}
                        </td>
                    </tr>
                </table>    
            </td>
        </tr>
        <tr>
            <td  valign="top">11. </td>
            <td style="padding-right : 8px; vertical-align: top;" valign="top">Pindah ke</td>
            <td  valign="top">: </td>
            <td style="vertical-align: top">
                <table style="width : 100%; border-collapse: collapse" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width : 200px">
                            Desa/Kelurahan
                        </td>
                        <td style="width : 10px">:</td>
                        <td style="vertical-align: top">
                            {{$data->pindah_desa}}
                        </td>
                    </tr>
                    <tr>
                        <td style="width : 200px">
                            Kecamatan
                        </td>
                        <td style="width : 10px">:</td>
                        <td style="vertical-align: top">
                            {{$data->pindah_kec}}
                        </td>
                    </tr>
                    <tr>
                        <td style="width : 200px">
                            Kab/Kota Dati II
                        </td>
                        <td style="width : 10px">:</td>
                        <td style="vertical-align: top">
                            {{$data->pindah_kab}}
                        </td>
                    </tr>
                    <tr>
                        <td style="width : 200px">
                            Provinsi Dati I
                        </td>
                        <td style="width : 10px">:</td>
                        <td style="vertical-align: top">
                            {{$data->pindah_prov}}
                        </td>
                    </tr>
                    <tr>
                        <td style="width : 200px">
                            Pada Tanggal
                        </td>
                        <td style="width : 10px">:</td>
                        <td style="vertical-align: top">
                            {{ \App\Helpers\Helper::localDate(date('Y-m-d',strtotime($data->tanggal_pindah))) }}
                        </td>
                    </tr>
                </table>     
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top">12. </td>
            <td style="padding-right : 8px; vertical-align: top">Alasan Pindah</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->keperluan }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top">13. </td>
            <td style="padding-right : 8px; vertical-align: top">Jumlah Pengikut</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ count($data->anggota) > 0 ? count($data->anggota) : "-" }}</td>
        </tr>
        
    </table>
    <br>
    <table style="width : 100%" class="table-bordered body">
        <thead>
            <tr>
                <th style="text-align : center">No</th>
                <th  style="text-align : center;width : 20%">Nama</th>
                <th  style="text-align : center">Jenis Kelamin <br>L/P</th>
                <th  style="text-align : center">Umur</th>
                <th  style="text-align : center">Status</th>
                <th  style="text-align : center;width : 15%">Pendidikan</th>
                <th  style="text-align : center;width : 8%">KTP</th>
                <th  style="text-align : center;width : 8%">Ket</th>
            </tr>
        </thead>
        <tbody>
            @if(count($data->anggota) > 0) 
                @php
                    $id = 1;
                @endphp
                @foreach ($data->anggota as $item)
                <tr>
                    <td style="text-align : center">{{$id}}</td>
                    <td  style="text-align : left">{{$item->nama}}</td>
                    <td  style="text-align : center">{{$item->sex == 1 ? 'L' : 'P'}}</td>
                    <td  style="text-align : center">{{$item->umur}}</td>
                    <td  style="text-align : left">{{$item->status}}</td>
                    <td  style="text-align : left">{{$item->pendidikan}}</td>
                    <td  style="text-align : left">{{$item->ktp}}</td>
                    <td  style="text-align : left">{{$item->keterangan}}</td>
                </tr>
                @php
                 $id++;   
                @endphp
                @endforeach
            @else
                <tr>
                    <td style="padding: 16px; text-align: center" colspan="8"><strong>NIHIL</strong></td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection