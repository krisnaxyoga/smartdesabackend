@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('usulan-dusun.create')}}" class="btn btn-rounded btn-success"><i class="fa fa-plus mr-2"></i> Tambah Usulan Masyarakat  </a>
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
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success">
            {{ Session::get('success') }}
            </div>
        @endif
        <div class="box no-mb">
            <div class="box-body">
                <form id="formSearch">
                    <div class="row">
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="pengusul" placeholder="Pengusul" onchange="filterData()" />
                        </div>
                        <div class="col-md-2">
                            <select name="search_by"  class="form-control" onchange="filterData()">
                                <option value disabled selected>Search By...</option>
                                <option value="pengusul">Nama Pengusul</option>
                                <option value="pengusul_type">Jenis Pengusul</option>
                                <option value="tahun_usulan">Tahun Usulan</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="keyword" placeholder="Keyword" onchange="filterData()" />
                        </div>
                        <div class="col-md-2">
                            <button type="button" onclick="filterData()" class="btn btn-success"><i class="fa fa-search mr-1"></i> Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table id="datatable" class="table v-middle p-0 m-0 box">
                <thead>
                    <tr>
                        <th width="30">Action</th>
                        <!-- <th>Dusun</th>
                        <th>Tahun Usulan</th> -->
                        <th>Nama Pengusul</th>
                        <th>Jenis Pengusul</th>
                        <th>Tahun Usulan</th>
                        <th>Attachment</th>
                        <!-- <th width="30"></th> -->
                    </tr>
                </thead>
			</table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
let dataTable;
let $dtSearch = $('#formSearch');
$(document).ready(function() {
    dataTable = $("#datatable").DataTable({
        ajax: {
            url: "/e-planning/usulan-dusun",
            data: function (data) {
                data.pengusul = $dtSearch.find('[name="pengusul"]').val();
                data.type = 'datatable';
                let filter = $dtSearch.find('[name="search_by"]').val();
                if (filter !== null) {
                    data.search_by = filter
                    data.keyword = $dtSearch.find('[name="keyword"]').val();
                }
            }
        },
        processing: true,
        serverSide: true,
        order: [[ 1, "asc" ]],
        bLengthChange: false,
        bFilter: false,
        columns: [
            { data: "action", name: "action", orderable: false },
            { data: "pengusul", name: "pengusul" , orderable: false},
            { data: "pengusul_type", name: "pengusul_type" },
            { data: "tahun", name: "tahun" },
            { data: "attachment", name: "attachment" },
            // { data: "print", name: "print", orderable: false },
        ]
    });

    $dtSearch.find('[name="search_by"]').on('change', function () {
        let value = $(this).val();

        console.log(value)

        if (value == 'tahun') {
            $dtSearch.find('[name="keyword"]')
                .attr('autocomplete', 'off')
        } else {
            $dtSearch.find('[name="keyword"]')
                .attr('autocomplete', 'on')
        }
    });

    $dtSearch.on('submit', function (event) {
        event.preventDefault();
        filterData();
    });
});

function filterData() {
    dataTable.ajax.reload()
}

$(document).on('click', '.download-item', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = $(this).data('url');
                var label = $(this).data('label');

                    $.ajax({
                        type: "GET",
                        dataType: "JSON",
                        url: url,
                        data: {
                            "id": id,
                            "_method": 'GET',
                            "_token": "{{ csrf_token() }}",
                        }
                    }).then((data) => {
                        if (typeof data.message !== 'undefined') {
                            notie.alert({
                                text: data.message,
                                type: 'success'
                            })
                            $("#datatable").DataTable().ajax.reload();

                        }
                        $("#datatable").DataTable().ajax.reload();
                    })
    });

</script>
@endpush
