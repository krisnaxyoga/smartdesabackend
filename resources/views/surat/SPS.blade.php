@extends('surat.layouts.main')
@section('content')
    <br>
    <p style="text-align : justify">
        <span class="tab-space"></span>Saya yang bertanda tangan dibawah ini,
    </p>
    <table class="body" style="width: 100%; border-collapse: collapse" cellspacing="0" cellpadding="0">
        <tr>
            <td width="180" style="padding-right : 8px; padding-left: 55px; vertical-align: top">Nama Lengkap</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->nama }}</td>
        </tr>
        
        <tr>
            <td width="180" style="padding-right : 8px; padding-left: 55px; vertical-align: top">Kewarganegaraan</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->kewarganegaraan->nama }}</td>
        </tr>
       
        <tr>
            <td width="180" style="padding-right : 8px; padding-left: 55px; vertical-align: top">Tempat dan Tgl. Lahir</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->tempatlahir }}, {{ $data->penduduk->tanggal_lahir_format }}</td>
        </tr>
        <tr>
            <td width="180" style="padding-right : 8px; padding-left: 55px; vertical-align: top">Agama</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->agama->nama }}</td>
        </tr>


        <tr>
            <td width="180" style="padding-right : 8px; padding-left: 55px; vertical-align: top">Pekerjaan</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->pekerjaan->nama }}</td>
        </tr>
        <tr>
            <td width="180" style="padding-right : 8px; padding-left: 55px; vertical-align: top">No KTP</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->nik }}</td>
        </tr>
        <tr>
            <td width="180" style="padding-right : 8px; padding-left: 55px; vertical-align: top">No KK</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->keluarga ? $data->penduduk->keluarga->no_kk : $data->penduduk->no_kk_sebelumnya }}</td>
        </tr>
        <tr>
            <td width="180" style="padding-right : 8px; padding-left: 55px; vertical-align: top">Alamat</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->alamat_sekarang }}</td>
        </tr>
        
{{--        
        <tr>
            <td style="padding-right : 8px">Keperluan</td>
            <td>: </td>
            <td></td>
        </tr>
        --}}
    </table>
    @if($data->no_surat_pengantar !== null)

    <p style="text-align : justify">
        <span class="tab-space"></span>Bahwa memang benar saya yang tersebut diatas adalah seorang {{ $data->pernyataan_status }} dan sampai saat ini tidak kawin lagi.
    </p>
    @endif
    
    <p style="text-align : justify">
        <span class="tab-space"></span>Demikian surat pernyataan ini kami buat dengan sebenarnya agar dapat dipergunakan untuk <strong><em>{{ $data->keperluan }}</em></strong>.
    </p>
@endsection