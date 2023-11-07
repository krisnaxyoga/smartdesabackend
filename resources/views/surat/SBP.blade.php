@extends('surat.layouts.main')
@section('content')
    <style>
        .ttd-form {
            font-size : 12pt
        }
    </style>

    {{-- <br> --}}
    <table style="font-size : 12pt">
    @if($data->penduduk->keluarga !== null)

            <tr>
                <td colspan="3" style="vertical-align: top; padding-right : 8px"><b>I. DATA KELUARGA</b></td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-right : 8px;width : 300px;">Nama Kepala Keluarga</td>
                <td  style="vertical-align: top; width : 10px;">: </td>
                <td style="vertical-align: top">{{$data->penduduk->keluarga->kepalaKeluarga->nama}}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-right : 8px">Nomor Kartu Keluarga</td>
                <td  style="vertical-align: top; width : 10px;">: </td>
                <td style="vertical-align: top">{{$data->penduduk->keluarga->no_kk}}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-right : 8px">Alamat Keluarga</td>
                <td  style="vertical-align: top; width : 10px;">: </td>
                <td style="vertical-align: top">{{$data->penduduk->keluarga->kepalaKeluarga->alamat_sekarang}}</td>
            </tr>
    @endif

            <tr>
                <td colspan="3" style="vertical-align: top; padding-right : 8px"><b>I. DATA INDIVIDU</b></td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-right : 8px;width : 300px;">Nama Lengkap</td>
                <td style="vertical-align: top; width : 10px;">: </td>
                <td style="vertical-align: top">{{$data->penduduk->nama}}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-right : 8px">NIK</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->nik}}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-right : 8px">Alamat Sebelumnya</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->alamat_sebelumnya}}</td>
            </tr>
            {{-- <tr>
                <td style="vertical-align: top; padding-right : 8px">Nomor Paspor</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->dokumen_paspor ?: '-'}}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-right : 8px">Tanggal Berakhir Paspor</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->tanggal_akhir_paspor ? $data->konversiTgl($data->penduduk->tanggal_akhir_paspor) : '-'}}</td>
            </tr> --}}
            <tr>
                <td style="vertical-align: top; padding-right : 8px">Jenis Kelamin</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->sex == 1 ? "Laki - Laki" : "Perempuan"}}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-right : 8px">Tempat Lahir</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->tempatlahir}}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-right : 8px">Tanggal Lahir</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->konversiTgl($data->penduduk->tanggallahir)}}</td>
            </tr>
            {{-- <tr>
                <td style="vertical-align: top; padding-right : 8px">No Akte Kelahiran</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->akta_lahir ?: '-'}}</td>
            </tr> --}}
            <tr>
                <td style="vertical-align: top; padding-right : 8px">Golongan Darah</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->golonganDarah ?$data->penduduk->golonganDarah->nama: '-' }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-right : 8px">Agama</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->agama ?$data->penduduk->agama->nama: '-'}}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-right : 8px">Status</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->status_kawin ? $data->penduduk->status_kawin->nama :'-'}}</td>
            </tr>
            {{-- <tr>
                <td style="vertical-align: top; padding-right : 8px">No Akte/Buku Nikah</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->akta_perkawinan?: '-'}}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-right : 8px">Tgl. Akte/ Buku Nikah</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->tanggal_perkawinan ? $data->penduduk->konversiTgl($data->penduduk->tanggalperkawinan) : '-'}}</td>
            </tr> --}}
            {{-- <tr>
                <td style="vertical-align: top; padding-right : 8px">Akte Perceraian</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->akta_perceraian ?: '-'}}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-right : 8px">Tanggal Perceraian</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->tanggalperceraian ? $data->konversiTgl($data->penduduk->tanggalperceraian) : '-'}}</td>
            </tr> --}}
            <tr>
                <td style="vertical-align: top; padding-right : 8px">Status Hubungan dalam Keluarga</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->hubungan ? $data->penduduk->hubungan->nama : '-'}}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-right : 8px">Kelainan Fisik / Mental</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->cacat ? $data->penduduk->cacat->nama : '-'}}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-right : 8px">Pendidikan Terakhir</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->pendidikanKK->nama}}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-right : 8px">Pekerjaan</td>
                <td style="vertical-align: top">: </td>
                <td style="vertical-align: top">{{$data->penduduk->pekerjaan->nama}}</td>
            </tr>
           
        </table>
        <br>
        
    <p style="vertical-align: top; text-align : justify;font-size : 12pt">
        <span class="tab-space"></span>Demikian surat keterangan ini kami buat untuk dapat dipergunakan sebagaimana mestinya.
    </p>
@endsection