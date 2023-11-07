@extends('layouts.app')

@section('title')
Lokasi
@endsection

@section('action')
  <a href="/peta/lokasi/create" class="btn btn-rounded btn-success"><i class="fa fa-plus"></i> Tambah Lokasi</a>
@endsection

@section('content')
<div class="content-main" id="content-main">
  <div class="padding">
    @if ($errors->any())
      <div class="alert alert-danger">
        <a class="close" data-dismiss="alert">&times;</a>
        <ul style="margin-bottom:0px;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    @if (session()->has('success'))
      <div class="alert alert-success">
        <a class="close" data-dismiss="alert">&times;</a>
        {{ session()->get('success') }}
      </div>
    @endif
    @if (session()->has('error'))
      <div class="alert alert-danger">
        <a class="close" data-dismiss="alert">&times;</a>
        {{ session()->get('error') }}
      </div>
    @endif
    <div class="table-responsive">
      <table id="datatable" class="table v-middle p-0 m-0 box dataTable no-footer">
        <thead>
          <tr>
            <th width="30"></th>
            <th>Nama Lokasi</th>
            <th>Kategori</th>
            <th width="30">Aktif</th>
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
    ajax: "/peta/lokasi?type=datatable",
    processing: true,
    serverSide : true,
    lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "Semua baris"]],
    order: [[ 1, "asc" ]],
    columns: [
      { data: "action", name: "action", orderable: false, searchable: false },
      { data: "name", name: "name" },
      { 
        data: (data) => {
          if (data.tipe_lokasi !== null) {
            return data.tipe_lokasi.name
          }
          return '-'
        }, 
        name: "tipe_lokasi_id"
      },
      { 
        data: "enabled",
        name: "enabled",
        class: "text-center",
        orderable: false,
        searchable: false,
        render: (data) => {
          let span = '<i class="fa text-'
          span += (data ? 'success fa-check">' : 'danger fa-remove">')
          span += '</i>'

          return span
        }
      },
    ]
  });
</script>
@endpush