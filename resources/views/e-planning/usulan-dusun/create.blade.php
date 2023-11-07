@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('usulan-dusun.index')}}" class="btn btn-rounded btn-secondary"><i class="fa fa-chevron-left mr-2"></i> Kembali  </a>
@endsection
@section('content')
<div class="content-main" id="content-main">
    <div class="padding" id="table-activities">
        <form action="{{route('usulan-dusun.store')}}" method="POST" enctype="multipart/form-data">
            <div class="row">

                <div class="col-12">

                    @if(Session::get('error')!=null)
                    <div class="alert alert-danger">
                            <ul style="margin-bottom:0px;">

                                    <li>{{ Session::get('error') }}</li>

                            </ul>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul style="margin-bottom:0px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="box">
                        <div class="box-header">
                            <h3>USULAN MASYARAKAT</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                            {{ csrf_field() }}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Tahun Usulan</label>
                                        <input type="number" name="tahun" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Usulan Dari</label>
                                        <select name="pengusul_id" class="form-control select-2">
                                            <option value=""></option>
                                            <optgroup label="Dusun">
                                                @foreach ($data['wilayah'] as $item)
                                                    <option value="{{$item->nama}}">{{$item->nama}}</option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Kelompok Masyarakat">
                                                @foreach ($data['kelompok'] as $item)
                                                    <option value="{{$item->nama}}">{{$item->nama}} ( {{$item->kategori}} ) </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" name="keterangan" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>File Pendukung</label>
                                        <input name="attachment" type="file" style="display : none" value="" id="attachmentFile">
                                        <button name="browseFile" value="" type="button" class="btn btn-primary" style="display : block;width : 100%;"><i class="fa fa-upload"></i> Browse File</button>
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
                                    <h3>KEGIATAN USULAN MASYARAKAT</h3>
                                </div>
                            </div>
                        </div>

                        <div class="box-divider m-0"></div>

                        <div class="box-body">

                            <div class="table-responsive">

                                <div class="form-group">

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="300px">Gagasan Kegiatan</th>
                                                <th>Lokasi</th>
                                                <th>Volume</th>
                                                <th>Satuan</th>
                                                <th>Penerima Manfaat</th>
                                                <th width="20px"></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(activity, index) in activities">
                                                <td>
                                                    <label>Nama Kegiatan</label>
                                                    <input type="text" name="nama_kegiatan[]" class="form-control">
                                                </td>
                                                <td>
                                                    <label>Lokasi</label>
                                                    <input type="text" name="lokasi[]" class="form-control">
                                                </td>
                                                <td>
                                                    <label>Volume</label>
                                                    <input type="number" name="volume[]" class="form-control">
                                                </td>
                                                <td>
                                                    <label>Satuan</label>
                                                    <input type="text" name="satuan[]" class="form-control">
                                                </td>
                                                <td>
                                                    <label>LK</label>
                                                    <input type="number" name="lk[]" class="form-control">
                                                    <label style="margin-top:5%">PR</label>
                                                    <input type="number" name="pr[]" class="form-control">
                                                    <label style="margin-top:5%">A-RTM</label>
                                                    <input type="number" name="artm[]" class="form-control">
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-danger" @click="deleteActivity(index)"> <i class="fa fa-trash"></i> </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                            <br>
                            <a class="btn btn-primary" href="#" @click="addActivity">
                                <i class="fa fa-plus"></i>
                                Tambah Data Baru
                            </a>
                        </div>


                        <div class="box-footer">
                            <a href="{{route('usulan-dusun.index')}}" class="text-white btn btn-secondary">
                                <i class="fa fa-chevron-left"></i> Kembali
                            </a>
                            <button name="save" type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">

new Vue({
    el : '#table-activities',
    data: {
        activities: [{
            nama_kegiatan: '',
            lokasi: '',
            volume: 0,
            satuan: '',
            lk: 0,
            pr: 0,
            artm: 0,
        }],
    },
    methods: {
        addActivity : function () {
            this.activities.push({
                nama_kegiatan: '',
                lokasi: '',
                volume: 0,
                satuan: '',
                lk: 0,
                pr: 0,
                artm: 0,
            });
        },
        deleteActivity: function(index){
            this.activities.splice(index,1);
        }

    },
    mounted () {
        $self = this;
        $(".select-2").select2({
            placeholder: "Pilih....",
            width: "100%"
        });
        $("button[name=browseFile]").click(function(){
            $("#attachmentFile").trigger('click')
        });
        $("#attachmentFile").change(function(e){
            var reader = new FileReader();
            reader.readAsDataURL(event.target.files[0]);
        });
    },
})

</script>
@endpush
