@extends('surat.layouts.main')
@section('content')
    <p style="text-align : justify">
        <span class="tab-space"></span>Yang bertanda tangan dibawah ini, Perbekel {{$desa->nama_desa}}, Kecamatan {{$desa->nama_kecamatan}}, {{$desa->nama_kabupaten}}
        @if($data->no_surat_pengantar !== null)
        berdasarkan Surat Keterangan Kepala Dusun {{ $data->dusun->dusun }} Nomor: {{$data->no_surat_pengantar }} {{ $data->tanggal_verifikasi ? "Tanggal " . \App\Helpers\Helper::localDate(date('Y-m-d',strtotime($data->tanggal_verifikasi))) : '' }}
        @endif
        dengan ini menerangkan bahwa:
    </p>
    <table style="border-collapse: collapse" cellspacing="0" cellpadding="0">
        <tr>
            <td style="vertical-align: top; padding-right : 8px; padding-left: 55px">Nama Lengkap</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->nama }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top; padding-right : 8px; padding-left: 55px">No KTP</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->nik }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top; padding-right : 8px; padding-left: 55px">Tempat dan Tgl. Lahir</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->tempatlahir }}, {{ $data->penduduk->tanggal_lahir_format }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top; padding-right : 8px; padding-left: 55px">Jenis Kelamin</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->sex == 1 ? "Laki - Laki" : "Perempuan" }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top; padding-right : 8px; padding-left: 55px">Alamat/ Tempat Tinggal</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->alamat_sekarang }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top; padding-right : 8px; padding-left: 55px">Agama</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->agama->nama }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top; padding-right : 8px; padding-left: 55px">Status</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->status_kawin->nama }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top; padding-right : 8px; padding-left: 55px">Pendidikan</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->pendidikanKK->nama }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top; padding-right : 8px; padding-left: 55px">Pekerjaan</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->pekerjaan->nama }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top; padding-right : 8px; padding-left: 55px">Kewarganegaraan</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->kewarganegaraan->nama }}</td>
        </tr>
        {{-- <tr>
            <td style="vertical-align: top; padding-right : 8px; padding-left: 55px">Keterangan</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->keterangan }}</td>
        </tr> --}}
        <tr>
            <td style="vertical-align: top; padding-right : 8px; padding-left: 55px">Keperluan</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->keperluan }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top; padding-right : 8px; padding-left: 55px">Berlaku Mulai</td>
            <td style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->konversiTgl($data->berlaku_dari) }} sampai dengan {{ $data->penduduk->konversiTgl($data->berlaku_sampai)  }}</td>
        </tr>
    </table>
    <p style="text-align : justify">
            <span class="tab-space"></span>Demikian surat keterangan ini kami buat untuk dapat dipergunakan sebagaimana mestinya.
    </p>
@endsection