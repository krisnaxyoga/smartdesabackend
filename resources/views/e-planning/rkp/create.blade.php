@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('rkp-desa.index')}}" class="btn btn-rounded btn-secondary"><i class="fa fa-chevron-left mr-2"></i> Kembali  </a>
@endsection
@section('content')
<div class="content-main" id="content-main">
    <div class="padding" id="table-activities">
        <form action="{{route('rkp-desa.store')}}" method="POST" enctype="multipart/form-data">
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
                            <h3>RKP DESA</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                            {{ csrf_field() }}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Tahun RKP</label>
                                        <input type="number" name="tahun" class="form-control">
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
                                    <h3>KEGIATAN RKP DESA</h3>
                                </div>
                                {{-- <div class="col-1">
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-primary"  @click="addActivity"> <i class="fa fa-plus"></i> Tambah Kegiatan </a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>

                        <div class="box-divider m-0"></div>

                        <div class="box-body">

                            <div class="table-responsive">

                                <div class="form-group">

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="25%">Sub Bidang dan Jenis Kegiatan</th>
                                                <th width="15%">Lokasi, Volume, Sasaran/Manfaat & Waktu Pelaksanaan</th>
                                                <th width="15%">Jumlah dan Sumber Biaya</th>
                                                <th width="15%">Pola Pelaksanaan</th>
                                                <th width="15%">Rencana Pelaksana Kegiatan</th>
                                                <th width="10%">File<br>Pendukung</th>
                                                <th width="5%"></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-if="index !== 0" v-for="(activity, index) in activities">
                                                <td>
                                                    <label>Sub Bidang</label>
                                                    <select class="form-control select2" v-if="activity.sub_bidang_id === ''" name="bidang_id[]">
                                                        <option value=""></option>
                                                        @foreach($data['bidang'] as $list)
                                                            <option value="{{$list->id}}">{{$list->nama_bidang}}</option>
                                                        @endforeach
                                                    </select>
                                                    <select class="form-control" v-else name="bidang_id[]" v-model="activity.sub_bidang_id" style="cursor:not-allowed; touch-action:none; pointer-events: none" readonly>
                                                        <option value=""></option>
                                                        @foreach($data['bidang'] as $list)
                                                            <option value="{{$list->id}}" v-bind:selected="activity.sub_bidang_id">{{$list->nama_bidang}}</option>
                                                        @endforeach
                                                    </select>
                                                    <br><br>
                                                    <label>Jenis</label>
                                                    <input type="text" class="form-control" name='nama_kegiatan[]' v-if="activity.nama_kegiatan === ''"  value="{{old('nama_kegiatan[]')}}">
                                                    <input type="text" class="form-control" name='nama_kegiatan[]' v-else value="{{old('nama_kegiatan[]')}}" v-model="activity.nama_kegiatan" readonly>
                                                </td>
                                                <td>
                                                    <label>Lokasi</label>
                                                    <select class="form-control select2" v-if="activity.wilayah_id === ''" name="wilayah_id[]" width="100%">
                                                        <option value=""></option>
                                                        @foreach($data['lokasi'] as $list)
                                                            <option value="{{$list->id}}">{{$list->dusun}}</option>
                                                        @endforeach
                                                    </select>
                                                    <select width="100%" class="form-control select2" v-else name="wilayah_id[]" v-model="activity.wilayah_id"  style="cursor:not-allowed; touch-action:none; pointer-events: none" readonly>
                                                        <option value=""></option>
                                                        @foreach($data['lokasi'] as $list)
                                                            <option value="{{$list->id}}" v-bind:selected="activity.wilayah_id">{{$list->dusun}}</option>
                                                        @endforeach
                                                    </select>

                                                    <br><br>
                                                    <label>Volume</label>
                                                    <input type="text" name="volume[]" class="form-control" v-if="activity.volume === ''">
                                                    <input type="text" name="volume[]" v-model="activity.volume" class="form-control" v-else readonly>
                                                    <br>
                                                    <label>Sasaran/Manfaat</label>
                                                    <input type="text" name="manfaat[]" class="form-control" v-if="activity.manfaat === ''">
                                                    <input type="text" name="manfaat[]" v-model="activity.manfaat" class="form-control" v-else readonly>
                                                    <br>
                                                    <label>Waktu Pelaksanaan</label>
                                                    <input type="text" name="start_date[]" class="form-control"  v-if="activity.start_date === ''">
                                                    <input type="text" name="start_date[]" v-model="activity.start_date" class="form-control" v-else readonly>
                                                </td>

                                                <td>
                                                    <label>Biaya</label>
                                                    <input type="number" name="jumlah[]" class="form-control" v-if="activity.jumlah === ''">
                                                    <input type="number" name="jumlah[]" v-model="activity.jumlah" class="form-control" v-else readonly>
                                                    <br>
                                                    <label>Sumber</label>
                                                    <select width="100%" class="form-control select2" v-if="activity.sumber === ''" name="sumber_biaya[]">
                                                        <option value=""></option>
                                                        @foreach($data['sumber_dana'] as $list)
                                                            <option value="{{$list->id}}">{{$list->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    <select width="100%" class="form-control select2" v-else name="sumber_biaya[]" v-model="activity.sumber">
                                                        <option value=""></option>
                                                        @foreach($data['sumber_dana'] as $list)
                                                            <option value="{{$list->id}}" v-bind:selected="activity.sumber">{{$list->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td>
                                                    <!-- <label>Swakelola</label>
                                                    <input type="text" name="swakelola[]" id="" class="form-control">
                                                    <br>
                                                    <label>Kerjasama Antar Desa</label>
                                                    <input type="text" name="kerjasama_antardesa[]" id="" class="form-control">
                                                    <br>
                                                    <label>Kerjasama Pihak Ketiga</label>
                                                    <input type="text" name="kerjasama_pihak_ketiga[]" id="" class="form-control"> -->
                                                    <label>Swakelola</label>
                                                    <select width="100%" class="form-control select2"  name="swakelola[]">
                                                        <option value=""></option>
                                                        <option value="tidak">Tidak</option>
                                                        <option value="ya">Ya</option>
                                                    </select>
                                                    <br>
                                                    <br>
                                                    <label>Kerjasama Antar Desa</label>
                                                    <select width="100%" class="form-control select2"  name="kerjasama_antardesa[]">
                                                        <option value=""></option>
                                                        <option value="tidak">Tidak</option>
                                                        <option value="ya">Ya</option>
                                                    </select>
                                                    <br>
                                                    <br>
                                                    <label>Kerjasama Pihak Ketiga</label>
                                                    <select width="100%" class="form-control select2"  name="kerjasama_pihak_ketiga[]">
                                                        <option value=""></option>
                                                        <option value="tidak">Tidak</option>
                                                        <option value="ya">Ya</option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <textarea name="rencana_pelaksana_kegiatan[]" id="" cols="30" rows="15" class="form-control" style="resize : none"></textarea>
                                                    <input type="text" style="display:none;" name="status[]" v-model="activity.status">
                                                    <input type="text" style="display:none;" name="id_kegiatan[]" v-model="activity.id_kegiatan">
                                                </td>

                                                <td>
                                                    <input type="file" style="display : none" ref="file" class="form-control" @change="handleFileUpload($event)">
                                                    <button type="button" @click="handlerChooseFile($event)" class="btn-upload btn btn-primary w-100"> Upload </button>
                                                    <input type="hidden" name="attachment[]">
                                                    <br>
                                                    <br>
                                                    <a target="blank" class="link-attachment align-self-center"></a>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-danger" @click="deleteActivity(index)"> <i class="fa fa-trash"></i> </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                            {{-- Modal Trigger --}}
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-plus"></i> Tambah Kegiatan
                                </button>
                                <div class="dropdown-menu dropdown-menu-left" role="menu">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#modalUsulan">Tambah Data dari Usulan</a>
                                    <a class="dropdown-item" href="#" @click="addActivity">Tambah Data Baru</a>
                                </div>
                            </div>
                            {{-- <br><br><br><br><br> --}}
                        </div>

                        <div class="box-footer">
                            <a href="" class="text-white btn btn-secondary">
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

        {{-- Modal --}}
        <div class="modal fade modalUsulan" role="dialog" id="modalUsulan" aria-labelledby="modalUsulan" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cari Usulan RKP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nama Kegiatan</label>
                                    <select class="form-control" name="nama_kegiatan" id="usulan" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Bidang Kegiatan</label>
                                    <input type="text" class="form-control" name="bidang_id" id="bidang_usulan" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Nama Kegiatan</label>
                                    <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan_usulan" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <input type="text"  class="form-control" name="wilayah_id" id="lokasi_usulan" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Volume</label>
                                    <input type="text" name="volume"  id="volume_usulan" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Sasaran/Manfaat</label>
                                    <input type="text" name="manfaat" id="manfaat_usulan" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Prakiraan Waktu Pelaksanaan</label>
                                    <input type="text" name="start_date" id="waktu_usulan"  class="form-control datepicker-input" data-toggle="datepicker" data-target="#datepicker" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Jumlah Biaya</label>
                                    <input type="number" name="jumlah" id="biaya_usulan"  class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-close"></i> Batal</button>
                        <button type="button" class="btn btn-primary" @click="addActivityByModal" data-dismiss="modal"> <i class="fa fa-plus"></i> Tambah Kegiatan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">

new Vue({
    el : '#table-activities',
    data: {
        activities: [{
            sub_bidang_id: '',
            nama_kegiatan: '',
            wilayah_id: '',
            volume: '',
            manfaat: '',
            start_date: '',
            jumlah: '',
            sumber: '',
            swakelola: '',
            kerjasama_antardesa: '',
            kerjasama_pihak_ketiga: '',
            rencana_pelaksana_kegiatan:'',
            attachment: '',
            status: '',
            id_kegiatan:''
        }],
        function () {
            return{
                usulan: null
            }
        }
    },
    methods: {
        addActivity : function () {
            this.activities.push({
                sub_bidang_id: '',
                nama_kegiatan: '',
                wilayah_id: '',
                volume: '',
                manfaat: '',
                start_date: '',
                jumlah: '',
                sumber: '',
                swakelola: '',
                kerjasama_antardesa: '',
                kerjasama_pihak_ketiga: '',
                rencana_pelaksana_kegiatan:'',
                attachment: '',
                status: '',
                id_kegiatan:''
            });
        },
        deleteActivity: function(index){
            this.activities.splice(index,1);
            // if (index===0)
            // this.addActivity();
        },
        addActivityByModal : function () {
            this.activities.push({
                sub_bidang_id: this.usulan.sub_bidang_id,
                nama_kegiatan: this.usulan.nama_kegiatan,
                wilayah_id: this.usulan.wilayah_id,
                volume: this.usulan.volume,
                manfaat: this.usulan.manfaat,
                start_date: this.usulan.estimated_time,
                jumlah: this.usulan.jumlah,
                sumber: '',
                swakelola: '',
                kerjasama_antardesa: '',
                kerjasama_pihak_ketiga: '',
                rencana_pelaksana_kegiatan:'',
                attachment: '',
                status:this.usulan.status,
                id_kegiatan:this.usulan.id
            });
            console.log(this.activities)
        },
        handlerChooseFile(e){
            $(e.target).prev().trigger('click');

            //console.log($(e.target).next().val("HELLO"));
        },
        handleFileUpload(e){
            var files = e.target.files[0]
            let formData = new FormData();
            formData.append('attachment', files); // <input name="attachment" value="hello"
            $(e.target).next().text('Loading');
            var url = "{{ route('api.upload-attachment') }}";

            axios.post(url,
                formData,
                {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
              }
            ).then(function(data){
                $(e.target).next().text('Upload');
                $(e.target).next().next().val(data.data);
                $(e.target).next().next().next().next().next().html('<i class="fa fa-file-pdf-o fa-3x"></i>');
                $(e.target).next().next().next().next().next().attr('href', data.data);
            })
            .catch(function(){
              console.log('FAILURE!!');
            });
        }
    },
    mounted () {
        $self = this;
        $(".select2").select2({
            placeholder: "Pilih....",
        });

        // $("button[name=browseFile]").click(function(){
        //     $("#attachmentFile").trigger('click')
        // });

        // $("#attachmentFile").change(function(e){
        //     var reader = new FileReader();
        //     reader.readAsDataURL(event.target.files[0]);
        // });

        $(".datepicker-input").datepicker({
            autoclose : true,
            format: 'yyyy-mm-dd'
        });

        $("#usulan").select2({
            placeholder : "Pilih Usulan...",
            width : "100%",
            ajax: {
                url: '{{route("api.usulan")}}?desa_id={{auth()->user()->desa_id}}&except=',
                data: function (params) {
                    var query = {
                        search: params.term,
                        type: 'select2'
                    }

                // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: (data) => {
                    // Tranforms the top-level key of the response object from 'items' to 'results'
                    return {
                    results: data
                    }
                }
            },
            escapeMarkup: (markup) => markup, // let our custom formatter work
                templateSelection: (data) => {
                    if (typeof data.nama_kegiatan !== "undefined")
                    return "Nama Kegiatan: " + data.nama_kegiatan + " ["+ data.nama_bidang + "]" + " - " + data.dusun

                    return data.text
                },
                templateResult: (data) => {
                    if (data.loading) {
                        return "Memuat Data ..."
                    }

                    return "Nama Kegiatan   : " + data.nama_kegiatan + " ["+ data.nama_bidang + "]" + " - " + data.dusun
                },
            }).on('change',function(){
                $self.usulan = $(this).select2('data')[0]
                console.log($self.usulan)
                $('#bidang_usulan').val($self.usulan.nama_bidang)
                $('#nama_kegiatan_usulan').val($self.usulan.nama_kegiatan)
                $('#lokasi_usulan').val($self.usulan.dusun)
                $('#volume_usulan').val($self.usulan.volume)
                $('#manfaat_usulan').val($self.usulan.manfaat)
                $('#waktu_usulan').val($self.usulan.estimated_time)
                $('#biaya_usulan').val($self.usulan.jumlah)
                $('#status_usulan').val($self.usulan.status)
            });
    },
    beforeUpdate () {
        $("#usulan").select2("destroy");
        $('#bidang_usulan').val('');
        $('#nama_kegiatan_usulan').val('');
        $('#lokasi_usulan').val('');
        $('#volume_usulan').val('');
        $('#manfaat_usulan').val('');
        $('#waktu_usulan').val('');
        $('#biaya_usulan').val('');
    },
    updated () {
        $(".select2").select2({
            placeholder: "Pilih....",
        });

        // $("button[name=browseFile]").click(function(){
        //     $("#attachmentFile").trigger('click')
        // });

        // $("#attachmentFile").change(function(e){
        //     var reader = new FileReader();
        //     reader.readAsDataURL(event.target.files[0]);
        // });

        $(".datepicker-input").datepicker({
            autoclose : true,
            format: 'yyyy-mm-dd'
        });

        $("#usulan").select2({
            placeholder : "Pilih Usulan...",
            width : "100%",
            ajax: {
                url: '{{route("api.usulan")}}?desa_id={{auth()->user()->desa_id}}&except=',
                data: function (params) {
                    var query = {
                        search: params.term,
                        type: 'select2'
                    }

                // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: (data) => {
                    // Tranforms the top-level key of the response object from 'items' to 'results'
                    return {
                    results: data
                    }
                }
            },
            escapeMarkup: (markup) => markup, // let our custom formatter work
                templateSelection: (data) => {
                    if (typeof data.nama_kegiatan !== "undefined")
                    return "Nama Kegiatan: " + data.nama_kegiatan + " ["+ data.nama_bidang + "]" + " - " + data.dusun

                    return data.text
                },
                templateResult: (data) => {
                    if (data.loading) {
                        return "Memuat Data ..."
                    }

                    return "Nama Kegiatan   : " + data.nama_kegiatan + " ["+ data.nama_bidang + "]" + " - " + data.dusun
                },
            }).on('change',function(){
                $self.usulan = $(this).select2('data')[0]
                console.log($self.usulan)
                $('#bidang_usulan').val($self.usulan.nama_bidang)
                $('#nama_kegiatan_usulan').val($self.usulan.nama_kegiatan)
                $('#lokasi_usulan').val($self.usulan.dusun)
                $('#volume_usulan').val($self.usulan.volume)
                $('#manfaat_usulan').val($self.usulan.manfaat)
                $('#waktu_usulan').val($self.usulan.estimated_time)
                $('#biaya_usulan').val($self.usulan.jumlah)
            });

    }
})
</script>
@endpush
