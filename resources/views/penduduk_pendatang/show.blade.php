@extends('layouts.app')

@section('title')
    {{$page_title}}
@endsection

@section('action')
<a href="{{route('penduduk-pendatang.index')}}" class="btn btn-default"><i class="fa fa-arrow-left mr-1"></i> Kembali</a>
<a href="{{route('penduduk-pendatang.preview', $duktang->id)}}" class="btn btn-primary"><i class="fa fa-file-text mr-1"></i> Cetak STLD</a>
<a href="/penduduk-pendatang/{{ $duktang->id }}/edit" class="btn btn-success"><i class="fa fa-pencil mr-1"></i> Edit Data</a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <form action="" method="POST">
        @csrf
        <div class="row">
            <!-- tab -->
            <div class="col-sm-12">
                <div class="b-b b-primary nav-active-primary">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" href="#" data-toggle="tab" data-target="#tab1">Data Diri</a></li>
                        <li class="nav-item"><a class="nav-link" href="#" data-toggle="tab" data-target="#tab2">Foto</a></li>
                        <li class="nav-item"><a class="nav-link" href="#" data-toggle="tab" data-target="#tab3">Data Asal</a></li>
                        <li class="nav-item"><a class="nav-link" href="#" data-toggle="tab" data-target="#tab4">Alamat Tinggal</a></li>
                        <li class="nav-item"><a class="nav-link" href="#" data-toggle="tab" data-target="#tab5">Informsi STLD</a></li>
                        <li class="nav-item"><a class="nav-link" href="#" data-toggle="tab" data-target="#tab6">Anggota Kelurga</a></li>
                    </ul>
                </div>
                <div class="tab-content p-3 mb-3">
                    <div class="tab-pane animate fadeIn text-muted active" id="tab1">
                        <div class="box">
                            <div class="box-header">
                                <h3>Data Diri</h3>
                            </div>
                            <div class="box-divider m-0"></div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <td width="250px">NIK</td>
                                                <td><b>{{$duktang->nik}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>No. KK</td>
                                                <td><b>{{$duktang->no_kk ? $duktang->no_kk : "-"}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Nama</td>
                                                <td><b>{{$duktang->nama}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Kelamin</td>
                                                <td><b>{{$duktang->jenisKelamin ? $duktang->jenisKelamin->nama  : "-"}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Agama</td>
                                                <td><b>{{$duktang->agama ? $duktang->agama->nama  : "-"}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Golongan Darah</td>
                                                <td><b>{{$duktang->golonganDarah ? $duktang->golonganDarah->nama  : "-"}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>No. HP</td>
                                                <td><b>{{$duktang->no_hp != null ? $duktang->no_hp  : "-"}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><b>{{$duktang->email != null ? $duktang->email  : "-"}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Status Keluarga</td>
                                                <td><b>{{$duktang->hubungan ? $duktang->hubungan->nama  : "-"}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Status Pendidikan</td>
                                                <td><b>{{$duktang->pendidikan ? $duktang->pendidikan->nama  : "-"}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Tempat Lahir</td>
                                                <td><b>{{$duktang->tempat_lahir}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Lahir</td>
                                                <td><b>{{$duktang->tanggal_lahir}}</b></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane animate fadeIn text-muted" id="tab2">
                        <div class="box">
                            <div class="box-header">
                                <h3>Foto</h3>
                            </div>
                            <div class="box-divider m-0"></div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <td width="250px">Foto Profile</td>
                                                <td>
                                                    <div class="preview-img mb-4 d-inline-block p-1 b-a" width="100%">
                                                        <img src="{{$duktang->photo !== null && $duktang->photo != ''  ? 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/'.$duktang->photo : asset('images/Dummy.jpg')}}" alt="" class="dummy-avatar" id="dummy" width="100%">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Foto KTP</td>
                                                <td>
                                                    <div class="preview-img d-inline-block p-1 b-a" width="100%">
                                                        <img src="{{$duktang->photo_ktp !== null && $duktang->photo_ktp != ''  ? 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/'.$duktang->photo_ktp : asset('images/dummy-landscape.png')}}" alt="" class="dummy-avatar" id="dummy" width="100%">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane animate fadeIn text-muted" id="tab3">
                        <div class="box">
                            <div class="box-header">
                                <h3> Data Asal</h3>
                            </div>
                            <div class="box-divider m-0"></div>
                            <div class="box-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <td width="250px">Status Warga Negara</td>
                                                <td><b>{{$duktang->kewarganegaraan ? $duktang->kewarganegaraan->nama  : "-"}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat Asal</td>
                                                <td><b>{{$duktang->alamat_asal}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Desa Asal</td>
                                                <td><b>{{$duktang->desa_asal ? $duktang->desa_asal->name : "-"}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Kecamatan Asal</td>
                                                <td><b>{{ $asal->district}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Kabupaten Asal</td>
                                                <td><b>{{ $asal->regency}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Provinsi Asal</td>
                                                <td><b>{{$asal->province}}</b></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane animate fadeIn text-muted" id="tab4">
                        <div class="box">
                            <div class="box-header">
                                <h3> Data Alamat Tinggal</h3>
                            </div>
                            <div class="box-divider m-0"></div>
                            <div class="box-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <td width="250px">Alasan Domisili</td>
                                                <td><b>{{$duktang->alasan_domisili}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat Tinggal</td>
                                                <td><b>{{$duktang->alamat_tinggal}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Dusun Tinggal</td>
                                                <td><b>{{$duktang->dusun ? $duktang->dusun->dusun : "-"}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Tempat Tinggal</td>
                                                <td><b>{{ $duktang->jenis_tempat_tinggal ? $duktang->jenis_tempat_tinggal->nama : "-"}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Surat Yang Dibawa</td>
                                                <td><b>{{ $duktang->surat}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Melapor</td>
                                                <td><b>{{$duktang->tanggal_melapor}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Status Verifikasi</td>
                                                <td><b>{{strtoupper($duktang->status_verifikasi)}}</b></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane animate fadeIn text-muted" id="tab5">
                        <div class="box">
                            <div class="box-header">
                                <h3>Informasi STLD</h3>
                            </div>
                            <div class="box-divider m-0"></div>
                            <div class="box-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <td width="250px">No. Surat Desa</td>
                                                <td><b>{{$duktang->no_surat_desa}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Tanda Tangan</td>
                                                <td><b>{{$duktang->staff ? $duktang->staff->pamong_nama." ( ".$duktang->staff->jabatan." )" : '' }}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Melapor</td>
                                                <td><b>{{$duktang->tanggal_melapor}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Masa Berlaku Surat</td>
                                                <td><b>{{$duktang->masa_berlaku}}</b></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane animate fadeIn text-muted" id="tab6">
                        <div class="box">
                                <div class="box-header">
                                    <div class="navbar-text nav-title flex" id="pageTitle">
                                        <h3> Anggota Keluarga yang Ikut</h3>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{route('penduduk-pendatang.tambah-angggota',$duktang->id)}}" class="btn btn-primary"><i class="fa fa-plus mr-2"></i> Tambah Anggota</a>
                                    </div>
                                </div>
                                <div class="box-divider m-0"></div>
                                <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                            <table id="datatable" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <td><b>Action</b></td>
                                                        <td><b>Nama</b></td>
                                                        <td><b>Jenis Kelamin</b></td>
                                                        <td><b>Umur</b></td>
                                                        <td><b>Status Perkawinan</b></td>
                                                        <td><b>Pendidikan</b></td>
                                                        <td><b>Status Keluarga</b></td>
                                                        <td><b>Keterangan</b></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end-tab -->
        </div>
        </form>
    </div>
</div>
@include('modals.edit-anggota-duktang-modal')
@endsection
@push('scripts')
<script type="text/javascript">
    let dataTable = $("#datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax:"/penduduk-pendatang/{{$duktang->id}}?type=datatable",
        columns: [
            {data: 'action' ,orderable: false},
            {data: "nama"},
            {data: "jenisKelamin"},
            {data: "umur"},
            {data: "status_kawin"},
            {data: "pendidikan"},
            {data: "hubungan"},
            {data: "keterangan"}
        ]
    });
</script>
@endpush
