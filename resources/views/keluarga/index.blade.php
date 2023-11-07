@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('keluarga.create')}}" class="btn btn-rounded btn-success"><i class="fa fa-plus mr-2"></i> Tambah KK</a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom:0px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success">
            {{ Session::get('success') }}
            </div>
        @endif
        <div class="box no-mb">
            <div class="box-body">
                <form id="formSearch">
                    <div class="row">
                        <div class="col-md-2">
                            <select name="id_cluster" class="form-control" onchange="filterData()">
                                <option value>-Semua Dusun-</option>
                                @foreach($listWilayah as $item)
                                <option value="{{ $item->id }}">{{ $item->dusun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="kelas_sosial" class="form-control" onchange="filterData()">
                                <option value>-Semua Kelas Sosial-</option>
                                @foreach($keluargaSejahtera as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="search_by"  class="form-control" onchange="filterData()">
                                <option value disabled selected>Search By...</option>
                                <option value="no_kk">Nomor KK</option>
                                <option value="penduduk.nama">Kepala Keluarga</option>
                                <option value="nik_kepala">NIK Kepala Keluarga</option>
                                <option value="alamat">Alamat</option>
                                <option value="tgl_daftar">Tanggal Terdaftar</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="keyword" placeholder="Keyword" onchange="filterData()" />
                        </div>
                        <div class="col-md-2">
                            <button type="button" onclick="filterData()" class="btn btn-success"><i class="fa fa-search mr-1"></i> Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table id="datatable" class="table v-middle p-0 m-0 box">
                <thead>
                    <tr>
                        <th width="30"></th>
                        <th>No. KK</th>
                        <th>Kepala Keluarga</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>Dusun</th>
                        <th>Tgl Terdaftar</th>
                    </tr>
                </thead>
			</table>
        </div>
    </div>
</div>
@include('modals.pindah-dalam-desa-modal')
@endsection

@push('scripts')
<script type="text/javascript">
let dataTable;
let $dtSearch = $('#formSearch');
$(document).ready(function() {
    dataTable = $("#datatable").DataTable({
        ajax: {
            url: "/keluarga",
            data: function (data) {
                data.id_cluster = $dtSearch.find('[name="id_cluster"]').val();
                data.kelas_sosial = $dtSearch.find('[name="kelas_sosial"]').val();
                data.type = 'datatable';

                let filter = $dtSearch.find('[name="search_by"]').val();
                if (filter !== null) {
                    data.search_by = filter
                    data.keyword = $dtSearch.find('[name="keyword"]').val();
                }
            }
        },
        processing: true,
        serverSide: true,
        order: [[ 1, "asc" ]],
        bLengthChange: false,
        bFilter: false,
        columns: [
            { data: "action", name: "action", orderable: false },
            { data: "no_kk", name: "no_kk" },
            { data: "kepala_keluarga", name: "penduduk.nama" },
            { data: "kepala_nik", name: "penduduk.nik" },
            { data: "alamat_sekarang", name: "penduduk.alamat_sekarang" },
            { data: "nama_dusun", name: "wilayah.dusun" },
            { data: "tgl_daftar", name: "tgl_daftar", render: (data) => {
                return data.toLocaleString('id');
            } }
        ]
    });

    $dtSearch.find('[name="search_by"]').on('change', function () {
        let value = $(this).val();

        console.log(value)

        if (value == 'tgl_daftar') {
            $dtSearch.find('[name="keyword"]')
                .attr('autocomplete', 'off')
                .datepicker({
                    format: 'yyyy-mm-dd'
                });
        } else {
            $dtSearch.find('[name="keyword"]')
                .attr('autocomplete', 'on')
                .datepicker("destroy");
        }
    });

    $dtSearch.on('submit', function (event) {
        event.preventDefault();
        filterData();
    });

    $("#tgl_cetak_kk").datepicker({
        autoclose : true,
        format: 'yyyy-mm-dd'
    });
});

function filterData() {
    dataTable.ajax.reload()
}
</script>
@endpush
