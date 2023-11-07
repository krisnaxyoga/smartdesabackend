@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('pamong.create')}}" class="btn btn-rounded btn-success"><i class="fa fa-plus"></i> Tambah Staff</a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">

        <div class="table-responsive">
            <table id="datatable" class="table v-middle p-0 m-0 box">
                <thead>
                    <tr>
                        <th width="30"></th>
                        <th>Nama Staff Desa</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>NIK</th>
                        {{-- <th>Username</th> --}}
                    </tr>
                </thead>
			</table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    let dataTable = $("#datatable").DataTable({
        ajax: "/pamong?type=datatable",
        processing: true,
        serverSide : true,
        order: [[ 1, "asc" ]],
        columns: [
            { data: "action", name: "action", orderable: false },
            { data: "pamong_nama", name: "pamong_nama" },
            { data: "pamong_nip", name: "pamong_nip" },
            { data: "jabatan", name: "jabatan" },
            { data: "pamong_nik", name: "pamong_nik" },
            // { data: "username", name: "username" }
        ]
    });
</script>
@endpush
