@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
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
                            <div class="input-group" data-target-input="nearest">
                                <input type="text" id="start-date" class="form-control start-date" name="start_date" placeholder="Start Date">
                                <span class="input-group-addon" data-target="#start-date" data-toggle="datepicker">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group" data-target-input="nearest">
                                <input type="text" id="end-date" class="form-control end-date" name="end_date" placeholder="End Date"/>
                                <span class="input-group-addon" data-target="#end-date" data-toggle="datepicker">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select name="pengaduan_category_id"  class="form-control">
                                <option value disabled selected>-Kategori-</option>
                                @foreach($list_kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="search_by"  class="form-control" onchange="filterData()">
                                <option value disabled selected>Search By...</option>
                                <option value="title">Judul</option>
                                <option value="content">Konten</option>
                                <option value="penduduk.nama">Nama Pelaor</option>
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
                        <th>Action</th>
                        <th>Pelapor</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Disposisi</th>
                        <th>Tanggal Laporan</th>
                        <th>Status</th>
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
    let $dtSearch = $("#formSearch"),
        $dataTable = $("#datatable").DataTable({
            ajax:{
                url: "/pengaduan?type=datatable",
                data: function (data) {
                    data.start_date = $dtSearch.find('[name="start_date"]').val();
                    data.end_date = $dtSearch.find('[name="end_date"]').val();
                    data.pengaduan_category_id = $dtSearch.find('[name="pengaduan_category_id"]').val();
                    data.search_by = $dtSearch.find('[name="search_by"]').val();
                    data.keyword = $dtSearch.find('[name="keyword"]').val();
                }
            },
            processing: true,
            serverSide: true,
            order: [[ 1, "asc" ]],
            bLengthChange: false,
            bFilter: false,
            columns: [
                {data: "action" ,orderable: false, name: "action"},
                {data: "pelapor", name:"penduduk.nama"},
                {data: "title", name:"title"},
                {data: "category", name:"category"},
                {data: "disposisi", name:"disposisi"},
                {data: "created_at",
                    render: function(data, type, row){
                        if(type === "sort" || type === "type"){
                            return data;
                        }
                        return moment(data).format("DD-MMMM-YYYY");
                    },
                },
                {data: "status"}
            ],
        });

        $("#start-date").datepicker({
            autoclose : true,
            format: 'dd-mm-yyyy'
        });

        $("#end-date").datepicker({
            autoclose : true,
            format: 'dd-mm-yyyy'
        });

    function filterData() {
        $dataTable.ajax.reload()
    }

    $dtSearch.on('submit', function (event) {
        event.preventDefault();
        filterData();
    })


    $(document).on('click', '.mark-done-item', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = $(this).data('url');
                var label = $(this).data('label');

                if (confirm('Apakah anda yakin ingin menandai selesai '+label+' ini?')) {
                    $.ajax({
                        type: "POST",
                        dataType: "JSON",
                        url: url,
                        data: {
                            "id": id,
                            "_method": 'PUT',
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
                }
    });


</script>
@endpush
