@extends('layouts.app') @section('title') {{$page_title}} @endsection @section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row">

            <div class="col-md-6">

                <form action="{{route('keluarga.update',[$keluarga->id])}}" method="POST">
                    @csrf @method('PUT')
                    <div class="box">
                        <div class="box-header">
                            <h3>Edit {{$keluarga->no_kk}}</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <label for="">No KK</label>
                            <div class="form-group">
                                <input type="text" required class="form-control" name="no_kk" id="no_kk" value="{{$keluarga->no_kk}}">
                            </div>

                            <label for="">Tanggal Cetak Kartu Keluarga </label>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                <a class="btn btn-default" ><i class="fa fa-calendar"></i></a>
                            </span>
                                    <input id="tgl_cetak_kk" type="text" class="form-control" name="tgl_cetak_kk" value="{{$keluarga->tgl_cetak_kk}}">
                                </div>

                            </div>

                            <label for="">Kelas Sosial</label>
                            <div class="form-group">
                                <select name="kelas_sosial" id="" class="form-control">
                                    <option></option>
                                    <option></option>
                                    @foreach($keluargaSejahtera as $list)
                                    <option value="{{$list->id}}" {{$list->id == $keluarga->kelas_sosial ? 'selected' : ''}}>{{$list->nama}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="">Peserta Program Bantuan Keluarga</label>
                           <div class="form-group">
                            @foreach($bantuan as $item)
                                <div class="checkbox mb-0">
                                    <label>
                                        <input type="checkbox" name="program_id[]" value="{{$item->id}}" {{in_array($item->id,$keluarga->data_program) ? 'checked' : ''}} > {{$item->nama}}</label>
                                </div>
                            @endforeach
                           </div>

                            <label for="">Lokasi Tempat Tinggal</label>
                            <div class="form-group">

                                <button class="btn btn-default" type="button" data-toggle="modal" data-target="#pendudukMapModal"><i class="fa fa-map-marker"></i> Cari Lokasi Tempat Tinggal</button>
                            </div>
                            <input type="hidden" name="lat" class="address-coordinate" value="{{ $keluarga->lat != null ? $keluarga->lat : '-8.644609'}}">
                            <input type="hidden" name="lng" class="address-coordinate" value="{{ $keluarga->lng != null ? $keluarga->lng : '115.2046587'}}">
                            <input type="hidden" name="use_map" id="use_map" value="0">

                        </div>
                        <div class="box-footer">
                            <a href="{{route('keluarga.index')}}" class="btn btn-default">Kembali</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@include('modals.penduduk-map-modal') @endsection @push('scripts')
<script type="text/javascript">
    $(".datepicker-input").datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
    $("select[name=kelas_sosial]").select2({
        placeholder: "Pilih Kelas Sosial...",
        minimumResultsForSearch: -1,
        width: '100%',
        allowClear: true
    })

    $("#tgl_cetak_kk").datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
</script>
@endpush
