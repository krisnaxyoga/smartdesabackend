@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('rab-desa.index')}}" class="btn btn-rounded btn-secondary"><i class="fa fa-chevron-left mr-2"></i> Kembali  </a>
@endsection
@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row">

            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h3>RAB DESA</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped v-middle">
                                        <tr>
                                            <td>Nomor RAB</td>
                                            <td>{{$data->no_rab}}</td>
                                        </tr>
                                        <tr>
                                            <td>Bidang Kegiatan</td>
                                            <td>{{$data->nama_bidang}}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Kegiatan</td>
                                            <td>{{$data->nama_kegiatan}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-11">
                                <h3>URAIAN RAB DESA</h3>
                            </div>
                        </div>
                    </div>

                    <div class="box-divider m-0"></div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="200px">Uraian</th>
                                        <th>Kategori Uraian</th>
                                        <th>Volume</th>
                                        <th>Satuan</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah Total</th>
                                        <th width="300px">Keterangan</th>
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
<script type="text/javascript">
    let dataTable;
    let $dtSearch = $('#formSearch');
    $(document).ready(function() {
        dataTable = $("#datatable").DataTable({
            ajax: {
                url: "/e-planning/rab-desa/{{$data->id}}?type=datatable",
            },
            processing: true,
            serverSide: true,
            order: [[ 0, "asc" ]],
            bLengthChange: false,
            bFilter: false,
            columns: [
                { data: "nama_uraian", name: "nama_uraian" },
                { data: "kategori_uraian", name: "kategori_uraian" },
                { data: "volume", name: "volume" },
                { data: "satuan", name: "satuan" },
                { data: "harga_satuan", name: "harga_satuan" },
                { data: "jumlah_total", name: "jumlah_total" },
                { data: "keterangan", name: "keterangan" },
            ]
        });
    });


</script>
@endpush
