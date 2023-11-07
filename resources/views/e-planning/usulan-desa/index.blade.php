@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('usulan-desa.create')}}" class="btn btn-rounded btn-success"><i class="fa fa-plus mr-2"></i> Tambah Usulan RKP  </a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="table-responsive">
            <table id="datatable" class="table v-middle p-0 m-0 box">
                <thead>
                    <tr>
                        <th width="30"></th>
                        <th>Nama Kegiatan</th>
                        <th>Nama Bidang</th>
                        <th>Prakiraan Waktu Pelaksanaan</th>
                        <th>Lokasi</th>
                    </tr>
                </thead>
			</table>
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
            url: "/e-planning/usulan-desa?type=datatable",
        },
        processing: true,
        serverSide: true,
        order: [[ 1, "asc" ]],
        bLengthChange: false,
        bFilter: false,
        columns: [
            { data: "action", name: "action", orderable: false },
            { data: "nama_kegiatan", name: "nama_kegiatan" },
            { data: "nama_bidang", name: "nama_bidang" },
            { data: "estimated_time", name: "estimated_time" },
            { data: "dusun", name: "dusun" },
        ]
    });
});

</script>
@endpush
