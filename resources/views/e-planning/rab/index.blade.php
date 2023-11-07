@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('rab-desa.create')}}" class="btn btn-rounded btn-success"><i class="fa fa-plus mr-2"></i> Tambah RAB  </a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="table-responsive">
            <table id="datatable" class="table v-middle p-0 m-0 box">
                <thead>
                    <tr>
                        <th width="30"></th>
                        <th>Nomor RAB</th>
                        <th>Nama Kegiatan</th>
                        <th width="30"></th>
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
            url: "/e-planning/rab-desa?type=datatable",
        },
        processing: true,
        serverSide: true,
        order: [[ 1, "asc" ]],
        bLengthChange: false,
        bFilter: false,
        columns: [
            { data: "action", name: "action", orderable: false },
            { data: "no_rab", name: "no_rab" },
            { data: "nama_kegiatan", name: "nama_kegiatan" },
            { data: "print", name: "print", orderable: false },
        ]
    });
});

</script>
@endpush
