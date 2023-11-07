@extends('layouts.app')
@section('title') {{$page_title}}
@endsection
@section('action')
{{-- <a href="{{route('penduduk-pendatang.show', $duktang->id)}}" class="btn btn-default"><i class="fa fa-arrow-left mr-1"></i> Kembali</a> --}}

@endsection
@section('content')
<div class="content-main" id="content-main">
    <div class="padding" id="bg-detail">
        <form action="{{route('penduduk-pendatang.anggota.store',$duktang->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="referrer" value="{{ request()->server('HTTP_REFERER') }}" />
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="box">
                        <div class="box-header primary">
                            <h3>Anggota Keluarga Yang Ikut</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th valign="center">Data Umum</th>
                                                    <th valign="center">Data Tambahan</th>
                                                    <th valign="center">Keterangan</th>
                                                    <th valign="center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-if="index !== 0" v-for="(detail, index) in details">
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="">NIK</label>
                                                            <input id="nik_detail"  type="text" class="form-control" name='nik_detail[]' v-model="detail.nik_detail" placeholder="NIK">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Nama</label>
                                                            <input type="text"  class="form-control" name="nama_detail[]" v-model="detail.nama_detail" placeholder="Nama">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Jenis Kelamin</label>
                                                            <select v-if="detail.sex_detail === ''" name="sex_detail[]" class="form-control">
                                                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                                @foreach($listSex as $sex)
                                                                    <option value="{{$sex->id}}">{{$sex->nama}}</option>
                                                                @endforeach
                                                            </select>

                                                            <select v-else name="sex_detail[]" v-model="detail.sex_detail"  class="form-control">
                                                                <option value="" disabled>Pilih Jenis Kelamin</option>
                                                                @foreach($listSex as $sex)
                                                                    <option value="{{$sex->id}}" v-bind:selected="detail.sex_detail">{{$sex->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Tanggal Lahir</label>
                                                            <input type="text"  name="umur_detail[]" class="form-control datepicker-input" data-toggle="datepicker" data-target="#datepicker" autocomplete="off" v-if="detail.umur_detail === ''">
                                                            <input type="text"  name="umur_detail[]" v-model="detail.umur_detail" class="form-control datepicker-input" data-toggle="datepicker" data-target="#datepicker" autocomplete="off" v-else>
                                                        </div>
                                                    </td>
                                                    <td>
                                                       <div class="form-group">
                                                            <label for="">Status Perkawinan</label>
                                                            <select  v-if="detail.status_kawin_detail === ''" name="status_kawin_detail[]" class="form-control">
                                                                <option value="" selected disabled>Pilih Status Perkawinan</option>
                                                                @foreach($listKawin as $kawin)
                                                                    <option value="{{$kawin->id}}" v-bind:selected="detail.status_kawin_detail">{{$kawin->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                            <select  v-else name="status_kawin_detail[]"  v-model="detail.status_kawin_detail" class="form-control">
                                                                <option value="" disabled>Pilih Status Perkawinan</option>
                                                                @foreach($listKawin as $kawin)
                                                                    <option value="{{$kawin->id}}" v-bind:selected="detail.status_kawin_detail">{{$kawin->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                       </div>
                                                       <div class="form-group">
                                                           <label for="">Pendidikan</label>
                                                           <select v-if="detail.pendidikan_detail === ''"  name="pendidikan_detail[]" class="form-control">
                                                                <option value="" selected disabled>Pilih Pendidikan</option>
                                                                @foreach($listPendidikanKK as $pendidikan)
                                                                    <option value="{{$pendidikan->id}}">{{$pendidikan->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                           <select v-else name="pendidikan_detail[]" v-model="detail.pendidikan_detail" class="form-control">
                                                                <option value="" disabled>Pilih Pendidikan</option>
                                                                @foreach($listPendidikanKK as $pendidikan)
                                                                    <option value="{{$pendidikan->id}}"  v-bind:selected="detail.pendidikan_detail">{{$pendidikan->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                       </div>
                                                       <div class="form-group">
                                                           <label for="">Status Keluarga</label>
                                                           <select  v-if="detail.status_keluarga_detail === ''" name="status_keluarga_detail[]" class="form-control">
                                                                <option value="" selected disabled>Pilih Status Keluarga</option>
                                                                @foreach($listHubungan as $list)
                                                                    <option value="{{$list->id}}">{{$list->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                            <select v-else name="status_keluarga_detail[]" v-model="detail.status_keluarga_detail" class="form-control">
                                                                <option value="" disabled>Pilih Status Keluarga</option>
                                                                @foreach($listHubungan as $list)
                                                                    <option value="{{$list->id}}" v-bind:selected="detail.status_keluarga_detail">{{$list->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                       </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="">Keterangan</label>
                                                            <input type="text"  class="form-control" name='ket_detail[]' v-model="detail.ket_detail">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" @click="deleteDetail(index)"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="btn-group float-right">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-plus"></i> Tambah Anggota
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-left" role="menu">
                                                <a class="dropdown-item" data-toggle="modal" data-target="#searchDuktang">Cari NIK</a>
                                                <a class="dropdown-item" href="#" @click="addDetail">Tambah Data Baru</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="box-footer">
                            <a  href="{{route('penduduk-pendatang.show',$duktang->id)}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>


<!-- modal -->
        <div id="searchDuktang" class="modal fade" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cari NIK</h5></div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <select class="form-control" name="nik_penduduk" id="nik_penduduk" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Batal</button>
                        <button type="button" @click="addAnggotaByModal" class="btn primary p-x-md" data-dismiss="modal">Tambahkan</button>
                    </div>
                </div>
            </div>
        </div>
<!-- end modal -->



    </div>
</div>

@endsection
@push('scripts')
<script>
 new Vue({
        el: '#bg-detail',
        data: {
            details: [{
                nik_detail: '',
                nama_detail: '',
                sex_detail: '',
                umur_detail: '',
                status_kawin_detail: '',
                pendidikan_detail: '',
                status_keluarga_detail: '',
                ket_detail: ''
            }],
            function () {
                return{
                    anggota: null
                }
            }
        },
        methods: {
            addDetail : function () {
                this.details.push({
                    nik_detail: '',
                    nama_detail: '',
                    sex_detail: '',
                    umur_detail: '',
                    status_kawin_detail: '',
                    pendidikan_detail: '',
                    status_keluarga_detail: '',
                    ket_detail: ''
                });
            },
            deleteDetail: function (index) {
                this.details.splice(index,1);
                // if(index===0)
                // this.addDetail();
            },
            addAnggotaByModal: function () {
                this.details.push({
                    nik_detail: this.anggota.nik,
                    nama_detail: this.anggota.nama,
                    sex_detail: this.anggota.sex,
                    umur_detail: this.anggota.tanggallahir,
                    status_kawin_detail: this.anggota.status_kawin_id,
                    pendidikan_detail: this.anggota.pendidikan_kk_id,
                    status_keluarga_detail: this.anggota.kk_level,
                    ket_detail: ''
                });
            }
        },
        mounted() {
            $self = this;
            $(".datepicker-input").datepicker({
                autoclose : true,
                format: 'yyyy-mm-dd'
            });
            $("#nik_penduduk").select2({
                placeholder : "Pilih NIK...",
                width : "100%",
                ajax: {
                    url: '{{route("api.anggotaDuktang")}}?desa_id={{auth()->user()->desa_id}}&except=',
                    data: function (params) {
                        var query = {
                            search: params.term,
                            type: 'select2'
                        }
                        return query;
                    },
                    processResults: (data) => {
                        return {
                            results: data
                        }
                    }
                },
                escapeMarkup: (markup) => markup, // let our custom formatter work
                    templateSelection: (data) => {
                                        if (typeof data.nik !== "undefined")
                                        return data.nik + " ["+ data.nama + "]"

                                        return data.text
                    },
                    templateResult: (data) => {
                                        if (data.loading) {
                                            return "Memuat Data ..."
                                        }

                                        return data.nik + " ["+ data.nama + "]"
                    },
            }).on('change',function(){
                $self.anggota = $(this).select2('data')[0]
            });
        },
        beforeUpdate () {
            $("#nik_penduduk").select2("destroy");
        },
        updated () {
            $(".datepicker-input").datepicker({
                autoclose : true,
                format: 'yyyy-mm-dd'
            });
            $("#nik_penduduk").select2({
                placeholder : "Pilih NIK...",
                width : "100%",
                ajax: {
                    url: '{{route("api.anggotaDuktang")}}?desa_id={{auth()->user()->desa_id}}&except=',
                    data: function (params) {
                        var query = {
                            search: params.term,
                            type: 'select2'
                        }
                        return query;
                    },
                    processResults: (data) => {
                        return {
                            results: data
                        }
                    }
                },
                escapeMarkup: (markup) => markup, // let our custom formatter work
                    templateSelection: (data) => {
                                        if (typeof data.nik !== "undefined")
                                        return data.nik + " ["+ data.nama + "]"

                                        return data.text
                    },
                    templateResult: (data) => {
                                        if (data.loading) {
                                            return "Memuat Data ..."
                                        }

                                        return data.nik + " ["+ data.nama + "]"
                    },
            }).on('change',function(){
                $self.anggota = $(this).select2('data')[0]
            });
        }
 })
</script>
@endpush
