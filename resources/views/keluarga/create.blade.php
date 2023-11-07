@extends('layouts.app')

@section('title')
{{$page_title}}
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
        <form autocomplete="off" action="{{route('keluarga.store')}}" method="POST">
            @csrf
        <div class="row">

        </div>
        <div class="row">

                <div class="col-md-12">

                    <div class="box">
                        <div class="box-header blue">
                            <h3>Form KK Baru</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                {{-- <div class="col-md-4">
                                    <label for="">Dusun</label>
                                    <div class="form-group">
                                        <select name="id_cluster" id="" class="form-control">
                                            <option></option>
                                            @foreach($listDusun as $list)
                                                <option value="{{$list->id}}">{{$list->dusun}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-4">
                                    <label for="">Kepala Keluarga</label>
                                    <div class="form-group">
                                        <select name="nik_kepala" id="" class="form-control" required>
                                            <option></option>
                                            @foreach($pendudukTanpaKK as $penduduk)
                                                <option value="{{$penduduk->nik}}">{{$penduduk->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Nomor Kartu Keluarga (KK)</label>
                                    <div class="form-group">
                                       <input placeholder="Nomor Kartu Keluarga (KK)" required class="form-control" type="text" name="no_kk"/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="">Lokasi Tempat Tinggal</label>
                                    <div class="form-group">
                                        <button class="btn btn-default" type="button" data-toggle="modal" data-target="#pendudukMapModal"><i class="fa fa-map-marker"></i> Cari Lokasi Tempat Tinggal</button>
                                        <input type="hidden" name="lat" value="{{old('lat')}}" class="address-coordinate">
                                        <input type="hidden" name="use_map" id="use_map" value="0">
                                        <input type="hidden" name="lng" value="{{old('lng')}}" class="address-coordinate">
                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>
                    <a href="{{route('keluarga.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>

                </div>
            </div>
        </form>
    </div>
</div>
@include('modals.penduduk-map-modal')
@endsection
@push('scripts')
<script type="text/javascript">
    $(".datepicker-input").datepicker({
        autoclose : true,
        format: 'yyyy-mm-dd'
    });

    $("select[name=nik_kepala]").select2({
        placeholder : "Pilih Kepala Keluarga...",
        width : '100%'
    })

    $("select[name=id_cluster]").select2({
        placeholder : "Pilih Dusun...",
        minimumResultsForSearch : -1,
        width : '100%'
    })
</script>
@endpush
