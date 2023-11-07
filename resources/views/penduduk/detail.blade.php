@extends('layouts.app')

@section('title')
Detail Penduduk
@endsection

@section('action')
<a href="{{route('penduduk.index')}}" class="btn btn-default"><i class="fa fa-arrow-left mr-1"></i> Kembali</a>
<a href="/penduduk/{{ $penduduk->id }}/edit" class="btn btn-success"><i class="fa fa-pencil mr-1"></i> Edit Penduduk</a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <form action="{{route('penduduk.store')}}" method="POST">
            @csrf
        <div class="row">

        </div>
        <div class="row">

                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3> Data Diri</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                        {{-- <div class="box">
                                            <div class="box-header">
                                                <h3> Foto</h3>
                                            </div>
                                            <div class="box-divider m-0"></div>
                                            <div class="box-body"> --}}
                                                <div class="preview-img">
                                                    <img src="{{$penduduk->foto !== null && $penduduk->foto != ''  ? $penduduk->foto : asset('images/Dummy.jpg')}}" alt="" class="dummy-avatar" id="dummy">
                                                </div>
                                            {{-- </div>
                                        </div> --}}
                                </div>
                                <div class="col-md-9">

                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td style="width : 200px">Nama</td>
                                            <td>: <b>{{$penduduk->nama}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>NIK</td>
                                            <td>: <b>{{$penduduk->nik}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Dusun</td>
                                            <td>: <b>{{$penduduk->dusun ? $penduduk->dusun->dusun : "-"}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>No KK Sebelumnya</td>
                                            <td>: <b>{{$penduduk->no_kk_sebelumnya}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Hubungan Dalam Keluarga</td>
                                            <td>: <b>{{$penduduk->hubungan ? $penduduk->hubungan->nama : "-"}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>: <b>{{$penduduk->sex == 2 ? 'PEREMPUAN' : 'LAKI - LAKI'}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Agama</td>
                                            <td>: <b>{{$penduduk->agama ? $penduduk->agama->nama  : "-"}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Suku</td>
                                            <td>: <b>{{$penduduk->suku ? $penduduk->suku->nama : "-"}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>: <b>{{$penduduk->status == 1 ? 'TETAP' : ($penduduk->status == 2 ? 'TIDAK AKTIF' : 'PENDATANG')}}</b></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3> Data Kelahiran</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td style="width : 200px">No. Akta Kelahiran</td>
                                            <td>: <b>{{$penduduk->akta_lahir ?: '-'}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Lahir</td>
                                            <td>: <b>{{$penduduk->tempatlahir}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Kelahiran</td>
                                            <td>: <b>{{$penduduk->konversiTgl($penduduk->tanggallahir)}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Waktu Kelahiran</td>
                                            <td>: <b>{{$penduduk->waktu_lahir}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Umur</td>
                                            <td>: <b>{{$penduduk->umur}} Tahun</b></td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Dilahirkan</td>
                                            <td>: <b>{{$penduduk->tempat_dilahirkan ? $penduduk->tempat_dilahirkan->name  : "-"}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelahiran</td>
                                            <td>: <b>{{$penduduk->jenis_kelahiran ? $penduduk->jenis_kelahiran->nama : "-"}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Anak Ke</td>
                                            <td>: <b>{{$penduduk->kelahiran_anak_ke}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Penolong Kelahiran</td>
                                            <td>: <b>{{$penduduk->penolong_kelahiran ? $penduduk->penolong_kelahiran->nama : "-"}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Berat Lahir</td>
                                            <td>: <b>{{$penduduk->berat_lahir}} Kg</b></td>
                                        </tr>
                                        <tr>
                                            <td>Panjang Lahir</td>
                                            <td>: <b>{{$penduduk->panjang_lahir}} cm</b></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3> Pendidikan dan Pekerjaan</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td style="width : 200px">Pendidikan Dalam KK</td>
                                            <td>: <b>{{$penduduk->pendidikanKK ? $penduduk->pendidikanKK->nama : '-'}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Pendidikan</td>
                                            <td>: <b>{{$penduduk->pendidikan ? $penduduk->pendidikan->nama : '-'}}</b></td>
                                        </tr>

                                        <tr>
                                            <td>Pekerjaan</td>
                                            <td>: <b>{{$penduduk->pekerjaan ? $penduduk->pekerjaan->nama : '-'}}</b></td>
                                        </tr>

                                        <tr>
                                            <td>Deskripsi Pekerjaan</td>
                                            <td>: <b>{{$penduduk->job_description}}</b></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3> Data Kewarganegaraan</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td style="width : 200px">Status Warga Negara</td>
                                            <td>: <b>{{$penduduk->kewarganegaraan ? $penduduk->kewarganegaraan->nama : "-"}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Akhir Paspor</td>
                                            <td>: <b>{{$penduduk->tanggal_akhir_paspor ? $penduduk->konversiTgl($penduduk->tanggal_akhir_paspor) : '-'}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>No Paspor</td>
                                            <td>: <b>{{$penduduk->dokumen_paspor ?: '-'}}</b></td>
                                        </tr>
                                      <tr>
                                            <td>No KITAS/KITAP</td>
                                            <td>: <b>{{$penduduk->dokumen_kitas ?: '-'}}</b></td>
                                        </tr>



                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3> Data Orang Tua</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td style="width : 200px">NIK Ayah</td>
                                            <td>: <b>{{$penduduk->ayah_nik}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Ayah</td>
                                            <td>: <b>{{$penduduk->nama_ayah }}</b></td>
                                        </tr>
                                        <tr>
                                            <td style="width : 200px">NIK Ibu</td>
                                            <td>: <b>{{$penduduk->ibu_nik}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Ibu</td>
                                            <td>: <b>{{$penduduk->nama_ibu }}</b></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3> Alamat</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                @if (count($penduduk->penduduk_map) > 0)
                                <div class="col-md-12 m-b-10">
                                    <div id="pendudukMap" style="height : 250px; width : 100%"></div>
                                </div>
                                @endif
                                <div class="col-md-12">

                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td style="width : 200px">Nomor Telpon</td>
                                            <td>: <b>{{$penduduk->telepon}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Sebelumnya</td>
                                            <td>: <b>{{$penduduk->alamat_sebelumnya }}</b></td>
                                        </tr>
                                        <tr>
                                            <td style="width : 200px">Alamat Sekarang</td>
                                            <td>: <b>{{$penduduk->alamat_sekarang}}</b></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3> Status Perkawinan</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td style="width : 200px">Status Perkawinan</td>
                                            <td>: <b>{{$penduduk->status_kawin->nama}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Akta / Buku Nikah</td>
                                            <td>: <b>{{$penduduk->akta_perkawinan ?: '-' }}</b></td>
                                        </tr>
                                        <tr>
                                            <td style="width : 200px">Tanggal Perkawinan</td>
                                            <td>: <b>{{$penduduk->tanggalperkawinan ? $penduduk->konversiTgl($penduduk->tanggalperkawinan) : '-'}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Akta Perceraian</td>
                                            <td>: <b>{{$penduduk->akta_perceraian ?:  '-' }}</b></td>
                                        </tr>
                                        <tr>
                                            <td style="width : 200px">Tanggal Perceraian</td>
                                            <td>: <b>{{$penduduk->tanggalperceraian ? $penduduk->konversiTgl($penduduk->tanggalperceraian) : '-'}}</b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3> Data Kesehatan</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td style="width : 200px">Golongan Darah</td>
                                            <td>: <b>{{$penduduk->golonganDarah ? $penduduk->golonganDarah->nama : "-"}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Cacat</td>
                                            <td>: <b>{{$penduduk->cacat ? $penduduk->cacat->nama : '-' }}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Sakit Menahun</td>
                                            <td>: <b>{{$penduduk->sakit_menahun ? $penduduk->sakit_menahun->nama : '-' }}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Akseptor KB</td>
                                            <td>: <b>{{$penduduk->cara_kb ? $penduduk->cara_kb->nama : '-' }}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Status Kehamilan</td>
                                            <td>: <b>{{$penduduk->status_kehamilan == 1 ?'HAMIL': 'TIDAK HAMIL' }}</b></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    @if (count($penduduk->penduduk_map) > 0)
        <script>
        let map,marker;
        function initMap() {
            let latitude = {{ $penduduk->penduduk_map[0]->lat ? : -8.644609 }}
            let longitude = {{ $penduduk->penduduk_map[0]->lng ? : 115.2046587 }}
            center = {lat: latitude, lng: longitude};

            map = new google.maps.Map(document.getElementById('pendudukMap'), {
            center: center,
            zoom: 16,
            scrollwheel: false
            });

            marker = new google.maps.Marker({
                        map:map,
                        position: center
                    });
        }



        </script>

        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap">
        </script>
    @endif
@endpush
