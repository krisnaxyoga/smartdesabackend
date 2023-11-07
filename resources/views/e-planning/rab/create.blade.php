@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('rab-desa.index')}}" class="btn btn-rounded btn-secondary"><i class="fa fa-chevron-left mr-2"></i> Kembali  </a>
@endsection
@section('content')
<div class="content-main" id="content-main">
    <div class="padding" id="table-activities">
        <form action="{{route('rab-desa.store')}}" method="POST">
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
                            <h3>RAB DESA</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                            {{ csrf_field() }}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Nomor RAB</label>
                                        <input type="number" name="no_rab" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Kegiatan RKP Desa</label>
                                        <select name="id_kegiatan" id="rkp" class="form-control select2">
                                            <option value=""></option>
                                            @foreach ($data as $item)
                                                <option value="{{$item->id}}">{{$item->nama_kegiatan}}</option>
                                            @endforeach
                                        </select>
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

                                <div class="form-group">

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="300px">Uraian</th>
                                                <th>Volume</th>
                                                <th>Satuan</th>
                                                <th>Harga Satuan</th>
                                                <th>Jumlah Total</th>
                                                <th width="300px">Keterangan</th>
                                                <th width="20px"></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(activity, index) in activities">
                                                <td :data-index="index">
                                                    <label>Uraian</label>
                                                    <select name="barang_id[]" @change="itemOnChange($event, index)" class="form-control select2">
                                                        <option></option>
                                                        @foreach($uraian as $category)
                                                        <optgroup label="{{$category->name}}">
                                                            @foreach($category->barang as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                        @endforeach
                                                    </select>
                                                    <!-- <select name="kategori_uraian[]" class="form-control select2">
                                                        <option value=""></option>
                                                        <option value="Bahan">Bahan</option>
                                                        <option value="Alat">Alat</option>
                                                        <option value="Upah">Upah</option>
                                                    </select> -->
                                                    <!-- <label style="margin-top: 20px !important">Uraian</label>
                                                    <input type="text" name="uraian[]" class="form-control"> -->
                                                </td>
                                                <td>
                                                    <label>Volume</label>
                                                    <input type="number" name="volume[]" class="form-control" v-model="activity.volume">
                                                </td>
                                                <td>
                                                    <label>Satuan</label>
                                                    <input type="text" name="satuan[]" class="form-control">
                                                </td>
                                                <td>
                                                    <label>Harga Satuan</label>
                                                    <input type="number" name="harga_satuan[]" class="form-control harga_satuan" v-model="activity.harga_satuan">
                                                </td>
                                                <td>
                                                    <label>Jumlah Total</label>
                                                    <input type="number" name="jumlah_total[]" id="jumlah" class="form-control" v-bind:value="activity.volume*activity.harga_satuan" readonly>
                                                </td>
                                                <td>
                                                    <label>Keterangan</label>
                                                    <textarea name="keterangan[]" style="resize: none" cols="30" rows="10" class="form-control"></textarea>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-danger" @click="deleteActivity(index)"> <i class="fa fa-trash"></i> </a>
                                                </td>
                                            </tr>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th colspan="4" style="text-align: right;">
                                                    <p>Total Anggaran</p>
                                                </th>
                                                <th>
                                                    <input type="text" v-bind:value="totalItem()" class="form-control" readonly>
                                                </th>
                                            </tr>
                                        </tfoot>
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
                            <a href="{{route('rab-desa.index')}}" class="text-white btn btn-secondary">
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
            nama_uraian: '',
            barang_id:'',
            kategori_uraian: '',
            volume: 0,
            satuan: '',
            harga_satuan: 0,
            jumlah_total: 0,
            keterangan: '',
        }],
        key: "",
    },
    methods: {
        addActivity : function () {
            this.activities.push({
                    nama_uraian: '',
                    barang_id:'',
                    kategori_uraian: '',
                    volume: 0,
                    satuan: '',
                    harga_satuan: 0,
                    jumlah_total: 0,
                    keterangan: '',
            });
        },
        deleteActivity: function(index){
            this.activities.splice(index,1);
            // if (index===0)
            // this.addActivity();
        },
        itemOnChange: function(event){
            var index = $(event.target).parent().attr('data-index');
            var barang_id = event.target.value;
            var url = "{{url('/api/rab-harga-item/')}}";
            axios.get(url+"/"+barang_id).then((result) => {
                var price = result.data.harga;
                //$(event.target).parent().next().next().next().children().next().val(price);

                this.activities[index].harga_satuan = price;
                //console.log(this.activities);
            }).catch((err) => {
                console.log(err);
            });
        },
        totalItem: function(){
            let sum = 0;
            for(let i = 0; i < this.activities.length; i++){
                sum += (parseFloat(this.activities[i].volume) * parseFloat(this.activities[i].harga_satuan));
            }
            return sum;
        },
        setBidang: function (bidang) {
            $("#bidang").val(bidang)
        }

    },
    mounted () {
        $self = this;
        $(".select2").select2({
            placeholder: "Pilih....",
            width: "100%"
        }).change(function(e){
            $self.itemOnChange(e);
        })
    },
})
</script>
@endpush
