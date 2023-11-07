@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('rkp-desa.index')}}" class="btn btn-rounded btn-secondary"><i class="fa fa-chevron-left mr-2"></i> Kembali  </a>
@endsection
@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row">

            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h3>RKP DESA</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped v-middle">
                                        <tr>
                                            <td><b>Tahun RKP</b></td>
                                            <td>{{$data->tahun}}</td>
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
                                <h3>KEGIATAN RKP DESA</h3>
                            </div>
                        </div>
                    </div>

                    <div class="box-divider m-0">   </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table v-middle p-0 m-0 box">
                                <thead>
                                    <tr>
                                        <th>Nama Bidang</th>
                                        <th>Jenis Kegiatan</th>
                                        <th>Lokasi</th>
                                        <th>Volume</th>
                                        <th>Sasaran/Manfaat</th>
                                        <th>Waktu Pelaksanaan</th>
                                        <th>Biaya</th>
                                        <th>Sumber</th>
                                        <th>Swakelola</th>
                                        <th>Kerjasama Antar Desa</th>
                                        <th>Kerjasama Pihak Ketiga</th>
                                        <th>Rencana Pelaksanaan Kegiatan</th>
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
$(".select2").select2({
    placeholder: "Pilih....",
    width: "100%"
});

let dataTable;
let $dtSearch = $('#formSearch');
$(document).ready(function() {
    dataTable = $("#datatable").DataTable({
        ajax: {
            url: "/e-planning/rkp-desa/{{$data->id}}?type=datatable",
        },
        processing: true,
        serverSide: true,
        order: [[ 1, "asc" ]],
        bLengthChange: false,
        bFilter: false,
        columns: [
            { data: "nama_bidang", name: "nama_bidang" },
            { data: "nama_kegiatan", name: "nama_kegiatan" },
            { data: "dusun", name: "dusun" },
            { data: "volume", name: "volume" },
            { data: "manfaat", name: "manfaat" },
            { data: "estimated_time", name: "estimated_time" },
            { data: "jumlah", name: "jumlah" },
            { data: "sumber_biaya", name: "sumber_biaya" },
            { data: "swakelola", name: "swakelola" },
            { data: "kerjasama_antardesa", name: "kerjasama_antardesa" },
            { data: "kerjasama_pihak_ketiga", name: "kerjasama_pihak_ketiga"},
            { data: "rencana_pelaksana_kegiatan", name: "rencana_pelaksana_kegiatan"},
        ]
    });
});

</script>
@endpush
