@extends('surat.layouts.main')
@section('content')
    <br>
    <p style="text-align : center">
        Yang bertanda tangan dibawah ini, menerangkan bahwa :
    </p>
    <table style="width: 100%; border-collapse: collapse" cellspacing="0" cellpadding="0">
        <tr>
            <td width="160" style="vertical-align: top; padding-right : 8px">Nama</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->nama }}</td>
        </tr>
        
        <tr>
            <td width="160" style="vertical-align: top; padding-right : 8px">Kelamin</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->jenisKelamin->nama }}</td>
        </tr>
       
        <tr>
            <td width="160" style="vertical-align: top; padding-right : 8px">Alamat</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->alamat_sekarang }}</td>
        </tr>
        <tr>
            <td width="160" style="vertical-align: top; padding-right : 8px">Umur</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->umur }}</td>
        </tr>
    </table>
    <p style="margin: 0">telah meninggal dunia pada:</p>
    <table style="width: 100%; border-collapse: collapse" cellspacing="0" cellpadding="0">
        <tr>
            <td width="160" style="vertical-align: top; padding-right : 8px">Hari</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">
                @php
                $index = date('w', strtotime($data->tanggal_meninggal));
                $day = \App\Helpers\Helper::localDay(intval($index));

                echo strtoupper($day);
                @endphp
            </td>
        </tr>
        
        <tr>
            <td width="160" style="vertical-align: top; padding-right : 8px">Tanggal</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ \App\Helpers\Helper::localDate($data->tanggal_meninggal) }}</td>
        </tr>
       
        <tr>
            <td width="160" style="vertical-align: top; padding-right : 8px">Di</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->lokasi_meninggal }}</td>
        </tr>
        <tr>
            <td width="160" style="vertical-align: top; padding-right : 8px">Disebabkan karena</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penyebab_meninggal }}</td>
        </tr>
    </table>
    <p style="margin-top: 64px; text-align:center">Surat keterangan ini dibuat atas dasar yang sebenarnya.</p>
    <table style="width: 100%; border-collapse: collapse" cellspacing="0" cellpadding="0">
        <tr>
            <td width="160" style="vertical-align: top; padding-right : 8px">Nama yang Melaporkan</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->nama_pelapor }}</td>
        </tr>
        <tr>
            <td width="160" style="vertical-align: top; padding-right : 8px">Hub. Dengan yang mati</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->hubungan_pelapor }}</td>
        </tr>
    </table>
@endsection