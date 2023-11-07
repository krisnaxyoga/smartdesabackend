@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('berita.create')}}" class="btn btn-rounded btn-success"><i class="fa fa-plus"></i> Tambah {{$page_title}}</a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
   
        <div class="table-responsive">
            <table id="datatable" class="table v-middle p-0 m-0 box">
                <thead>
                    <tr>
                        <th width="30"></th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Tapilkan Pada Slider</th>
                        <th>Dibuat Pada</th>
                        {{-- <th>Kepala Dusun</th> --}}
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
        ajax: "/berita?type=datatable",
        processing: true,
        serverSide : true,
        order: [[ 1, "asc" ]],
        columns: [
            { data: "action", name: "action", orderable: false },
            { data: "judul", name: "judul" },
            { data: "kategori", name: "kategori" },
            { data: "penulis", name: "penulis" },
            { data: "status_berita", name: "status_berita" },
            { data: "slider", name: "slider" },
            { data: "tgl_dibuat", name: "tgl_dibuat" },
            // { data: "id_kepala", name: "id_kepala" }
        ]
    });
</script>
@endpush