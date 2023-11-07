@extends('surat.layouts.main')
@section('content')
    <p style="text-align : justify; margin-top : -10px" >
         <span class="tab-space"></span>Yang bertanda tangan dibawah ini, Perbekel {{$desa->nama_desa}}, Kecamatan {{$desa->nama_kecamatan}}, {{$desa->nama_kabupaten}}
        {{-- @if($data->no_surat_pengantar !== null)
        berdasarkan Surat Keterangan Kepala Dusun {{ $data->dusun->dusun }} Nomor: {{$data->no_surat_pengantar }} {{ $data->tanggal_verifikasi ? "Tanggal " . \App\Helpers\Helper::localDate(date('Y-m-d',strtotime($data->tanggal_verifikasi))) : '' }}
        @endif --}}
        berdasarkan surat pengantar Kepala Dusun <strong><em>{{ $data->dusun->dusun }}</em></strong> Nomor <b><i>{{$data->no_surat_pengantar }}</i></b>  Tanggal : <b><i>{{ $data->tanggal_verifikasi ? "" . \App\Helpers\Helper::localDate(date('Y-m-d',strtotime($data->tanggal_verifikasi))) . '' : '' }} </i></b> bahwa :
    </p>
    <table class="body" style="width: 100%; border-collapse: collapse" cellspacing="0" cellpadding="0">
        <tr>
            <td width="180" style="padding-right : 8px;padding-left : 55px;">Nama Pemohon/ Penanggung Jawab</td>
            <td style="width : 10px; vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->nama }}</td>
        </tr>
        
        <tr>
            <td width="180" style="padding-right : 8px;padding-left : 54px;">Alamat Pemohon/ Penanggung Jawab</td>
            <td style="width : 10px; vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->alamat_sekarang }}</td>
        </tr>
       
        <tr>
            <td width="180" style="padding-right : 8px;padding-left : 54px;">Nama Perusahaan</td>
            <td style="width : 10px; vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->nama_usaha }}</td>
        </tr>
        <tr>
            <td width="180" style="padding-right : 8px;padding-left : 54px;">Jenis Usaha</td>
            <td style="width : 10px; vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->jenis_usaha }}</td>
        </tr>
    </table>

    <p style="text-align : justify">
        <span class="tab-space"></span>Sepanjang pengetahuan kami dan sampai surat ini dikeluarkan memang benar usaha tersebut beralamat di :
    </p>

    <table style="width : 100%">
            <tr>
                <td width="180" style="padding-right : 8px;padding-left : 54px;">Jalan</td>
                <td style="width : 10px; vertical-align: top">: </td>
                <td style="vertical-align: top">{{ $data->alamat_usaha }}</td>
            </tr>
            
            <tr>
                <td width="180" style="padding-right : 8px;padding-left : 54px;">Dusun</td>
                <td style="width : 10px; vertical-align: top">: </td>
                <td style="vertical-align: top">{{ $data->nama_dusun }}</td>
            </tr>
           
            <tr>
                <td width="180" style="padding-right : 8px;padding-left : 54px;">Kelurahan / Desa</td>
                <td style="width : 10px; vertical-align: top">: </td>
                <td style="vertical-align: top">{{ $data->nama_desa }}</td>
            </tr>
            <tr>
                <td width="180" style="padding-right : 8px;padding-left : 54px;">Kecamatan</td>
                <td style="width : 10px; vertical-align: top">: </td>
                <td style="vertical-align: top">{{ $data->nama_kecamatan }}</td>
            </tr>
            <tr>
                <td width="180" style="padding-right : 8px;padding-left : 54px;">Kabupaten/Kota</td>
                <td style="width : 10px; vertical-align: top">: </td>
                <td style="vertical-align: top">{{ $data->nama_kabupaten }}</td>
            </tr>
            <tr>
                <td width="180" style="padding-right : 8px;padding-left : 54px;">Provinsi</td>
                <td style="width : 10px; vertical-align: top">: </td>
                <td style="vertical-align: top">{{ $data->nama_provinsi }}</td>
            </tr>
        </table>


    <p style="text-align : justify">
        <span class="tab-space"></span>Demikian surat keterangan ini kami buat dengan sebenarnya agar dapat dipergunakan untuk <strong><em>{{ $data->keperluan }}</em></strong>.
    </p>
@endsection