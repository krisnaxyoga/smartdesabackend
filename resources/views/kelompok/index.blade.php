@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('kelompok.create')}}" class="btn btn-rounded btn-success"><i class="fa fa-plus"></i> Tambah {{$page_title}}</a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
       
        <div class="row">
            <div class="col-md-3">
                <div class="list-group list-group-sm box">
                    <div class="box-header">
                        <h3>Kategori Kelompok</h3>
                    </div>
                        <a href="/kelompok"  class="list-group-item {{$master_id == 0 ? 'primary text-white' : ''}}">Semua Kelompok <span class="float-right"><i class="fa fa-chevron-right"></i></span></a>
                    
                    @foreach($listKelompokMaster as $list)
                        <a href="?kelompok={{$list->id}}"  class="list-group-item {{$list->id == $master_id ? 'primary text-white' : ''}}">{{$list->kelompok}} <span class="float-right"><i class="fa fa-chevron-right"></i></span></a>
                    @endforeach()
                    {{-- <div class="box-footer">
                        <a href="{{route('kategori-kelompok.create')}}" class="btn btn-primary" style="display : block">Tambah Kategori</a>
                    </div> --}}
                </div>
                 
            </div>
            <div class="col-md-9">
                <div class="table-responsive">
                    <table id="datatable" class="table v-middle p-0 m-0 box">
                        <thead>
                            <tr>
                                <th width="30"></th>
                                <th>Nama Kelompok</th>
                                <th>Ketua Kelompok</th>
                                <th>Kategori Kelompok</th>
                                <th>Jumlah Anggota</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    let dataTable = $("#datatable").DataTable({
        ajax: "{{url('kelompok')}}?type=datatable&{{$master_id != 0 ? 'kelompok='.$master_id : ''}}",
        processing: true,
        serverSide : true,
        order: [[ 1, "asc" ]],
        columns: [
            { data: "action", name: "action", orderable: false },
            { data: "nama", name: "nama" },
            { data: "nama_ketua", name: "nama_ketua" },
            { data: "nama_kelompok", name: "nama_kelompok" },
            { data: "jml_anggota", name: "jml_anggota" },
        ]
    });
</script>
@endpush