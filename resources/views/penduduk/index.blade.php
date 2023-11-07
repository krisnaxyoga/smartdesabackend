@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="#" data-toggle="modal" data-target="#export-penduduk-modal" class="btn btn-rounded btn-primary"><i class="fa fa-file-text mr-2"></i> Export ke Excel</a>
<a href="#" class="btn btn-rounded btn-primary" data-toggle="modal" data-target="#import-penduduk-modal"><i class="fa fa-upload mr-2"></i> Import Excel</a>
<a href="{{route('penduduk.create')}}" class="btn btn-rounded btn-success"><i class="fa fa-plus mr-2"></i> Tambah {{$page_title}}</a>
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
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <select name="status" class="form-control"  onchange="filterData()">
                                <option value="0">-Semua Status-</option>
                                @foreach($listStatus as $x)
                                <option value="{{$x->id}}">{{$x->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="status_dasar" class="form-control"  onchange="filterData()">
                                <option value="0">-Semua Status Dasar-</option>
                                @foreach($listStatusDasar as $x)
                                <option value="{{$x->id}}">{{$x->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="jenis_kelamin" class="form-control"  onchange="filterData()">
                                <option value="0">-Semua Jenis Kelamin-</option>
                                @foreach($listSex as $x)
                                <option value="{{$x->id}}">{{$x->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="wilayah" class="form-control"  onchange="filterData()">
                                <option value="0">-Semua Dusun-</option>
                                @foreach($listWilayah as $dusun)
                                <option value="{{$dusun->id}}">{{$dusun->dusun}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="umur" class="form-control"  onchange="filterData()">
                                <option value="-1">-Semua Kelompok Umur-</option>
                                @for($x = 0; $x <= 110;$x++)
                                <option value="{{$x}}">{{$x}} Tahun</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="pekerjaan" class="form-control"  onchange="filterData()">
                                <option value="0">-Semua Pekerjaan-</option>
                                @foreach($listPekerjaan as $x)
                                <option value="{{$x->id}}">{{$x->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <select name="warga_negara"  class="form-control"  onchange="filterData()">
                                <option value="0">-Semua Kewarganegaraan-</option>
                                @foreach($listWarganegara as $x)
                                <option value="{{$x->id}}">{{$x->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <select name="pendidikan"  class="form-control"  onchange="filterData()">
                                <option value="0">-Semua Pendidikan Tamat -</option>
                                @foreach($listPendidikanKK as $x)
                                <option value="{{$x->id}}">{{$x->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="pendidikan_tempuh"  class="form-control"  onchange="filterData()">
                                <option value="0">-Semua Pendidikan Ditempuh -</option>
                                @foreach($listPendidikanDitempuh as $x)
                                <option value="{{$x->id}}">{{$x->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="agama"  class="form-control"  onchange="filterData()">
                                <option value="0">-Semua Agama-</option>
                                @foreach($listAgama as $x)
                                <option value="{{$x->id}}">{{$x->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
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
                        <div class="col-md-4">
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
                        <th>Alamat</th>
                        <th>Pekerjaan</th>
                        <th>Kawin</th>
                    </tr>
                </thead>
			</table>
        </div>
    </div>
</div>
@include('modals.pindah-dalam-desa-modal')
@include('modals.import-penduduk-modal')
@include('modals.export-penduduk-modal')
@endsection

@push('scripts')
<script type="text/javascript" src="/js/paging-input.js"></script>
<script type="text/javascript">
    let $dtSearch = $("#formSearch"),
        $dataTable = $("#datatable").DataTable({
            ajax: {
                url: "/penduduk?type=datatable",
                data: function (data) {
                    data.status = $dtSearch.find('[name="status"]').val();
                    data.warga_negara = $dtSearch.find('[name="warga_negara"]').val();
                    data.status_dasar = $dtSearch.find('[name="status_dasar"]').val();
                    data.jenis_kelamin = $dtSearch.find('[name="jenis_kelamin"]').val();
                    data.wilayah = $dtSearch.find('[name="wilayah"]').val();
                    data.umur = $dtSearch.find('[name="umur"]').val();
                    data.pekerjaan = $dtSearch.find('[name="pekerjaan"]').val();
                    data.pendidikan = $dtSearch.find('[name="pendidikan"]').val();
                    data.pendidikan_tempuh = $dtSearch.find('[name="pendidikan_tempuh"]').val();
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
                { data: "action", name: "action", orderable: false },
                { data: "nik", name: "nik" },
                { data: "nama", name: "nama" },
                { data: "tanggallahir", name: "tanggallahir" },
                { data: "alamat_sekarang", name: "alamat_sekarang" },
                { data: "pekerjaan", name: "pekerjaan" },
                { data: "kawin", name: "kawin" }
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
