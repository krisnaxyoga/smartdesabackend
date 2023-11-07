@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('kepala-dusun.create')}}" class="btn btn-rounded btn-success"><i class="fa fa-plus"></i> Tambah {{$page_title}}</a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
   
        <div class="table-responsive">
            <table id="datatable" class="table v-middle p-0 m-0 box">
                <thead>
                    <tr>
                        <th width="30"></th>
                        <th>Nama</th>
                        <th>No. Telepon</th>
                        <th>Dusun</th>
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
        ajax: "/kepala-dusun?type=datatable",
        processing: true,
        serverSide : true,
        order: [[ 1, "asc" ]],
        columns: [
            { data: "action", name: "action", orderable: false },
            { data: "name", name: "name" },
            { data: "phone", name: "phone" },
            { data: "dusun", name: "dusun" },
            // { data: "id_kepala", name: "id_kepala" }
        ]
    });
</script>
@endpush