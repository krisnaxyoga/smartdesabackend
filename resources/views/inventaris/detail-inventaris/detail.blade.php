@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('aset.show', $data['inventaris']->id)}}" class="btn btn-rounded btn-secondary"><i class="fa fa-chevron-left mr-2"></i> Kembali  </a>
@endsection
@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row">
            <div class="col-12">

                <div class="box">
                    <div class="box-header">
                        <h3>INFORMASI ASET</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td><b>Kategori Aset</b></td>
                                            <td>{{$data['inventaris']->nama_kategori}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Nama Barang</b></td>
                                            <td>{{$data['inventaris']->nama_inventaris}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Kode Barang</b></td>
                                            <td>{{$data['inventaris']->kode_barang}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Bidang</b></td>
                                            <td>{{$data['inventaris']->nama_bidang}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Tahun Perolehan</b></td>
                                            <td>{{$data['inventaris']->tahun_perolehan}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Harga Perolehan</b></td>
                                            <td>Rp. {{number_format($data['inventaris']->harga_perolehan, 0, ',', '.')}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-6">
                                <table class="table table-bordered table-striped">
                                        <tr>
                                            <td><b>Sumber Dana</b></td>
                                            <td>{{$data['inventaris']->nama_sumber_inventaris}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Stok</b></td>
                                            <td>{{$data['inventaris']->stock}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Unit</b></td>
                                            <td>{{$data['inventaris']->nama_unit}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Nama Merk</b></td>
                                            <td>{{$data['inventaris']->merk != null ?$data['inventaris']->merk : '-'}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Bahan</b></td>
                                            <td>{{$data['inventaris']->bahan != null ? $data['inventaris']->bahan : '-'}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>No Sertifikat</b></td>
                                            <td>{{$data['inventaris']->no_sertifikat != null ? $data['inventaris']->no_sertifikat : '-'}}</td>
                                        </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-10"><h3>INFORMASI DAN LOG STOK</h3></div>
                        </div>
                    </div>

                    <div class="box-divider m-0"></div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td><b>Nama Aset</b></td>
                                            <td>{{$data['log']->kode_register}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Kondisi</b></td>
                                            <td>{{($data['log']->kondisi == 'B' ? 'Baik' : ($data['log']->kondisi == "KB" ? 'Kurang Baik' : 'Sangat Kurang Baik'))  }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Keterangan</b></td>
                                            <td>{{$data['log']->keterangan != null ? $data['log']->keterangan : "-"}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>KONDISI LAMA</th>
                                        <th>KONDISI BARU</th>
                                        <th>KETERANGAN</th>
                                        <th>WAKTU LOG</th>
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
                url: "/aset/{{$data['inventaris']->id}}/{{$data['log']->id}}/log?type=datatable",
            },
            processing: true,
            serverSide: true,
            order: [[ 3, "desc" ]],
            bLengthChange: false,
            bFilter: false,
            columns: [
                { data: "kondisi_lama", name: "kondisi_lama" },
                { data: "kondisi_baru", name: "kondisi_baru" },
                { data: "keterangan", name: "keterangan" },
                { data: "created_at", name: "created_at" },
            ]
        });
    });
</script>
@endpush
