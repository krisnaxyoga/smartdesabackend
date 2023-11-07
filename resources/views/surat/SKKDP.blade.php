@extends('surat.layouts.main')
@section('content')
    <p style="text-align : justify">
        <span class="tab-space"></span> bertanda tangan dibawah ini, Perbekel {{$desa->nama_desa}}, Kecamatan {{$desa->nama_kecamatan}}, {{$desa->nama_kabupaten}}
        @if($data->no_surat_pengantar !== null)
        berdasarkan Surat Keterangan Kepala Dusun {{ $data->dusun->dusun }} Nomor: {{$data->no_surat_pengantar }} {{ $data->tanggal_verifikasi ? "Tanggal " . \App\Helpers\Helper::localDate(date('Y-m-d',strtotime($data->tanggal_verifikasi))) : '' }}
        @endif
        dengan ini menerangkan bahwa:
    </p>
    <table style="border-collapse: collapse" cellspacing="0" cellpadding="0">
        <tr>
            <td style="padding-right : 8px">Nama Lengkap</td>
            <td>: </td>
            <td>{{ $data->penduduk->nama }}</td>
        </tr>
        <tr>
            <td style="padding-right : 8px">No KTP</td>
            <td>: </td>
            <td>{{ $data->penduduk->nik }}</td>
        </tr>
        <tr>
            <td style="padding-right : 8px">Tempat dan Tgl. Lahir</td>
            <td>: </td>
            <td>{{ $data->penduduk->tempatlahir }}, {{ $data->penduduk->tanggal_lahir_format }}</td>
        </tr>
        <tr>
            <td style="padding-right : 8px">Jenis Kelamin</td>
            <td>: </td>
            <td>{{ $data->penduduk->sex == 1 ? "Laki - Laki" : "Perempuan" }}</td>
        </tr>
        <tr>
            <td style="padding-right : 8px">Alamat/ Tempat Tinggal</td>
            <td>: </td>
            <td>{{ $data->penduduk->alamat_sekarang }}</td>
        </tr>
        <tr>
            <td style="padding-right : 8px">Agama</td>
            <td>: </td>
            <td>{{ $data->penduduk->agama->nama }}</td>
        </tr>
        <tr>
            <td style="padding-right : 8px">Status</td>
            <td>: </td>
            <td>{{ $data->penduduk->status_kawin->nama }}</td>
        </tr>
        <tr>
            <td style="padding-right : 8px">Pekerjaan</td>
            <td>: </td>
            <td>{{ $data->penduduk->pekerjaan->nama }}</td>
        </tr>
        <tr>
            <td style="padding-right : 8px">Kewarganegaraan</td>
            <td>: </td>
            <td>{{ $data->penduduk->kewarganegaraan->nama }}</td>
        </tr>
    </table>
    <p style="text-align : justify">
            <span class="tab-space"></span>Orang tersebut di atas adalah benar-benar warga kami yang bertempat tinggal di {{$data->penduduk->alamat_sekarang}} yang saat ini Kartu Tanda Penduduk sedang dalam proses.
            <br><span class="tab-space"></span>Demikian surat keterangan ini kami buat untuk dapat dipergunakan sebagaimana mestinya.
    </p>
    <p style="text-align : justify">
            
    </p>
@endsection