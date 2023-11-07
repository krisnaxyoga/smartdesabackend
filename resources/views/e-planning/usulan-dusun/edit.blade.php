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
        <form action="{{route('usulan-dusun.update', $data['usulanDusun']->id )}}" method="POST" enctype="multipart/form-data">
            <div class="row">

                <div class="col-12">
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
                            @method('PUT')
                        <div class="box-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Tahun Usulan</label>
                                        <input type="number" name="tahun" class="form-control" value="{{$data['usulanDusun']->tahun}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Usulan Dari</label>
                                        <select name="pengusul_id" class="form-control select2">
                                            <option value=""></option>
                                            <optgroup label="Dusun">
                                                @foreach ($data['wilayah'] as $item)
                                                    <option value="{{$item->nama}}" {{ $data['usulanDusun']->pengusul_type == 'DUSUN' ? ($data['usulanDusun']->pengusul_id == $item->id ? 'selected' : '') : '' }}>{{$item->nama}}</option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Kelompok Masyarakat">
                                                @foreach ($data['kelompok'] as $item)
                                                    <option value="{{$item->nama}}" {{ $data['usulanDusun']->pengusul_type == 'KELOMPOK' ? ($data['usulanDusun']->pengusul_id == $item->id ? 'selected' : '') : '' }}>{{$item->nama}} ( {{$item->kategori}} ) </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" name="keterangan" value="{{$data['usulanDusun']->keterangan}}" class="form-control">
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
                                                    <input type="text" name="nama_kegiatan[]" class="form-control" v-model="activity.nama_kegiatan">
                                                </td>
                                                <td>
                                                    <label>Lokasi</label>
                                                    <input type="text" name="lokasi[]" class="form-control" v-model="activity.lokasi">
                                                </td>
                                                <td>
                                                    <label>Volume</label>
                                                    <input type="number" name="volume[]" class="form-control" v-model="activity.volume">
                                                </td>
                                                <td>
                                                    <label>Satuan</label>
                                                    <input type="text" name="satuan[]" class="form-control" v-model="activity.satuan">
                                                </td>
                                                <td>
                                                    <label>LK</label>
                                                    <input type="number" name="lk[]" class="form-control" v-model="activity.penerima_lk">
                                                    <label style="margin-top:5%">PR</label>
                                                    <input type="number" name="pr[]" class="form-control" v-model="activity.penerima_pr">
                                                    <label style="margin-top:5%">A-RTM</label>
                                                    <input type="number" name="artm[]" class="form-control"  v-model="activity.penerima_artm">
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-danger" @click="deleteActivity(index, activity.id)"> <i class="fa fa-trash"></i> </a>
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
            id: '',
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
        getActivity : function () {
            axios.get('{{route("usulan-dusun.edit", $data["usulanDusun"]->id)}}?type=edit')
                .then(response => {this.activities = response.data})
        },
        addActivity : function () {
            this.activities.push({
                id: '',
                nama_kegiatan: '',
                lokasi: '',
                volume: 0,
                satuan: '',
                lk: 0,
                pr: 0,
                artm: 0,
            });
        },
        deleteActivity: function(index, id){
            console.log(id);

            if (id != ''){
                return axios.delete( "{{url('api/usulan-kegiatan-dusun/delete/')}}"+ "/" + id).then(res => {
                    this.activities.splice(index,1);
                }).catch((err) => {
                    console.log(err);
                })
            }else{
                this.activities.splice(index,1);
            }
        }

    },
    mounted () {
        $self = this;
        this.getActivity();
        $(".select2").select2({
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
