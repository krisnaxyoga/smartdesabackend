@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('usulan-desa.index')}}" class="btn btn-rounded btn-secondary"><i class="fa fa-chevron-left mr-2"></i> Kembali  </a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header">
                        <h3>Detail Usulan RKP</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        <table id="datatable" class="table table-bordered table-striped ">
                            <tr>
                                <td>Nama Kegiatan</td>
                                <td>{{$data->nama_kegiatan}}</td>
                            </tr>
                            <tr>
                                <td>Nama Sub Bidang</td>
                                <td>{{$data->bidang->nama_bidang}}</td>
                            </tr>
                            <tr>
                                <td>Nama Bidang</td>
                                <td>{{$data->bidang->parent->nama_bidang}}</td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>{{$data->wilayah->dusun}}</td>
                            </tr>
                            <tr>
                                <td>Volume</td>
                                <td>{{$data->volume}}</td>
                            </tr>
                            <tr>
                                <td>Sasaran/Manfaat</td>
                                <td>{{$data->manfaat}}</td>
                            </tr>
                            <tr>
                                <td>Prakiraan Waktu Pelaksanaan</td>
                                <td>{{$data->estimated_time}}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Biaya</td>
                                <td>Rp. {{number_format($data->jumlah, 0, ',', '.')}}</td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
