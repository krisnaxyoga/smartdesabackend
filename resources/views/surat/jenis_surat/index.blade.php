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
                        <th width="100">Kode</th>
                        <th>Jenis Surat</th>
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
        ajax: {
            url : '/jenis-surat?type=datatable',
            data : {
                type : 'datatable'
            }
        },
        processing: true,
        serverSide : true,
        order: [[ 1, "asc" ]],
        columns: [
            { data: "action", name: "action", orderable: false },
            { data: "kode_surat", name: "kode_surat" },
            { data: "judul", name: "judul" },
            // { data: "id_kepala", name: "id_kepala" }
        ]
    });
</script>
@endpush