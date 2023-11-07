@extends('surat.layouts.main')
@section('content')
    <br>
    <p style="text-align : justify">
        <span class="tab-space"></span>Yang bertanda tangan dibawah ini, Perbekel {{$desa->nama_desa}}, Kecamatan {{$desa->nama_kecamatan}}, {{$desa->nama_kabupaten}}
        {{-- @if($data->no_surat_pengantar !== null)
        berdasarkan Surat Keterangan Kepala Dusun {{ $data->dusun->dusun }} Nomor: {{$data->no_surat_pengantar }} {{ $data->tanggal_verifikasi ? "Tanggal " . \App\Helpers\Helper::localDate(date('Y-m-d',strtotime($data->tanggal_verifikasi))) : '' }}
        @endif --}}
        menerangkan dengan sebenarnya sesuai dengan pengantar Kepala {{ $data->dusun->dusun }} Nomor <b><i>{{$data->no_surat_pengantar }}</i></b>  Tanggal : <b><i>{{ $data->tanggal_verifikasi ? "" . \App\Helpers\Helper::localDate(date('Y-m-d',strtotime($data->tanggal_verifikasi))) . '' : '' }} </i></b> bahwa :
    </p>
    <table>
        <tr>
            <td width="160" style="vertical-align: top; padding-right : 8px"><span class="tab-space"></span>&nbsp;&nbsp;&nbsp;&nbsp;Nama Lengkap</td>
            <td width="10" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->nama }}</td>
        </tr>
        
        <tr>
            <td style="vertical-align: top; padding-right : 8px"><span class="tab-space"></span>&nbsp;&nbsp;&nbsp;&nbsp;Kewarganegaraan</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->kewarganegaraan->nama }}</td>
        </tr>
       
        <tr>
            <td style="vertical-align: top; padding-right : 8px"><span class="tab-space"></span>&nbsp;&nbsp;&nbsp;&nbsp;Tempat dan Tgl. Lahir</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->tempatlahir }}, {{ $data->penduduk->tanggal_lahir_format }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top; padding-right : 8px"><span class="tab-space"></span>&nbsp;&nbsp;&nbsp;&nbsp;Agama</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->agama->nama }}</td>
        </tr>


        <tr>
            <td style="vertical-align: top; padding-right : 8px"><span class="tab-space"></span>&nbsp;&nbsp;&nbsp;&nbsp;Pekerjaan</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->pekerjaan->nama }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top; padding-right : 8px"><span class="tab-space"></span>&nbsp;&nbsp;&nbsp;&nbsp;No KTP</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->nik }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top; padding-right : 8px"><span class="tab-space"></span>&nbsp;&nbsp;&nbsp;&nbsp;No KK</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->keluarga ? $data->penduduk->keluarga->no_kk : $data->penduduk->no_kk_sebelumnya }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top; padding-right : 8px"><span class="tab-space"></span>&nbsp;&nbsp;&nbsp;&nbsp;Alamat</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->alamat_sekarang }}</td>
        </tr>
        
{{--        
        <tr>
            <td style="vertical-align: top; padding-right : 8px">Keperluan</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top"></td>
        </tr>
        --}}
    </table>

    <p style="text-align : justify">
        <span class="tab-space"></span>Sepanjang pengetahuan kami memang benar orang tersebut diatas belum pernah kawin/menikah sampai saat ini.
    </p>
    
    <p style="text-align : justify">
            <span class="tab-space"></span>Demikian surat keterangan ini kami buat dengan sebenarnya agar dapat dipergunakan untuk <strong><em>{{ $data->keperluan }}</em></strong>.
    </p>
@endsection