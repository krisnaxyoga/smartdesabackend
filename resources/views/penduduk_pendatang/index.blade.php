@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')

<a href="{{route('penduduk-pendatang.create')}}" class="btn btn-rounded btn-success"><i class="fa fa-plus mr-2"></i> Tambah {{$page_title}}</a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
    <div class="box">
            <div class="box-body">
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
                <form id="formSearch">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <select name="jenis_kelamin" class="form-control"  onchange="filterData()">
                                <option value="0">-Semua Jenis Kelamin-</option>
                                @foreach($listSex as $x)
                                <option value="{{$x->id}}">{{$x->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="wilayah" class="form-control"  onchange="filterData()">
                                <option value="0">-Semua Dusun-</option>
                                @foreach($listWilayah as $dusun)
                                <option value="{{$dusun->id}}">{{$dusun->dusun}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="pekerjaan" class="form-control"  onchange="filterData()">
                                <option value="0">-Semua Pekerjaan-</option>
                                @foreach($listPekerjaan as $x)
                                <option value="{{$x->id}}">{{$x->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="warga_negara"  class="form-control"  onchange="filterData()">
                                <option value="0">-Semua Kewarganegaraan-</option>
                                @foreach($listWarganegara as $x)
                                <option value="{{$x->id}}">{{$x->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <select name="pendidikan"  class="form-control"  onchange="filterData()">
                                <option value="0">-Semua Pendidikan -</option>
                                @foreach($listPendidikanKK as $x)
                                <option value="{{$x->id}}">{{$x->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="agama"  class="form-control"  onchange="filterData()">
                                <option value="0">-Semua Agama-</option>
                                @foreach($listAgama as $x)
                                <option value="{{$x->id}}">{{$x->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="golongan_darah"  class="form-control"  onchange="filterData()">
                                <option value="0">-Semua Gol Darah-</option>
                                @foreach($listGolonganDarah as $x)
                                <option value="{{$x->id}}">{{$x->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
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
                        <th width="30"></th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tgl Lahir</th>
                        <th>Desa Asal</th>
                        <th>Pekerjaan</th>
                        <th>Status Perkawinan</th>
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
            ajax: {
                url: "/penduduk-pendatang?type=datatable",
                data: function (data) {
                    data.warga_negara = $dtSearch.find('[name="warga_negara"]').val();
                    data.jenis_kelamin = $dtSearch.find('[name="jenis_kelamin"]').val();
                    data.wilayah = $dtSearch.find('[name="wilayah"]').val();
                    data.pekerjaan = $dtSearch.find('[name="pekerjaan"]').val();
                    data.pendidikan = $dtSearch.find('[name="pendidikan"]').val();
                    data.agama = $dtSearch.find('[name="agama"]').val();
                    data.golongan_darah = $dtSearch.find('[name="golongan_darah"]').val();
                    data.keyword = $dtSearch.find('[name="keyword"]').val();
                }
            },
            processing: true,
            serverSide: true,
            lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]],
            searching: false,
            order: [[ 1, "asc" ]],
            pagingType: "input",
            columns: [
                {data: 'action' ,orderable: false},
                {data: "nik"},
                {data: "nama"},
                {data: "tanggal_lahir"},
                {data: "desa_asal"},
                {data: "pekerjaan"},
                {data: "kawin"}
            ],
            language: {
                oPaginate: {
                    sNext: '<i class="fa fa-forward"></i>',
                    sPrevious: '<i class="fa fa-backward"></i>',
                    sFirst: '<i class="fa fa-step-backward"></i>',
                    sLast: '<i class="fa fa-step-forward"></i>'
                }
            }
        });

    function filterData() {
        $dataTable.ajax.reload()
    }

    $dtSearch.on('submit', function (event) {
        event.preventDefault();
        filterData();
    })
</script>
@endpush
