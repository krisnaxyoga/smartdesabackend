@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('categories.create')}}" class="btn btn-rounded btn-success"><i class="fa fa-plus mr-2"></i> Tambah {{$page_title}}</a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="table-responsive">
            <table id="datatable" class="table v-middle p-0 m-0 box">
                <thead>
                    <tr>
                        <th width="20%">Aksi</th>
                        <th>Kategori</th>
                    </tr>
                </thead>

			</table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="/js/paging-input.js"></script>
<script type="text/javascript">
   let dataTable = $("#datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax:"/pengaduan/categories?type=datatable",
        columns: [
            {data: 'action' ,orderable: false},
            {data: 'name'}
        ]
    });
</script>
@endpush
