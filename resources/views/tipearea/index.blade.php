@extends('layouts.app')

@section('title')
Tipe Area
@endsection

@section('action')
  <a href="/peta/tipearea/create" class="btn btn-rounded btn-success"><i class="fa fa-plus"></i> Tambah Tipe Area</a>
@endsection

@section('content')
<div class="content-main" id="content-main">
  <div class="padding">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul style="margin-bottom:0px;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <a class="close" data-dismiss="alert">&times;</a>
      </div>
    @endif
    @if (session()->has('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
        <a class="close" data-dismiss="alert">&times;</a>
      </div>
    @endif
    @if (session()->has('error'))
      <div class="alert alert-danger">
        {{ session()->get('error') }}
        <a class="close" data-dismiss="alert">&times;</a>
      </div>
    @endif
    <div class="table-responsive">
      <table id="datatable" class="table v-middle p-0 m-0 box dataTable no-footer">
        <thead>
          <tr>
            <th width="30"></th>
            <th>Nama Tipe Area</th>
            <th width="50">Warna</th>
            <th width="50">Aktif</th>
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
    ajax: "/peta/tipearea?type=datatable",
    processing: true,
    serverSide : true,
    order: [[ 1, "asc" ]],
    columns: [
      { data: "action", name: "action", orderable: false, searchable: false },
      { data: "name", name: "name" },
      {
        data: "color",
        name: "color",
        class: "text-center valign-middle",
        orderable: false,
        searchable: false,
        render: (data) => {
          return '<div style="background: #' + data + '; margin: auto; width: 33px; height: 33px; border-radius: 33px"></div>'
        }
      },
      { 
        data: "enabled",
        name: "enabled",
        class: "text-center",
        orderable: false,
        searchable: false,
        render: (data) => {
          let span = '<i class="text-'
          span += (data ? 'success fa fa-check">' : 'danger fa fa-remove">')
          span += '</i>'

          return span
        }
      },
    ]
  });
</script>
@endpush