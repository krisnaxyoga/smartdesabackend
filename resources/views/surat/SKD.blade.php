@extends('surat.layouts.main')
@section('content')
    <p style="text-align : justify">
        <span class="tab-space"></span>Yang bertanda tangan dibawah ini, Perbekel {{$desa->nama_desa}}, Kecamatan {{$desa->nama_kecamatan}}, {{$desa->nama_kabupaten}}
        @if($data->no_surat_pengantar !== null)
        menerangkan dengan sebenarnya sesuai dengan pengantar Kepala Dusun {{ $data->dusun->dusun }} Nomor <strong><em>{{$data->no_surat_pengantar }}</em></strong> {!! $data->tanggal_verifikasi ? "Tanggal : <strong><em>" . \App\Helpers\Helper::localDate(date('Y-m-d',strtotime($data->tanggal_verifikasi))) . "</em></strong>" : '' !!} bahwa:
        @else
        dengan ini menerangkan bahwa:
        @endif
    </p>
    <table style="margin-left: 54px">
        <tr>
            <td style="padding-right : 8px">Nama</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->nama }}</td>
        </tr>
        <tr>
            <td style="padding-right : 8px">Tempat/Tanggal Lahir</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->tempatlahir }}, {{ $data->penduduk->tanggal_lahir_format }}</td>
        </tr>
        <tr>
            <td style="padding-right : 8px">Kewarganegaraan</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->kewarganegaraan->nama }}</td>
        </tr>
        <tr>
            <td style="padding-right : 8px">Agama</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->agama->nama }}</td>
        </tr>
        <tr>
            <td style="padding-right : 8px">Pekerjaan</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->pekerjaan->nama }}</td>
        </tr>
        <tr>
            <td style="padding-right : 8px">NIK</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->nik }}</td>
        </tr>
        <tr>
            <td style="padding-right : 8px">No. KK</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->keluarga ? $data->penduduk->keluarga->no_kk : '-' }}</td>
        </tr>
        <tr>
            <td style="padding-right : 8px">Alamat</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->alamat_sekarang }}</td>
        </tr>
    </table>
    <p style="text-align : justify">
        <span class="tab-space"></span>Sepanjang pengetahuan kami memang benar orang tersebut diatas bertempat tinggal di <strong><em>{{ $data->penduduk->alamat_sekarang }}</em></strong>, Lingkungan {{ $data->penduduk->dusun->dusun }}, Kelurahan {{ str_replace('Desa ', '', $desa->nama_desa) }}, Kecamatan {{$desa->nama_kecamatan}} {{$desa->nama_kabupaten}} dari tahun {{ $data->tahun_menetap }}.
    </p>
    <p style="text-align : justify">
        <span class="tab-space"></span>Demikian surat keterangan ini kami buat dengan sebenarnya agar dapat dipergunakan untuk <strong><em>{{ strtoupper($data->keperluan) }}</em></strong>.
    </p>
@endsection