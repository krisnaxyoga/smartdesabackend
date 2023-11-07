@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('barang.create')}}" class="btn btn-rounded btn-success"><i class="fa fa-plus mr-2"></i> Tambah Barang  </a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="table-responsive">
            <table id="datatable" class="table v-middle p-0 m-0 box">
                <thead>
                    <tr>
                        <th width="30"></th>
                        <!-- <th>Desa</th> -->
                        <th>Barang</th>
                        <th>Kode Barang</th>
                        <th>Harga</th>
                        <th>Kategori Barang</th>
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
            url: "/e-planning/barang?type=datatable",
        },
        processing: true,
        serverSide: true,
        order: [[ 1, "asc" ]],
        bLengthChange: false,
        bFilter: false,
        columns: [
            { data: "action", name: "action", orderable: false },
            // { data: "nama_desa", name: "nama_desa" },
            { data: "name", name: "name" },
            { data: "kode_barang", name: "kode_barang" },
            { data: "harga", name: "harga" },
            { data: "kategori", name: "kategori" }
        ]
    });
});

</script>
@endpush
