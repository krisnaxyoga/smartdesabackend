@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('aset.create')}}" class="btn btn-rounded btn-success"><i class="fa fa-plus mr-2"></i> Tambah Aset  </a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="table-responsive">
            <table id="datatable" class="table v-middle p-0 m-0 box">
                <thead>
                    <tr>
                        <th width="30"></th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori Aset</th>
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
            url: "/aset?type=datatable",
        },
        processing: true,
        serverSide: true,
        order: [[ 1, "asc" ]],
        bLengthChange: false,
        bFilter: false,
        columns: [
            { data: "action", name: "action", orderable: false },
            { data: "kode_barang", name: "kode_barang" },
            { data: "nama_inventaris", name: "nama_inventaris" },
            { data: "nama_kategori", name: "nama_kategori" },
        ]
    });
});

</script>
@endpush
