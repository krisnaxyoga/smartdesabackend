@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection


@section('content')
<style>
.btn:not([disabled]):hover, .btn:not([disabled]):focus, .btn:not([disabled]).active {
    box-shadow: inset 0 -15rem 0px rgba(158, 158, 158, 0.2);
}
</style>

<div class="content-main" id="content-main">
    <div class="padding">
        
        <div class="table-responsive">
            <table id="datatable" class="table v-middle p-0 m-0 box table-bordered" >
                <thead>
                    <tr>
                        <th width="100">Aksi</th>
                        <th>Nomor</th>
                        <th>Pemohon</th>
                        <th>Jenis Surat</th>
                        <th>Keperluan</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
			</table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    let dataTable = $("#datatable").DataTable({
        ajax: "/surat?type=datatable",
        processing: true,
        serverSide : true,
        order: [[ 1, "asc" ]],
        columns: [
            { data: "action", name: "action", orderable: false },
            { data: "nomor_surat", name: "nomor_surat" },
            { data: "penduduk_nama", name: "penduduk_nama" },
            { data: "judul", name: "judul" },
            { data: "keperluan", name: "keperluan" },
            // { data: "id_kepala", name: "id_kepala" }
        ]
    });
</script>
@endpush