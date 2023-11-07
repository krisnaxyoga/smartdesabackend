@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('bidang.index')}}" class="btn btn-rounded btn-secondary"><i class="fa fa-chevron-left mr-2"></i> Kembali </a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row">
            <div class="col-6">
                <div class="box">
                    <div class="box-header">
                        <h3>Form Bidang</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{route('bidang.store')}}" method="POST">
                            {{ csrf_field() }}

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
                                <div class="form-group">
                                    <label>Jenis Bidang</label>
                                    <select class="form-control" id="jenis_bidang" name="jenis_bidang" required>
                                        <option value=""></option>
                                        <option value="2">Bidang</option>
                                        <option value="1">Sub Bidang</option>
                                    </select>
                                </div>

                                <div id="form-bidang" style="display: none">
                                    <div class="form-group">
                                        <label>Kode Bidang</label>
                                        <input type="text" class="form-control" name="kode_bidang" id="">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Bidang</label>
                                        <input type="text" class="form-control" name="nama_bidang" id="">
                                    </div>
                                </div>

                                <div id="form-sub-bidang" style="display: none">
                                    <div class="form-group">
                                        <label>Induk Bidang</label>
                                        <select class="form-control" name="nama_induk_bidang">
                                            <option value=""></option>
                                            @foreach($listBidang as $list)
                                                <option value="{{$list->id}}">{{$list->nama_bidang}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Sub Bidang</label>
                                        <input type="text"  class="form-control"  name="nama_sub_bidang" id="">
                                    </div>
                                </div>


                                <div class="box-footer">
                                    <a href="{{route('bidang.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                                    <button name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                </div>
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
        placeholder : "Pilih...",
        width : '100%'
    })


    $("#jenis_bidang").on('change',function () {
        if (this.value == 1) {
            $("#form-sub-bidang").css({
                "display":"block"
            })
            $("#form-bidang").css({
                "display":"none"
            })
        }else if(this.value == 2){
            $("#form-sub-bidang").css({
                "display":"none"
            })
            $("#form-bidang").css({
                "display":"block"
            })
        }
    })
</script>
@endpush
