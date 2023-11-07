@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('usulan-desa.index')}}" class="btn btn-rounded btn-secondary"><i class="fa fa-chevron-left mr-2"></i> Kembali </a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h3>Form Usulan RKP</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        <form action="{{route('usulan-desa.update', $data->id)}}" method="POST">
                            {{ csrf_field() }}
                            @method("PUT")
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul style="margin-bottom:0px;">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                {{ session()->get('success') }}
                                </div>
                            @endif

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Sub Bidang Kegiatan</label>
                                            <select class="form-control" name="bidang_id">
                                                <option value=""></option>
                                                @foreach($listBidang as $list)
                                                    <option value="{{$list->id}}" {{($list->id == $data->sub_bidang_id) ? 'selected' : '' }} >Bidang : {{$list->parent->nama_bidang}} - {{$list->nama_bidang}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Nama Kegiatan</label>
                                            <input type="text" name="nama_kegiatan" class="form-control" value="{{$data->nama_kegiatan}}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select class="form-control" name="wilayah_id">
                                                <option value=""></option>
                                                @foreach($listWilayah as $list)
                                                    <option value="{{$list->id}}" {{($list->id == $data->wilayah_id) ? 'selected' : '' }} >{{$list->dusun}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Volume</label>
                                            <input type="text" name="volume" id="" class="form-control" value="{{$data->volume}}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Sasaran/Manfaat</label>
                                            <input type="text" name="manfaat" id="" class="form-control" value="{{$data->manfaat}}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Prakiraan Waktu Pelaksanaan</label>
                                            <!-- <input type="text" name="estimated_time" id="" class="form-control datepicker-input" data-toggle="datepicker" data-target="#datepicker" autocomplete="off"> -->
                                             <input type="text" name="estimated_time" id="" class="form-control"  value="{{$data->estimated_time}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Jumlah Biaya</label>
                                            <input type="number" name="jumlah" class="form-control" value="{{$data->jumlah}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="{{ route('usulan-desa.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <button name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $("select").select2({
        placeholder: "Pilih....",
        width: "100%"
    })
    $(".datepicker-input").datepicker({
        autoclose : true,
        format: 'yyyy-mm-dd'
    });
</script>
@endpush
