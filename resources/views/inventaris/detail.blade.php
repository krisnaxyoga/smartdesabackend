@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('aset.index')}}" class="btn btn-rounded btn-secondary"><i class="fa fa-chevron-left mr-2"></i> Kembali  </a>
@endsection
@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row">
            <div class="col-12">

                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-10"><h3>INFORMASI ASET</h3></div>
                            <div class="col-2">
                                <div class="pull-right">
                                    <a href="{{route('barcode.aset', $data->id )}}" target="_blank" class="btn btn-rounded btn-primary"><i class="fa fa-print"></i> Print Barcode</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td><b>Kategori Aset</b></td>
                                            <td>{{$data->nama_kategori}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Nama Barang</b></td>
                                            <td>{{$data->nama_inventaris}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Kode Barang</b></td>
                                            <td>{{$data->kode_barang}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Bidang</b></td>
                                            <td>{{$data->nama_bidang}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Tahun Perolehan</b></td>
                                            <td>{{$data->tahun_perolehan}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Harga Perolehan</b></td>
                                            <td>Rp. {{number_format($data->harga_perolehan, 0, ',', '.')}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-6">
                                <table class="table table-bordered table-striped">
                                        <tr>
                                            <td><b>Sumber Dana</b></td>
                                            <td>{{$data->nama_sumber_inventaris}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Stok</b></td>
                                            <td>{{$data->stock}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Unit</b></td>
                                            <td>{{$data->nama_unit}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Nama Merk</b></td>
                                            <td>{{$data->merk != null ? $data->merk : '-'}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Bahan</b></td>
                                            <td>{{$data->bahan != null ? $data->bahan : '-'}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>No Sertifikat</b></td>
                                            <td>{{$data->no_sertifikat != null ? $data->no_sertifikat : '-'}}</td>
                                        </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-10"><h3>STOK ASET</h3></div>
                            <div class="col-2">
                                <div class="pull-right">
                                    <a href="{{route('detail-aset.create', $data->id )}}" class="btn btn-rounded btn-success"><i class="fa fa-plus mr-2"></i> Tambah Stok  </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-divider m-0"></div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="150">Aksi</th>
                                        <th>KODE REGISTER</th>
                                        <th>KONDISI</th>
                                        <th>KETERANGAN</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    let dataTable;
    let $dtSearch = $('#formSearch');
    $(document).ready(function() {
        dataTable = $("#datatable").DataTable({
            ajax: {
                url: "/aset/{{$data->id}}/detail-aset?type=datatable",
            },
            processing: true,
            serverSide: true,
            order: [[ 1, "asc" ]],
            bLengthChange: false,
            bFilter: false,
            columns: [
                { data: "action", name: "action", orderable: false },
                { data: "kode_register", name: "kode_register" },
                { data: "kondisi", name: "kondisi" },
                { data: "keterangan", name: "keterangan" },
            ]
        });
    });
</script>
@endpush
