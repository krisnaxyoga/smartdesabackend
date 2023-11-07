@extends('layouts.app')

@section('title')
Pengguna
@endsection

@section('action')
<a href="{{ url('user/create') }}" class="btn btn-rounded btn-success"><i class="fa fa-plus"></i> Tambah Pengguna</a>
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
                <a href="#" class="close" data-dismiss="alert"></a>
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
                <a href="#" class="close" data-dismiss="alert"></a>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
                <a href="#" class="close" data-dismiss="alert"></a>
            </div>
        @endif
        <div class="table-responsive">
            <table id="datatable" class="table v-middle p-0 m-0 box">
                <thead>
                    <tr>
                        <th width="30"></th>
                        <th>Nama</th>
                        <th>Username</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var colors = [
        'RED',
        'PINK',
        'PURPLE',
        'DEEP-PURPLE',
        'INDIGO',
        'BLUE',
        'LIGHT-BLUE',
        'CYAN',
        'TEAL',
        'GREEN',
        'LIGHT-GREEN',
        'LIME',
        'YELLOW',
        'AMBER',
        'ORANGE',
        'DEEP-ORANGE',
        'BROWN',
        'BLUE-GREY',
        'GREY',
    ];

    let dataTable = $("#datatable").DataTable({
        ajax: "/user?type=datatable",
        processing: true,
        serverSide : true,
        order: [[ 1, "asc" ]],
        columns: [
            { data: "action", name: "action", searchable: false, orderable: false },
            { 
                data: "name", 
                name: "name",
                render: function (data, index, row) {
                    let str = data.charAt(0), 
                        i = Math.floor((Math.random() * colors.length));

                    return "<span class='avatar w-32 mr-2 d-inline-flex " + colors[i].toLowerCase() + "'>" + str.toUpperCase() + "</span><span>" + data + "</span>";
                }
            },
            { data: "username", name: "username" }
        ]
    });
</script>
@endpush