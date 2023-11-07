@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('cctv.create')}}" class="btn btn-rounded btn-success"><i class="fa fa-plus mr-2"></i> Tambah CCTV  </a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="table-responsive">
            <table id="datatable" class="table v-middle p-0 m-0 box">
                <thead>
                    <tr>
                        <th width="120"></th>
                        <th>Nama CCTV</th>
                        <th>Link</th>
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
            url: "/cctv?type=datatable",
        },
        processing: true,
        serverSide: true,
        order: [[ 1, "asc" ]],
        bLengthChange: false,
        bFilter: false,
        columns: [
            { data: "action", name: "action", orderable: false },
            { data: "nama_cctv", name: "nama_cctv" },
            { data: "link", name: "link" },
        ]
    });
});

</script>
@endpush
