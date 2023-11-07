@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('usulan-dusun.index')}}" class="btn btn-rounded btn-secondary"><i class="fa fa-chevron-left mr-2"></i> Kembali  </a>
@endsection
@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row">

            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h3>USULAN MASYARAKAT</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped v-middle">
                                        <tr>
                                            <td>Nama Desa</td>
                                            <td>{{$data->nama_desa}}</td>
                                        </tr>
                                        <tr>
                                            <td>Usulan Dari </td>
                                            <td>{{$data->pengusul}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tahun Usulan</td>
                                            <td>{{$data->tahun}}</td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td>{{$data->keterangan}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-11">
                                <h3>URAIAN RAB DESA</h3>
                            </div>
                        </div>
                    </div>

                    <div class="box-divider m-0"></div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Usulan Kegiatan</th>
                                        <th>Lokasi</th>
                                        <th width="100px">Volume</th>
                                        <th width="100px">Satuan</th>
                                        <th width="100px">Penerima LK</th>
                                        <th width="100px">Penerima PR</th>
                                        <th width="100px">Penerima A-RTM</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
    let dataTable;
    let $dtSearch = $('#formSearch');
    $(document).ready(function() {
        dataTable = $("#datatable").DataTable({
            ajax: {
                url: "/e-planning/usulan-dusun/{{$data->id}}?type=datatable",
            },
            processing: true,
            serverSide: true,
            order: [[ 0, "asc" ]],
            bLengthChange: false,
            bFilter: false,
            columns: [
                { data: "nama_kegiatan", name: "nama_kegiatan" },
                { data: "lokasi", name: "lokasi" },
                { data: "volume", name: "volume" },
                { data: "satuan", name: "satuan" },
                { data: "penerima_lk", name: "penerima_lk" },
                { data: "penerima_pr", name: "penerima_pr" },
                { data: "penerima_artm", name: "penerima_artm" },
            ]
        });
    });


</script>
@endpush
