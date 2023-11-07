@extends('surat.layouts.main')
@section('content')
    <br>
    <p style="text-align : justify">
        <span class="tab-space"></span>Yang bertanda tangan dibawah ini, Perbekel {{$desa->nama_desa}}, Kecamatan {{$desa->nama_kecamatan}}, {{$desa->nama_kabupaten}}
        {{-- @if($data->no_surat_pengantar !== null)
        berdasarkan Surat Keterangan Kepala Dusun {{ $data->dusun->dusun }} Nomor: {{$data->no_surat_pengantar }} {{ $data->tanggal_verifikasi ? "Tanggal " . \App\Helpers\Helper::localDate(date('Y-m-d',strtotime($data->tanggal_verifikasi))) : '' }}
        @endif --}}
        menerangkan dengan sebenarnya bahwa :
    </p>
    <table class="body" style="width: 100%; border-collapse: collapse" cellspacing="0" cellpadding="0">
        <tr>
            <td width="160" style="padding-left: 55px; vertical-align: top; padding-right : 8px">Nama Lengkap</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->nama }}</td>
        </tr>
        
        <tr>
            <td width="160" style="padding-left: 55px; vertical-align: top; padding-right : 8px">Kewarganegaraan</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->kewarganegaraan->nama }}</td>
        </tr>
       
        <tr>
            <td width="160" style="padding-left: 55px; vertical-align: top; padding-right : 8px">Tempat dan Tgl. Lahir</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->tempatlahir }}, {{ $data->penduduk->tanggal_lahir_format }}</td>
        </tr>
        <tr>
            <td width="160" style="padding-left: 55px; vertical-align: top; padding-right : 8px">Agama</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->agama->nama }}</td>
        </tr>


        <tr>
            <td width="160" style="padding-left: 55px; vertical-align: top; padding-right : 8px">Pekerjaan</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->pekerjaan->nama }}</td>
        </tr>
        <tr>
            <td width="160" style="padding-left: 55px; vertical-align: top; padding-right : 8px">No KTP</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->nik }}</td>
        </tr>
        <tr>
            <td width="160" style="padding-left: 55px; vertical-align: top; padding-right : 8px">No KK</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->keluarga ? $data->penduduk->keluarga->no_kk : $data->penduduk->no_kk_sebelumnya }}</td>
        </tr>
        <tr>
            <td width="160" style="padding-left: 55px; vertical-align: top; padding-right : 8px">Alamat</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->alamat_sekarang }}</td>
        </tr>
        
{{--        
        <tr>
            <td style="padding-right : 8px">Keperluan</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top"></td>
        </tr>
        --}}
    </table>
    {{-- @if($data->no_surat_pengantar !== null)

    <p style="text-align : justify">
        <span class="tab-space"></span>Sepanjang pengetahuan kami sesuai dengan pengantar Kepala Dusun {{ $data->dusun->dusun }} Nomor <b><i>{{$data->no_surat_pengantar }}</i></b>  Tanggal : <b><i>{{ $data->tanggal_verifikasi ? "" . \App\Helpers\Helper::localDate(date('Y-m-d',strtotime($data->tanggal_verifikasi))) . '' : '' }} </i></b> memang benar orang tersebut diatas tidak mampu.
    </p>
    @endif
     --}}
    {{-- <p style="text-align : justify">
        <span class="tab-space"></span>Demikian surat keterangan ini kami buat dengan sebenarnya agar dapat dipergunakan untuk <strong><em>{{ $data->keperluan }}</em></strong>.
    </p> --}}
    <p style="text-align : justify">
        <span class="tab-space"></span>Bahwa yang disebut namanya di atas, sepanjang pengetahuan kami hingga saat dikeluarkannya surat keterangan ini memang benar keluarga yang kurang mamu dan tidak memiliki penghasilan tetap.</strong>.
    </p>
    <p style="text-align : justify">
        <span class="tab-space"></span>Demikian surat keterangan ini kami buat dengan sebenarnya agar dapat dipergunakan untuk <strong><em>{{ $data->keperluan }}</em></strong>.
    </p>
@endsection