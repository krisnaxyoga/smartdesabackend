@extends('surat.layouts.main')
@section('content')
    <p style="text-align : justify">
        <span class="tab-space"></span>Yang bertanda tangan dibawah ini, Perbekel {{$desa->nama_desa}}, Kecamatan {{$desa->nama_kecamatan}}, {{$desa->nama_kabupaten}}
        @if($data->no_surat_pengantar !== null)
        berdasarkan Surat Keterangan Kepala Dusun {{ $data->dusun->dusun }} Nomor: {{$data->no_surat_pengantar }} {{ $data->tanggal_verifikasi ? "Tanggal " . \App\Helpers\Helper::localDate(date('Y-m-d',strtotime($data->tanggal_verifikasi))) : '' }}
        @endif
        dengan ini menerangkan bahwa:
    </p>
    <table class="body" style="width: 100%; border-collapse: collapse" cellspacing="0" cellpadding="0">
        <tr>
            <td width="160" style="vertical-align: top; padding-left: 55px; padding-right : 8px">Nama Lengkap</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->nama }}</td>
        </tr>
        <tr>
            <td width="160" style="vertical-align: top; padding-left: 55px; padding-right : 8px">No KTP</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->nik }}</td>
        </tr>
        <tr>
            <td width="160" style="vertical-align: top; padding-left: 55px; padding-right : 8px">Tempat dan Tgl. Lahir</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->tempatlahir }}, {{ $data->penduduk->tanggal_lahir_format }}</td>
        </tr>
        <tr>
            <td width="160" style="vertical-align: top; padding-left: 55px; padding-right : 8px">Jenis Kelamin</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->sex == 1 ? "Laki - Laki" : "Perempuan" }}</td>
        </tr>
        <tr>
            <td width="160" style="vertical-align: top; padding-left: 55px; padding-right : 8px">Alamat/ Tempat Tinggal</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->alamat_sekarang }}</td>
        </tr>
        <tr>
            <td width="160" style="vertical-align: top; padding-left: 55px; padding-right : 8px">Agama</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->agama->nama }}</td>
        </tr>
        <tr>
            <td width="160" style="vertical-align: top; padding-left: 55px; padding-right : 8px">Status</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->status_kawin->nama }}</td>
        </tr>
        <tr>
            <td width="160" style="vertical-align: top; padding-left: 55px; padding-right : 8px">Pendidikan</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->pendidikanKK->nama }}</td>
        </tr>
        <tr>
            <td width="160" style="vertical-align: top; padding-left: 55px; padding-right : 8px">Pekerjaan</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->pekerjaan->nama }}</td>
        </tr>
        <tr>
            <td width="160" style="vertical-align: top; padding-left: 55px; padding-right : 8px">Kewarganegaraan</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">{{ $data->penduduk->kewarganegaraan->nama }}</td>
        </tr>
        <tr>
            <td width="160" style="vertical-align: top; padding-left: 55px; padding-right : 8px">Keperluan</td>
            <td width="25" style="vertical-align: top">: </td>
            <td style="vertical-align: top">Sebagai pengantar untuk mendapatkan SKCK yang akan dipergunakan untuk  <strong><em>{{ $data->keperluan }}</em></strong></td>
        </tr>
    </table>
    <p style="text-align : justify">
        <span class="tab-space"></span>Bahwa orang tersebut adalah benar - benar warga kami yang bertempat tinggal di {{$data->penduduk->alamat_sekarang}}. Menurut data kami tidak pernah terlibat perkara Polisi dan beradat istiadat dengan baik.
        <br><span class="tab-space"></span>Demikian surat keterangan ini kami buat untuk dapat dipergunakan sebagaimana mestinya.
    </p>
@endsection